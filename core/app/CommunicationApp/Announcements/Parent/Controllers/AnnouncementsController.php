<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Parent\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Models\Student;
use App\CommunicationApp\Announcements\Parent\Transformers\ViewAnnouncementsTransformer;
use App\CommunicationApp\Announcements\Repository\AnnouncementRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class AnnouncementsController extends BaseApiController
{
    public AnnouncementRepositoryInterface $repository;
    protected string $ModelName = 'Announcement';
    protected string $ResourceType = ResourceTypesEnums::ANNOUNCEMENT;

    /**
     * @param AnnouncementRepositoryInterface $repository
     */
    public function __construct(AnnouncementRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function viewWeb()
    {
        $branchesUuids = Student::whereHas('parents', function ($query) {
            $query->where('uuid', auth('api')->user()->parent->uuid);
        })->distinct('branch_id')->pluck('branch_id');
        $today = Carbon::today()->toDate()->format('Y-m-d');
        $announcements = $this->repository->with(['translations', 'webImage'])->whereHas('branches',
            function ($query) use ($branchesUuids) {
                $query->whereIn('uuid', $branchesUuids);
            })->where('from', '<=', $today)->where('to', '>=', $today)->get();
//        dd($today, $branchesUuids, $announcements);
        return $this->transformDataModInclude($announcements, '', new  ViewAnnouncementsTransformer(['device_type' => 'web']), $this->ResourceType);
    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function viewMobile()
    {
        $branchesUuids = Student::whereHas('parents', function ($query) {
            $query->where('uuid', auth('api')->user()->parent->uuid);
        })->distinct('branch_id')->pluck('branch_id');
        $today = Carbon::today()->toDate()->format('Y-m-d');
        $announcements = $this->repository->with(['translations', 'mobileImage'])->whereHas('branches',
            function ($query) use ($branchesUuids) {
                $query->whereIn('uuid', $branchesUuids);
            })->where('from', '<=', $today)->where('to', '>=', $today)->get();
        if($announcements->count() >  0){
            $index = rand(0, count($announcements)-1);
            $announcements = $announcements[$index];
        }else {
            $announcements = new \stdClass();
        }
        return $this->transformDataModInclude($announcements, '', new  ViewAnnouncementsTransformer(['device_type' => 'mobile']), $this->ResourceType);
    }
}
