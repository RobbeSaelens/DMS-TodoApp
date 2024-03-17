<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todos = [
            [
                'title' => 'Prepare presentation',
                'description' => 'Preparing a presentation about new product launch.',
                'status' => 'completed'
            ],
            [
                'title' => 'Buy groceries',
                'description' => 'Purchase fruits, vegetables, bread, and milk.',
                'status' => 'completed'
            ],
            [
                'title' => 'File a tax return',
                'description' => 'Completing the tax return before the end of the month.',
                'status' => 'in-progress'
            ],
            [
                'title' => 'To play sports',
                'description' => '30 minutes of jogging in the park.',
                'status' => 'completed'
            ],
            [
                'title' => 'Hairdresser appointment',
                'description' => 'Make an appointment for a haircut at the hairdresser.',
                'status' => 'in-progress'
            ],
            [
                'title' => 'Finish project proposal',
                'description' => 'Complete the project proposal document for client meeting',
                'status' => 'completed'
            ],
            [
                'title' => 'Patching a bicycle tire',
                'description' => 'Patching the flat bicycle tire for the next bike ride.',
                'status' => 'open'
            ],
            [
                'title' => 'Update resume',
                'description' => 'Add experiences to the CV.',
                'status' => 'completed'
            ],
            [
                'title' => 'Patching a bicycle tire',
                'description' => 'Patching the flat bicycle tire for the next bike ride.',
                'status' => 'in-progress'
            ],
            [
                'title' => 'Call plumber',
                'description' => 'Schedule a plumber to fix the leaky faucet in the bathroom.',
                'status' => 'open'
            ],
        ];

        foreach ($todos as &$todo) {
            $todo['created_at'] = now();
        }

        DB::table('todos')->insert($todos);
    }
}
