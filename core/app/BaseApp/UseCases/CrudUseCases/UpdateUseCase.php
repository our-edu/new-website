<?php

namespace App\BaseApp\UseCases\CrudUseCases;

class UpdateUseCase implements UpdateUseCaseInterface
{
    protected $repository;
    protected $requestDetails = [];

    public function update($request, $id)
    {
        if ($this->requestDetails == []) {
            return $this->repository->update($request->data['attributes'], $id);
        }
        $thisObject = $this->repository->find($id);
        foreach ($this->requestDetails as $name => $detail) {
            $valuesArray = explode('.', $detail['id']);
            $result = $thisObject;
            foreach ($valuesArray as $value){
                $result = $result[$value];
            }
            $detailId = $result;
            if ($detail['repository'] != null) {
                $db = $detail['repository'];
                $data = [];
            } elseif ($detail['model'] != null) {
                $db = $detail['model'];
                $data = $db->find($detailId);
            } else {
                continue;
            }
            if (isset($detail['data_from_request'])) {
                foreach ($detail['data_from_request'] as $key => $values) {
                    $valuesArray = explode('.', $values);
                    $result = $request->data['attributes'];
                    foreach ($valuesArray as $value){
                        $result = $result[$value];
                    }
                    $data[$key] = $result;
                }
            }
            if (isset($detail['other_data'])) {
                foreach ($detail['other_data'] as $key => $value) {
                    $data[$key] = $value;
                }
            }
            if (isset($detail['data_from_detail'])) {
                foreach ($detail['data_from_detail'] as $key => $value) {
                    $values = explode('.', $value);
                    $data[$key] = $this->requestDetails[$values[0]]['created_data'][$values[1]];
                }
            }
            if ($detail['repository'] != null) {
                $this->requestDetails[$name]['created_data'] = $db->update($data,$detailId);
            }else{
                $data->save();
                $this->requestDetails[$name]['created_data'] = $data;
            }
        }
        return $this->requestDetails['this']['created_data'];
    }
}