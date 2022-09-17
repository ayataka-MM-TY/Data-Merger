<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create('My Project');
        $this->create('タクシーLog');
        $this->create('プロジェクトY');
    }

    private function create(string $name): void
    {
        $project = new Project;
        $project->name = $name;
        $project->save();
    }
}
