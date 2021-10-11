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
        return "
                CREATE VIEW parent_activity_report AS
                select  DISTINCT pu.uuid  as parent_uuid,
                                pu.branch_id as branch,
                                COALESCE(complains_inner_count,0) as complains_count,
                                COALESCE(visits_inner_count,0) as visits_count,
                                COALESCE( calls_inner_count,0) as calls_count
                from (
                    select parent.uuid , s.branch_id,parent.deleted_at
                    from parent_users parent
                    join parent_student ps on parent.uuid = ps.parent_uuid
                    join students s on  s.uuid = ps.student_uuid
                         ) as pu
                left join (
                    select parent_uuid, count(*) as complains_inner_count,branch_uuid
                    from complains
                    group by parent_uuid,branch_uuid
                    ) as c
                on  ( pu.uuid = c.parent_uuid and pu.branch_id = c.branch_uuid)
                left join
                    (
                        select parent_uuid,count(*) as visits_inner_count,branch_uuid
                        from communications_log
                        where type = 'visits'
                        group by parent_uuid,branch_uuid
                        ) as v
                on  ( pu.uuid  = v.parent_uuid and pu.branch_id = v.branch_uuid)
                left join
                    (
                        select parent_uuid,count(*) as calls_inner_count,branch_uuid
                        from communications_log
                        where type = 'calls'
                        group by parent_uuid,branch_uuid
                        ) as ca
                on  (pu.uuid = ca.parent_uuid and pu.branch_id = ca.branch_uuid)
                where pu.deleted_at is null";
    }
}
