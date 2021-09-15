<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Questions\Repository\QuestionRepositoryInterface;

class QuestionsController extends BaseApiController
{
    public QuestionRepositoryInterface  $repository;
    protected string $ModelName = 'Questions';
    protected string $ResourceType = ResourceTypesEnums::QUESTION;

    public function __construct(QuestionRepositoryInterface  $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
    }

    public function store()
    {
    }
    public function update()
    {
    }
    public function destroy()
    {
    }
}
