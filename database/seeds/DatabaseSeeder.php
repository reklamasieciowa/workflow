<?php

use Illuminate\Database\Seeder;
use App\Status;
use App\Task;
use App\User;
use App\Job;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //create tasks
        $tasks = factory(App\Task::class, 250)->create();

        //create statuses
        $status = factory(App\Status::class)->create([
            'name' => 'Do zrobienia',
        ]);

        $status = factory(App\Status::class)->create([
            'name' => 'W trakcie'
        ]);

        $status = factory(App\Status::class)->create([
            'name' => 'Zrobione'
        ]);

        $status = factory(App\Status::class)->create([
            'name' => 'Zatwierdzone'
        ]);

        //create user roles
        $roles = factory(App\Role::class)->create([
            'name' => 'admin'
        ]);

        $roles = factory(App\Role::class)->create([
            'name' => 'worker'
        ]);

        $jobs = factory(App\Job::class,50)->create();

        //create users with jobs and tasks
        $users = factory(App\User::class, 10)->create()->each(function($u) use ($jobs) {
        	$u->roles()->attach(2);

          $u->jobs()->attach(
            $jobs->random(rand(1, 10))->pluck('id')->toArray()
          );

                // ->each(function($j) {
                //       $j->tasks()->saveMany(factory(App\Task::class,5)->make());
                //  })
          

        });

        //create admin user id 31
        $admin = factory(App\User::class)->create([
	      'name' => 'admin',
	      'email' => 'michal@brzoz.pl',
	      'password' => bcrypt('haslo'),
		]);

        //attach admin role to admin
		$admin->roles()->attach(1);
    }
}
