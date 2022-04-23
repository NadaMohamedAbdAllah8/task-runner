<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('task_types')->count() == 0) {
            DB::table('task_types')->insert(
                [
                    array(
                        'id' => 1,
                        'type' => 'count words',
                    ),
                    array(
                        'id' => 2,
                        'type' => 'count characters',
                    ),
                    array(
                        'id' => 3,
                        'type' => 'count lines',
                    ),
                ]
            );
        }
    }
}