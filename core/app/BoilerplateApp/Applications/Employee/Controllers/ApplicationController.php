<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BoilerplateApp\Applications\Employee\Transformers\ListApplicationTransformer;
use App\BoilerplateApp\Applications\Repository\ApplicationRepositoryInterface;

class ApplicationController extends BaseApiController
{
    protected ApplicationRepositoryInterface $repository;
    protected string $ModelName = 'ChildApplication';
    protected string $ResourceType = ResourceTypesEnums::APPLICATION;
    protected $user;

    public function __construct(
        ApplicationRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        $this->user = auth()->guard('api')->user();
    }

    public function index()
    {
        $items = $this->repository->getFilteredApplicationsPaginate(request(), $this->user->schoolEmployee->branch_id);

        return $this->transformDataModInclude(
            $items,
            '',
            new ListApplicationTransformer(),
            $this->ResourceType,
            filtersObject([

                mapFiltersArrayFromModels(
                    'national_id',
                    trans('app.labels.national_id'),
                    'textbox'
                ),

            ])
        );
    }
}
