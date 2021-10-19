<?php

namespace Database\Seeders;

use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Exception;
use Illuminate\Database\Seeder;

class DropAllAnnouncements extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return string
     */
    public function run()
    {
        Announcement::truncate();
    }
}
