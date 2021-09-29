<?php

declare(strict_types = 1);

use App\CommunicationApp\Questions\Models\Question;

interface DeleteQuestionUseCaseInterface
{
    public function checkAnswers(Question $question):array;
}
