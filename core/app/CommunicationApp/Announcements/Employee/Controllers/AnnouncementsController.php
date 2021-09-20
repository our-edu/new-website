<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\User;
use App\CommunicationApp\Announcements\Employee\Requests\AnnouncementRequest;
use App\CommunicationApp\Announcements\Employee\Transformers\AnnouncementTransformer;
use App\CommunicationApp\Announcements\Employee\Transformers\BranchesFilterTransformer;
use App\CommunicationApp\Announcements\Employee\Transformers\EmployeesUsersFilterTransformer;
use App\CommunicationApp\Announcements\Employee\Transformers\ListAnnouncementsTransformer;
use App\CommunicationApp\Announcements\Repository\AnnouncementRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class AnnouncementsController extends BaseApiController
{
    public AnnouncementRepositoryInterface  $repository;
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
     * @return array|array[]|JsonResponse
     */
    public function index()
    {
        $announcements = $this->repository->with([
            'branches',
            'roles',
            'publisher',
            'translations',
        ])->filterData()->paginate();
        return $this->transformDataModInclude($announcements, '', new  ListAnnouncementsTransformer(), $this->ResourceType, $this->includeDefault());
    }

    public function includeDefault()
    {

        $actions['create_employee'] = [
            'endpoint_url' => buildScopeRoute('api.employee.announcements.store'),
            'label' => trans('app.create-school-employees'),
            'method' => 'POST',
            'key' => APIActionsEnums::CREATE_ANNOUNCEMENT
        ];
        $actions['filter'] = [
            'endpoint_url' => buildScopeRoute('api.employee.announcements.index.filters'),
            'label' => trans('app.filter-announcement'),
            'method' => 'GET',
            'key' => APIActionsEnums::FILTER_ANNOUNCEMENTS
        ];
        $actions['export'] = [
            'endpoint_url' => buildScopeRoute('api.employee.announcements.index.export'),
            'label' => trans('app.export-announcement'),
            'method' => 'GET',
            'key' => APIActionsEnums::EXPORT_ANNOUNCEMENTS
        ];
        return ['default_actions' => $actions];
    }

    /***
     * @return array|array[]|\Illuminate\Http\JsonResponse
     */
    public function indexFilters()
    {
        return response()->json([
            'meta' => filtersObject([
                mapFiltersArrayFromModels(
                    'branch',
                    trans('app.label.branches'),
                    'dropdown',
                    auth('api')->user()->schoolEmployee->branches()->with(['translations'])->get(),
                    new BranchesFilterTransformer()
                ),
                mapFiltersArrayFromModels(
                    'publisher',
                    trans('app.label.publisher'),
                    'dropdown',
                    User::where('type', UserTypeEnum::EMPLOYEE)->get(),
                    new EmployeesUsersFilterTransformer()
                ),
            ])
        ]);
    }

    /**
     * @return array|array[]|JsonResponse
     */
    public function export()
    {
        return $this->repository->with([
            'branches',
            'roles',
            'publisher',
            'translations',
        ])->export();
    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function show($id)
    {
        $announcement = $this->repository->find($id);
        return $this->transformDataModInclude($announcement, '', new  AnnouncementTransformer(), $this->ResourceType);
    }

    /**
     * @param AnnouncementRequest $request
     * @return array|array[]|JsonResponse
     */
    public function store(AnnouncementRequest $request)
    {

        try {
            $data = $request->data['attributes'];
            $data['status'] = 1;
            $data['publisher_uuid'] = auth('api')->user()->uuid;
            $createdAnnouncement  = $this->repository->create($data);
            $createdAnnouncement->branches()->attach($data['branches']);
            $createdAnnouncement->roles()->attach($data['roles']);
            $createdAnnouncement->loadMissing(['branches', 'roles', 'translations']);
            return $this->transformDataModInclude($createdAnnouncement, '', new  AnnouncementTransformer(), $this->ResourceType, [
                'message' => trans('announcements.' . $this->ModelName . '  was  created successfully')
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => trans('announcements.' . $this->ModelName . '  wasn\'t  created '),
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @param $id
     * @param AnnouncementRequest $request
     * @return array|array[]|JsonResponse
     */
    public function update($id, AnnouncementRequest $request)
    {
        try {
            $data = $request->data['attributes'];
            $announcement =  $this->repository->find($id);
            $announcement->update($data);

            return $this->transformDataModInclude($announcement, '', new  AnnouncementTransformer(), $this->ResourceType, [
                'message' => trans('announcements.' . $this->ModelName . '  was  updated successfully')
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => trans('announcements.' . $this->ModelName . '  wasn\'t  updated '),
                'error'=> $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->repository->find($id)->delete();
            return response()->json([
                'meta' => [
                    'message' => trans('announcements.' . $this->ModelName . '  was deleted '),
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('announcements.' . $this->ModelName . '  wasn\'t  deleted '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
}
