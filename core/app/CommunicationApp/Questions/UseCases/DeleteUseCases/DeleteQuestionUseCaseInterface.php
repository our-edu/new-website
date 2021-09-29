<?php

use App\CommunicationApp\Questions\Models\Question;

interface DeleteQuestionUseCaseInterface
{
    public function checkAnswers(Question $question):array;
}