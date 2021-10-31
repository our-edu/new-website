<?php

namespace Database\Seeders;

use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Complains\Models\Complain;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Exception;
use Illuminate\Database\Seeder;

class AddBranchuuidToComplains extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return string
     */
    public function run()
    {
      try{
          $complains = Complain::all();
          foreach ($complains as $complain){
              $branch_uuid = $complain->student->branch_id;
              $complain->update([
                  'branch_uuid' => $branch_uuid
              ]);
          }
      }  catch (Exception $exception){
         var_dump('not seeded');
      }
    }
}
