<?php

declare(strict_types = 1);
namespace App\CommunicationApp\Questions\UseCases\DeleteUseCases;

use App\CommunicationApp\Questions\Models\Question;

class DeleteQuestionUseCase implements DeleteQuestionUseCaseInterface
{

    /**
     * @param Question $question
     * @return array
     */
    public function checkAnswers(Question $question): array
    {
        if ($question->answer()->exists()) {
            return   [
            'errors' => [
               'status' => 422,
               'detail' => __("questions.can't_delete_question_msg"),
               'title' => "can't_delete_question",
            ]
            ];
        }
        return [];
    }
}
