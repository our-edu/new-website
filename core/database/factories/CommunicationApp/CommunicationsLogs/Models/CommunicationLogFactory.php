<?php


namespace Database\Factories\CommunicationApp\CommunicationsLogs\Models;

use App\BaseApp\Models\Branch;
use App\BaseApp\Models\ParentUser;
use App\CommunicationApp\CommunicationsLogs\Models\CommunicationLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunicationLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommunicationLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => 'calls',
            'reason'=> $this->faker->word,
            'parent_uuid'=> ParentUser::factory()->create()->uuid,
            'date'=>Carbon::now(),
            'procedure'=> null,
            'branch_uuid'=>Branch::first()->uuid
        ];
    }
}
