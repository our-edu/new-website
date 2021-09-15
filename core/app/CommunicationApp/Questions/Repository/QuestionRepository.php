<?php

namespace App\CommunicationApp\Questions\Repository;

use App\BaseApp\Repository\Repository as RepositoryAlias;
use App\CommunicationApp\Questions\Models\Question;

class QuestionRepository extends RepositoryAlias implements QuestionRepositoryInterface
{
    public function model(): string
    {
        return Question::class;
    }

    public function find($id, $columns = ['*']): Question
    {
        return parent::find($id, $columns);
    }
}