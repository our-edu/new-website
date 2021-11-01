<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Parent\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Models\Student;
use App\CommunicationApp\Complains\Enums\ComplainCategoriesEnum;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Complains\Parent\Requests\ComplainRequest;
use App\CommunicationApp\Complains\Parent\Requests\ConfirmComplainRequest;
use App\CommunicationApp\Complains\Parent\Requests\RejectComplainRequest;
use App\CommunicationApp\Complains\Parent\Transformers\ComplainCategoryTransformer;
use App\CommunicationApp\Complains\Parent\Transformers\ComplainTransformer;
use App\CommunicationApp\Complains\Parent\Transformers\ListComplainsTransformer;
use App\CommunicationApp\Complains\Repository\ComplainRepositoryInterface;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class ComplainsController extends BaseApiController
{
    public ComplainRepositoryInterface  $repository;
    protected string $ModelName = 'Complain';
    protected string $ResourceType = ResourceTypesEnums::COMPLAIN;

    /**
     * @param ComplainRepositoryInterface $repository
     */
    public function __construct(ComplainRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array|array[]|JsonResponse
     */
    public function index()
    {
        $authenticatedParent = auth('api')->user()->parent->uuid;
        $complains = $this->repository->where('parent_uuid', $authenticatedParent)->paginate();
        return $this->transformDataModInclude($complains, '', new  ListComplainsTransformer(), $this->ResourceType);
    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function show($id)
    {
        $complain = $this->repository->find($id);
        return $this->transformDataModInclude($complain, '', new  ComplainTransformer(), $this->ResourceType);
    }

    /**
     * @param ComplainRequest $request
     * @return array|array[]|JsonResponse
     */
    public function store(ComplainRequest  $request)
    {
        try {
            $data = $request->data['attributes'];
            $data['status'] =  ComplainStatusesEnum::OPENED_EN;
            $data['parent_uuid'] = auth('api')->user()->parent->uuid;
            $data['branch_uuid'] = Student::find($data['student_uuid'])->branch_id;
            $questionnaireStatus = GeneralSettings::where('key', GeneralSettingsEnum::QUESTIONNAIRE_STATUS_KEY)->first()->value;
            DB::beginTransaction();
            $createdComplain  = $this->repository->create($data);
            $createdComplain->statuses()->create([
                'name' => $data['status'],
                'user_uuid'=> auth('api')->user()->uuid,
            ]);
            if (isset($data['questions_answers']) && $questionnaireStatus != GeneralSettingsEnum::QUESTIONNAIRE_DISABLE) {
                $answers = $data['questions_answers'];
                $this->repository->addQuestionnaireAnswers($createdComplain, $answers);
            }
            DB::commit();
            return $this->transformDataModInclude($createdComplain, '', new  ComplainTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('complains.was created successfully', ['module_name' => __('complains.'.$this->ModelName)])
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return response()->json([
                'meta' => [
                    'message' => trans('complains.wasn’t created', ['module_name' => __('complains.'.$this->ModelName)]),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
    public function getCategoriesLookup()
    {
        $categories = ComplainCategoriesEnum::getCategories();
        return $this->transformDataModInclude($categories, '', new  ComplainCategoryTransformer(), ResourceTypesEnums::COMPLAIN_CATEGORY);
    }

    /**
     * @param $id
     * @param ConfirmComplainRequest $request
     * @return array|array[]|JsonResponse
     */
    public function confirm($id, ConfirmComplainRequest $request)
    {
        try {
            $data = $request->data['attributes'];
            $complain = $this->repository->find($id);
            $parent = auth('api')->user()->uuid;
            $complain->update($data);
            $complain->statuses()->create([
                'name' => ComplainStatusesEnum::CONFIRMED_EN,
                'user_uuid' => $parent
            ]);
            return $this->transformDataModInclude($complain, '', new  ComplainTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('complains.was Confirmed successfully', ['module_name' => __('complains.'.$this->ModelName)])
                ]
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'meta' => [
                    'message' => trans('complains.wasn\'t  Confirmed', ['module_name' => __('complains.'.$this->ModelName)]),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }

    /**
     * @param $id
     * @param RejectComplainRequest $request
     * @return array|array[]|JsonResponse
     */
    public function reject($id, RejectComplainRequest $request)
    {

        try {
            $data = $request->data['attributes'];
            $complain = $this->repository->find($id);
            $parent = auth('api')->user()->uuid;
            $complain->update($data);
            $complain->statuses()->create([
                'name' => ComplainStatusesEnum::REJECTED_EN,
                'user_uuid' => $parent,
                'reason' => $data['reason']
            ]);
            return $this->transformDataModInclude($complain, '', new  ComplainTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('complains.was rejected successfully', ['module_name' => __('complains.'.$this->ModelName)])
                ]
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'meta' => [
                    'message' => trans('complains.wasn\'t  rejected', ['module_name' => __('complains.'.$this->ModelName)]),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
}
