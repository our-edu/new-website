<?php

namespace App\AutomaticPaymentApp\Front\Controllers;

use App\AutomaticPaymentApp\Models\ParentDueBalance;
use App\AutomaticPaymentApp\Models\ParentPaymentTransactions;
use App\BaseApp\Controllers\BaseController;
use App\BaseApp\Models\User;
use App\BaseApp\PayFort\Facades\Payfort;
use App\BaseApp\Enums\PayFortStatusEnum;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;

class FrontController extends BaseController
{
    private $endpointUrl;
    public function __construct(){
        $this->endpointUrl = 'https://sbpaymentservices.payfort.com/FortAPI/paymentApi';
    }

    public function searchNationalId(Request $request): Factory|View|Application
    {
        $data = $request->validate([
           'national_id' => 'required'
        ]);
        $NationalIdExistiDatabase = ParentDueBalance::where('national_id',$data['national_id'])->exists();
        //check if national id found in our edu users
//      if($request->national_id == 'found in our edu'){
//          return view('welcome')->with(['loginEnabled'=>true,'registerEnabled'=>false]);
//      //if it's found on automatic payment
//      }else if($request->national_id == 'automatic'){
//
//          return view('welcome')->with(['loginEnabled'=>false,'registerEnabled'=>true]);
//          //not found at all
//      }else{
//          return view('welcome')->with(['loginEnabled'=>false,'registerEnabled'=>false]);
//
//      }
        return view('welcome')->with(['loginEnabled'=>false,'registerEnabled'=>false]);
    }
    public function getPaymentView(Request $request)
    {
        $random = Str::random(20);
        $parentDue = ParentDueBalance::where('national_id',$request->national_id)->first();
        if( ! $parentDue){
            return view('error-page', [
                'errorMessage' => __('payment.errors.parentDUeError', [], app()->getLocale())
            ]);

        }
        return view('new_payment.new-payment-page', [
            'url' => route('payments.getPaymentForm'),
            'parentDue' =>$parentDue,
            'balance' => $parentDue->balance,
            'merchant_reference' => $random,
            'language' => app()->getLocale(),
        ]);
    }

    public function getPaymentForm(Request $request)
    {
        $amount = $request->amount;
        $parent_due_uuid = $request->parent_due_uuid;
        $parentDue = ParentDueBalance::find($parent_due_uuid);
        if (!$amount) {
            return view('error-page', [
                'errorMessage' => __('payment.errors.amount_required', [], app()->getLocale())
            ]);
        }
        if( ! $parentDue){
                return view('error-page', [
                    'errorMessage' => __('payment.errors.parentDUeError', [], app()->getLocale())
                ]);

        }
        if( $amount > $parentDue->balance ){
            return view('error-page', [
                'errorMessage' => __('payment.errors.amountExceededBalance', [], app()->getLocale())
            ]);

        }
        $parentTransactionPending = ParentPaymentTransactions::create([
            'parent_name'=> $parentDue->parent_name,
            'national_id'=> $parentDue->national_id,
            'balance'=> $parentDue->balance,
            'email' => $parentDue->email,
            'paid_amount'=> $amount,
            'payfort_response'=>null,
            'paid'=> false
        ]);
        $data = [
            'merchant_reference' => $request->merchant_reference,
            'amount' => $amount,
            'currency' => 'SAR',
            'merchant_extra' => $parentTransactionPending->uuid,
            'customer_email' => $parentDue->email,
            'language' => app()->getLocale(),
        ];
        return Payfort::redirection()->displayRedirectionPage($data);
    }

    public function processReturnPdf(Request $request)
    {
        $locale = $request->lang ?? app()->getLocale();

        if (env('MEDIA_S3', false)) {
            $pdfUrl = env('MEDIA_SERVICE_HOST') ."/storage/$request->pdf.pdf";
        } else {
            $pdfUrl = env('APP_URL') . '/storage/' . $request->pdf . '.pdf';
        }

        echo "<script>setTimeout(function(){ window.location.href = '{$pdfUrl}'; }, 1000);</script>";
    }

