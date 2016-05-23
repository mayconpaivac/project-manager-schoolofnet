<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // \ManagerProject\Entities\User::truncate();
        // \ManagerProject\Entities\Client::truncate();
        // \ManagerProject\Entities\Project::truncate();
        // \ManagerProject\Entities\ProjectNote::truncate();

        $this->call(UserTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(ProjectNoteTableSeeder::class);

        Model::reguard();
    }
}
