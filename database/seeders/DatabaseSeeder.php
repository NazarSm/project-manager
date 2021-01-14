<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
         //\App\Models\Task::factory(40)->create();

        User::factory(5)
            ->create()
            ->each(function (User $user) {
                Project::factory(rand(1, 4))
                    ->create([
                        'user_id' => $user->id,
                    ])
                    ->each(function (Project $project) {
                        Task::factory(rand(2, 5))
                            ->create([
                                'project_id' => $project->id,
                            ]);
                    });
            });
    }
}
