<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Questions\Employee\Requests\QuestionRequest;
use App\CommunicationApp\Questions\Repository\QuestionRepositoryInterface;
use Log;

class QuestionsController extends BaseApiController
{
    public QuestionRepositoryInterface  $repository;
    protected string $ModelName = 'Question';
    protected string $ResourceType = ResourceTypesEnums::QUESTION;

    public function __construct(QuestionRepositoryInterface  $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
    }

    public function store(QuestionRequest $request)
    {

        $data = $request->data['attributes'];
        try {
            $this->repository->create($data);
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  was  created successfully')
                ]
            ]);
        }catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  wasn\'t  created '),
                    'error'=> $exception->getMessage()
                ]
            ],400);
        }


    }
    public function update()
    {
    }
    public function destroy()
    {
    }
}
