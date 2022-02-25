<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(file_get_contents(base_path() . '/database/seeders/sql/department_types.sql'));
        DB::unprepared(file_get_contents(base_path() . '/database/seeders/sql/departments.sql'));
        DB::unprepared(file_get_contents(base_path() . '/database/seeders/sql/positions.sql'));
        DB::unprepared(file_get_contents(base_path() . '/database/seeders/sql/staff.sql'));
        DB::unprepared(file_get_contents(base_path() . '/database/seeders/sql/employee_staff.sql'));
        DB::unprepared(file_get_contents(base_path() . '/database/seeders/sql/task_types.sql'));
        DB::unprepared(file_get_contents(base_path() . '/database/seeders/sql/task_statuses.sql'));
        DB::unprepared(file_get_contents(base_path() . '/database/seeders/sql/task_priorities.sql'));
        DB::unprepared(file_get_contents(base_path() . '/database/seeders/sql/task_history_types.sql'));
        DB::unprepared(file_get_contents(base_path() . '/database/seeders/sql/task_relation_types.sql'));

        DB::statement(file_get_contents(base_path() . '/database/views/create_phrases_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/create_extra_columns_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/create_employees_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/create_hr_department_types_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/create_hr_positions_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/create_hr_employee_staff_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/create_hr_departments_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/create_hr_staff_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/create_tm_tasks_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/create_tm_related_employees_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/create_tm_employee_tasks_view.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement(file_get_contents(base_path() . '/database/views/drop_department_types_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/drop_departments_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/drop_employees_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/drop_phrases_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/drop_positions_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/drop_extra_columns_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/drop_employee_staff_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/drop_staff_positions_view.sql'));
        DB::statement(file_get_contents(base_path() . '/database/views/drop_staff_view.sql'));
        //
        //
    }
}
