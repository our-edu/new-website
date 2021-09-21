<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Repository;

use App\BaseApp\Repository\Repository as RepositoryAlias;
use App\CommunicationApp\Complains\Models\Complain;
use App\CommunicationApp\Questions\Models\QuestionAnswers;
use Prettus\Validator\Exceptions\ValidatorException;

class ComplainRepository extends RepositoryAlias implements ComplainRepositoryInterface
{
    public function model(): string
    {
        return Complain::class;
    }
    public function addQuestionnaireAnswers(Complain $complain, $answers)
    {
        try {
            foreach ($answers as $answer) {
                QuestionAnswers::create([
                    'value' => $answer['answer'],
                    'complain_uuid' => $complain->uuid,
                    'parent_uuid' => auth('api')->user()->parent->uuid,
                    'question_uuid' => $answer['question_uuid'],
                ]);
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    /**
     * @param $id
     * @param array|string[] $columns
     * @return Complain
     */

    public function find($id, $columns = ['*']): Complain
    {
        return parent::find($id, $columns);
    }

    /**
     * @param array $attributes
     * @return Complain
     * @throws ValidatorException
     */
    public function create(array $attributes): Complain
    {
        return parent::create($attributes);
    }

    /**
     * @param array $attributes
     * @param $id
     * @return Complain
     * @throws ValidatorException
     */
    public function update(array $attributes, $id): Complain
    {
        return  parent::update($attributes, $id);
    }
}
