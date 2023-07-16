<?php
 
namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\UsersTasks;
use Database\Seeders\UsersTasksSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();
        Workspace::factory()->count(100)->create();
        Project::factory()->count(100)->create();
        Task::factory()->count(100)->create();
        UsersTasks::factory()->count(100)->create();
    }
}
