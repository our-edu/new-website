<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentActivitiesReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->dropView());
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }

    private function dropView(): string
    {
        return "DROP VIEW IF EXISTS parent_activity_report ";

    }

    private function createView(): string
    {
        return "CREATE VIEW parent_activity_report AS
                select pu.uuid  as parent_uuid, COALESCE(complains_inner_count,0) as complains_count, COALESCE(visits_inner_count,0) as visits_count,COALESCE( calls_inner_count,0) as calls_count
                from parent_users pu
                left join (
                    select parent_uuid, count(*) as complains_inner_count
                    from complains
                    group by parent_uuid
                    ) as c
                on  pu.uuid = c.parent_uuid
                left join
                    (
                        select parent_uuid,count(*) as visits_inner_count
                        from communications_log
                        where type = 'visits'
                        group by parent_uuid
                        ) as v
                on  pu.uuid  = v.parent_uuid
                left join
                    (
                        select parent_uuid,count(*) as calls_inner_count
                        from communications_log
                        where type = 'calls'
                        group by parent_uuid
                        ) as ca
                on  pu.uuid = ca.parent_uuid";
    }
}
