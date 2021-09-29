<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\UseCases\DeleteUseCases;

use App\CommunicationApp\Questions\Models\Question;

interface DeleteQuestionUseCaseInterface
{
    public function checkAnswers(Question $question):array;
}
