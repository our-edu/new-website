<?php
declare(strict_types=1);

namespace App\BaseApp\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Traits\Uuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

class ParentUser extends BaseModel
{
    use Uuids, SoftDeletes, PostgisTrait;

    /***
     * @var string[]
     */

    protected $fillable = [
        "user_uuid",
        "location_point"
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
     * relation get user of parent
     * @return BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uuid');
    }

    /**
     * @return MorphOne
     */
    public function location(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         * */
        return $this->morphOne(Location::class, 'related');
    }



    public function setLocationPointAttribute($value)
    {
        $point = explode(',', $value);
        $this->attributes['location_point'] = new Point($point[1], $point[0]);
    }

    public function getLocationPointAttribute($value)
    {
        return $value ? $value->toPair() : "";
    }
}
