<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use App\BaseApp\BaseModel;
use App\CommunicationApp\Announcements\Models\Announcement;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

class Branch extends BaseModel
{
    use Translatable, SoftDeletes,PostgisTrait;


    /**
     * filllable attribute to this model
     * @var string[]
     */
    protected $fillable = [
        'school_uuid',
        'max_number_of_student',
        'gender',
        'location_point',
        'compound_uuid'

    ];

    protected $postgisFields = [
        'location_point',
    ];


    protected $postgisTypes = [
        'location_point' => [
            'geomtype' => 'geography',
            'srid' => 4326
        ],
    ];
    /**
     * return relations with Model collection
     * @var string[]
     */


    /**
     * Translation Model
     */
    public $translationModel = BranchTranslation::class;
    /**
     * translatable Attributes
     * @var string[]
     */
    protected $translatedAttributes = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function location()
    {
        return $this->morphOne(Location::class, 'related');
    }

    /**
     * @return BelongsToMany
     */
    public function employees() :BelongsToMany
    {
        return $this->belongsToMany(SchoolEmployee::class, 'branches_employees', "branch_id", "employee_id");
    }

    /**
     * @return BelongsToMany
     */

    public function managers() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'branches_managers', 'branch_uuid', 'manager_uuid');
    }


    public function setLocationPointAttribute($value)
    {
        $point = explode(',', $value);
        $this->attributes['location_point'] = new Point($point[0], $point[1]);
    }

    public function getLocationPointAttribute($value)
    {
        return $value ? $value->toPair() : "";
    }

    public function roles() : HasMany
    {
        return $this->hasMany(Role::class, 'branch_uuid');
    }

    /**
     * @return BelongsToMany
     */
    public function announcements() : BelongsToMany
    {
        return $this->belongsToMany(Announcement::class, 'announcements_branches', 'branch_uuid', 'announcement_uuid');
    }
}
