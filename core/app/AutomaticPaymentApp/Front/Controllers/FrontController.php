<?php

namespace App\AutomaticPaymentApp\Front\Controllers;

use App\AutomaticPaymentApp\Models\ParentDueBalance;
use App\BaseApp\Controllers\BaseController;
use App\BaseApp\Models\User;
use App\BaseApp\PayFort\Facades\Payfort;
use App\PaymentApp\Payments\Enums\BillTypeEnum;
use App\PaymentApp\Payments\Enums\PayFortStatusEnum;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class FrontController extends BaseController
{
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

        return view('new_payment.new-payment-page', [
            'url' => route('payments.getPaymentForm',$parentDue),
            'parentDue' =>$parentDue,
            'balance' => $parentDue->balance,
            'merchant_reference' => $random,
            'language' => app()->getLocale(),
        ]);
    }

    public function getPaymentForm(Request $request,ParentDueBalance $parentDue)
    {
        $amount = $request->amount;

        if (!$amount) {
            return view('error-page', [
                'errorMessage' => __('payment.errors.amount_required', [], app()->getLocale())
            ]);
        }
        if( ! $parentDue->exists()){
            {
                return view('error-page', [
                    'errorMessage' => __('payment.errors.parentDUeError', [], app()->getLocale())
                ]);
            }
        }
        $data = [
            'merchant_reference' => $request->merchant_reference,
            'amount' => $amount,
            'currency' => 'SAR',
            'customer_email' => $parentDue->email,
            'language' => app()->getLocale(),
        ];
        dd($data);
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
        if ($request->device_type == 'web') {
            //TODO Change the URL ENV key after hafez is done  testing
            $vue_URl = env('WEB_APP_URL')."/".$locale."/redirect/payment-return?pdf=".$pdfUrl;
            return redirect($vue_URl);
        }
        echo "<script>setTimeout(function(){ window.location.href = '{$pdfUrl}'; }, 1000);</script>";
        // return redirect(env('APP_URL').'/storage/'.$request->pdf.'.pdf');
    }

    public function processReturn(Request $request)
    {
//        if ($request->status == PayFortStatusEnum::SUCCESS) {
//            $response=  $this->capture($pendingPayment->amount, $request->merchant_reference, $request->fort_id);
//            if ($response['status'] == PayFortStatusEnum::CAPTURE_SUCCESS) {
//                $this->createPayment($response);
//                        $fileName = $this->processPdf($request->toArray());
//                        return Redirect::to(
//                            buildWebRoute('payment.get.processReturnPdf', [
//                                'pdf' => $fileName,
//                            ])
//                        );
//                    }
//
//        } else {
//            return view('error-page', [
//                'errorMessage' => $request->response_message,
//                'language' => app()->getLocale(),
//            ]);
//        }
    }

    //create pdf for payAll balance or bill
    private function processPdf($response)
    {

//        $amount = intval($response['amount'] * pow(10, 2));
//        $pendingPayment = PendingPayment::where('merchant_reference', $response['merchant_reference'])->first();
//        $billId = $pendingPayment->bill_id;
//        if ($billId) {
//            $bill = $this->billRepository->find($billId);
//            if ($bill->bill_type == BillTypeEnum::SCHOOL_SUBSCRIPTION) {
//                $childApplication = ChildApplication::find($bill->serviceable_id);
//                $parentUser = $childApplication->parent->user;
//                $items = $bill->serviceOrder->items;
//                foreach ($items as $item) {
//                    $item->name = $item->service->translateOrDefault($response['language'])->name;
//                }
//
//
//                $data = [
//                    'paid_amount' => $amount,
//                    'card_number' => $response['card_number'],
//                    'card_holder_name' => (isset($response['card_holder_name']) || !empty($response['card_holder_name']))  ?$response['card_holder_name'] : null,
//                    'expiry_date' => $response['expiry_date'],
//                    'payment_option' => $response['payment_option'],
//                    'response_message' => $response['response_message'],
//                    'fort_id' => $response['fort_id'],
//                    'first_name' => $childApplication->first_name,
//                    'last_name' => $childApplication->last_name,
//                    'parent_first_name' => $parentUser->first_name,
//                    'parent_last_name' => $parentUser->last_name,
//                    'bill_amount' => $bill->amount,
//                    'amount_with_vat' => $bill->amount_with_vat,
//                    'vat' => $bill->vat,
//                    'bill_reaming' => ($bill->amount_with_vat - $amount),
//                    'items' => $items,
//                    'language' => $response['language'],
//
//
//                ];
//
//                $fileName = Str::random();
//                if (env('MEDIA_S3', false)) {
//                    $pdf = PDF::loadView('success-payment-application-page', $data, [], [
//                        'title' => 'Another Title',
//                        'margin_top' => 0
//                    ]);
//
//                    $filePath =  "storage/$fileName.pdf";
//                    Storage::disk('s3')->put(
//                        $filePath,
//                        $pdf->output(),
//                        [
//                            'ACL' => 'public-read'
//                        ]
//                    );
//                    $pdfUrl = env('MEDIA_SERVICE_HOST') ."/$filePath";
//                } else {
//                    PDF::loadView('success-payment-application-page', $data, [], [
//                        'title' => 'Another Title',
//                        'margin_top' => 0
//                    ])->save(storage_path() . '/app/public/' . $fileName . '.pdf');
//                    $pdfUrl = env('APP_URL') . '/storage/' . $fileName . '.pdf';
//                }
//                return $fileName;
//            }
//        }
//        $user = User::find($pendingPayment->payer_id);
//        $data = [
//            'paid_amount' => $amount,
//            'card_number' => $response['card_number'],
//            'card_holder_name' => $response['card_holder_name'] ?? '',
//            'expiry_date' => $response['expiry_date'],
//            'payment_option' => $response['payment_option'],
//            'response_message' => $response['response_message'],
//            'fort_id' => $response['fort_id'],
//            'first_name' => $user->first_name,
//            'last_name' => $user->last_name,
//            'language' => $response['language'],
//
//        ];
//        $fileName = Str::random();
//        if (env('MEDIA_S3', false)) {
//            $pdf = PDF::loadView('success-payment-page-pdf', $data, [], [
//                'title' => 'Another Title',
//                'margin_top' => 0
//            ]);
//
//            $filePath =  "storage/$fileName.pdf";
//            Storage::disk('s3')->put(
//                $filePath,
//                $pdf->output(),
//                [
//                    'ACL' => 'public-read'
//                ]
//            );
//            $pdfUrl = env('MEDIA_SERVICE_HOST') ."/$filePath";
//        } else {
//            PDF::loadView('success-payment-page-pdf', $data, [], [
//                'title' => 'Another Title',
//                'margin_top' => 0
//            ])->save(storage_path() . '/app/public/' . $fileName . '.pdf');
//            $pdfUrl = env('APP_URL') . '/storage/' . $fileName . '.pdf';
//        }
//        return $fileName;
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