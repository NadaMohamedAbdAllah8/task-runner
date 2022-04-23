<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('task_statuses')->count() == 0) {
            DB::table('task_statuses')->insert(
                [
                    array(
                        'id' => 1,
                        'status' => 'running',
                    ),
                    array(
                        'id' => 2,
                        'status' => 'pass',
                    ),
                    array(
                        'id' => 3,
                        'status' => 'fail',
                    ),
                ]
            );
        }
    }
}
