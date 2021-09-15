<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Questions\Employee\Requests\QuestionRequest;
use App\CommunicationApp\Questions\Employee\Transformers\ListQuestionsTransformer;
use App\CommunicationApp\Questions\Employee\Transformers\QuestionTransformer;
use App\CommunicationApp\Questions\Repository\QuestionRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class QuestionsController extends BaseApiController
{
    public QuestionRepositoryInterface  $repository;
    protected string $ModelName = 'Question';
    protected string $ResourceType = ResourceTypesEnums::QUESTION;

    /**
     * @param QuestionRepositoryInterface $repository
     */
    public function __construct(QuestionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array|array[]|JsonResponse
     */
    public function index()
    {
        $questions = $this->repository->paginate();
        return $this->transformDataModInclude($questions, '', new  ListQuestionsTransformer(), $this->ResourceType);

    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function show($id)
    {
        $question = $this->repository->find($id);
        return $this->transformDataModInclude($question, '', new  QuestionTransformer(), $this->ResourceType);
    }

    /**
     * @param QuestionRequest $request
     * @return array|array[]|JsonResponse
     */
    public function store(QuestionRequest $request)
    {

        try {
            $data = $request->data['attributes'];
            $createdQuestion  = $this->repository->create($data);

            return $this->transformDataModInclude($createdQuestion, '', new  QuestionTransformer(), $this->ResourceType,[
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  was  created successfully')
                ]
            ]);

        }catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  wasn\'t  created '),
                    'error'=> $exception->getMessage()
                ]
            ],400);
        }


    }

    /**
     * @param $id
     * @param QuestionRequest $request
     * @return array|array[]|JsonResponse
     */
    public function update($id, QuestionRequest $request)
    {
        try{
            $data = $request->data['attributes'];
            $question =  $this->repository->find($id);
            $question->update($data);

            return $this->transformDataModInclude($question, '', new  QuestionTransformer(), $this->ResourceType,[
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  was  updated successfully')
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  wasn\'t  updated '),
                    'error'=> $exception->getMessage()
                ]
            ],400);
        }

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->repository->find($id)->delete();
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  was deleted '),
                ]
            ]);
        }catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  wasn\'t  deleted '),
                    'error'=> $exception->getMessage()
                ]
            ],400);
        }

    }
}