    public function processReturn(Request $request)
    {
        $parentDueTransactionUuid = $request->merchant_extra;
        if ($request->status == PayFortStatusEnum::SUCCESS) {
            $parentDueTransaction = ParentPaymentTransactions::find($parentDueTransactionUuid);
            $response = $this->capture($parentDueTransaction->paid_amount, $request->merchant_reference, $request->fort_id);
            if ($response['status'] == PayFortStatusEnum::CAPTURE_SUCCESS) {
                $parentDueTransaction->update([
                    'paid' => true,
                    'payfort_response'=> json_encode($response)
                ]);
                $fileName = $this->processPdf($request->toArray());
                return Redirect::to(
                            buildWebRoute('payments.processReturnPdf', [
                                'pdf' => $fileName,
                            ])
                        );
                    }

        } else {
            return view('error-page', [
                'errorMessage' => $request->response_message,
                'language' => app()->getLocale(),
            ]);
        }

    }

    //create pdf for payAll balance or bill
    private function processPdf($response)
    {
        $parentDueTransactionUuid = $response['merchant_extra'];

        $amount = intval($response['amount'] / pow(10, 2));
        $parentDueTransaction = ParentPaymentTransactions::find($parentDueTransactionUuid);
        if ($parentDueTransaction) {
                $data = [
                    'paid_amount' => $amount,
                    'card_number' => $response['card_number'],
                    'card_holder_name' => (isset($response['card_holder_name']) || !empty($response['card_holder_name']))  ?$response['card_holder_name'] : null,
                    'expiry_date' => $response['expiry_date'],
                    'payment_option' => $response['payment_option'],
                    'response_message' => $response['response_message'],
                    'fort_id' => $response['fort_id'],
                    'parent_name' => $parentDueTransaction->parent_name,

                    'language' => $response['language'],
                ];

                $fileName = Str::random();
                if (env('MEDIA_S3', false)) {
                    $pdf = PDF::loadView('success-payment-application-page', $data, [], [
                        'title' => 'Another Title',
                        'margin_top' => 0
                    ]);

                    $filePath =  "storage/$fileName.pdf";
                    Storage::disk('s3')->put(
                        $filePath,
                        $pdf->output(),
                        [
                            'ACL' => 'public-read'
                        ]
                    );
                    $pdfUrl = env('MEDIA_SERVICE_HOST') ."/$filePath";
                } else {
                    PDF::loadView('success-payment-application-page', $data, [], [
                        'title' => 'Payment Receipt',
                        'margin_top' => 0
                    ])->save(storage_path() . '/app/public/' . $fileName . '.pdf');
                    $pdfUrl = env('APP_URL') . '/storage/' . $fileName . '.pdf';
                }
                return $fileName;
            }
    }
    //checked
    private function capture($amount, $merchantReference, $fortID)
    {
        $purchaseAmount = intval($amount * pow(10, 2));
        $arrData = array(
            'command' => 'CAPTURE',
            'access_code' => env("PAYFORT_ACCESS_CODE"),
            'merchant_identifier' => env("PAYFORT_MERCHANT_IDENTIFIER"),
            'merchant_reference' => $merchantReference,
            'amount' => $purchaseAmount,
            'currency' => 'SAR',
            'language' => 'ar',
            "fort_id" => $fortID
        );
        $arrData['signature'] = $this->calcPayfortSignature($arrData);
        $response = Http::post($this->endpointUrl, $arrData);
        $response = $response->json();
        return $response;
    }
    //checked
    public function calcPayfortSignature(array $params, $signature_type = 'request')
    {
        # Steps as listed in payfort documentation
        # 1
        ksort($params);
        # 2
        $combined_params = array_map(function ($k, $v) {
            return $k == 'signature' ? '' : "$k=$v";
        }, array_keys($params), array_values($params));
        # 3
        $joined_parameters = join('', $combined_params);
        # 4
        $salt = ($signature_type == 'response') ? env("PAYFORT_SHA_RESPONSE_PHRASE") : env("PAYFORT_SHA_REQUEST_PHRASE");
        $signature = sprintf('%s%s%s', $salt, $joined_parameters, $salt);
        # 5
        $signature = hash('sha256', $signature);

        return $signature;
    }
}