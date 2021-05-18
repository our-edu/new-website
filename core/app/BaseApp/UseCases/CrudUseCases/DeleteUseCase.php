<?php

declare(strict_types = 1);

namespace App\BaseApp\UseCases\CrudUseCases;

class DeleteUseCase implements DeleteUseCaseInterface
{
    protected $repository;
    protected $deleteRelated = [];

    public function delete($id)
    {
        $thisObject = $this->repository->find($id);
        $delete = $this->repository->delete($id);
        foreach ($this->deleteRelated as $related) {
            $valuesArray = explode('.', $related['id']);
            $result = $thisObject;
            foreach ($valuesArray as $value) {
                $result = $result[$value];
            }
            $detailId = $result;
            if ($related['repository'] != null) {
                $related['repository']->delete($detailId);
            } elseif ($related['model'] != null) {
                $related['model']->destroy($detailId) ;
            } else {
                continue;
            }
        }
        return $delete;
    }
}
