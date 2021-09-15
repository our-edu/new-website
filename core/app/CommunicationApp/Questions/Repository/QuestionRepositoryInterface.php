<?php

namespace App\CommunicationApp\Questions\Repository;

use App\BaseApp\Repository\BaseRepositoryInterface;
use App\CommunicationApp\Questions\Models\Question;

interface QuestionRepositoryInterface extends BaseRepositoryInterface
{
    public  function find($id, $columns = ['*']) : Question;
}