<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Transformers;

use App\BaseApp\Enums\ResourceTypesEnums;
use App\BoilerplateApp\Applications\Models\ChildApplication;
use League\Fractal\TransformerAbstract;

class ApplicationDetailsTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'busInfo',
        'serviceInfo',
        'employeesInfo'
    ];
    protected $availableIncludes = [
    ];

    private $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * @param ChildApplication $childApplication
     * @return array (mixed|string)[]
     * @psalm-return 'array{branch_name: mixed, child_image: "https://www.btklsby.go.id/images/placeholder/nogender.png"|mixed, class: mixed|null, class_leader: mixed|null, grade: mixed|null, id: string, parent_name: mixed|null, pdf: non-empty-string, student_name: string}
     */
    public function transform(ChildApplication $childApplication): array
    {
        $transformerData = [
            'id' => $childApplication->uuid,
            'student_name' => $childApplication->child_name,
            'child_image' => $childApplication->childImage()->exists() ? $childApplication->childImage->url : 'https://www.btklsby.go.id/images/placeholder/nogender.png',
            'branch_name' => $childApplication->branch->name,
            'grade' => $childApplication->grade()->exists() ? $childApplication->grade->name : null,
            'class' => $childApplication->classRoom()->exists() ? $childApplication->classRoom->name : null,
            'class_leader' => $childApplication->classRoom->teacher()->exists() ? $childApplication->classRoom->teacher->user->name : null,
            'parent_name' => $childApplication->parent()->exists() ? $childApplication->parent->user->name : null,
             'pdf'=>env("APP_URL")."/storage/".$childApplication->uuid.".pdf"

        ];
        return $transformerData;
    }
    public function includeBusInfo(ChildApplication $childApplication)
    {
        if ($childApplication->busRoute()->exists()) {
            return $this->item(
                $childApplication,
                new ApplicationBusDetailsTransformer(),
                ResourceTypesEnums::BUS
            );
        }
    }
    public function includeServiceInfo(ChildApplication $childApplication)
    {
        if ($childApplication->serviceOrder->services()->exists()) {
            return $this->collection(
                $childApplication->serviceOrder->services()->get(),
                new ApplicationServiceTransformer(),
                ResourceTypesEnums::SERVICE
            );
        }
    }
    public function includeEmployeesInfo(ChildApplication $childApplication)
    {
        if ($childApplication->branch->employees()->exists()) {
            return $this->collection(
                $childApplication->branch->employees()->get(),
                new ApplicationBranchEmployeeTransformer(),
                ResourceTypesEnums::SCHOOL_EMPLOYEE
            );
        }
    }
}
