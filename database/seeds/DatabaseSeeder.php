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
            'name' => 'to do'
        ]);

        $status = factory(App\Status::class)->create([
            'name' => 'in progress'
        ]);

        $status = factory(App\Status::class)->create([
            'name' => 'done'
        ]);

        //create jobs with attached tasks
        $jobs = factory(App\Job::class, 50)->create()->each(function($j) {
           $j->tasks()->save(factory(App\Task::class, rand(2,5))->make());
        });

        //create user roles
        $roles = factory(App\roles::class)->create([
            'name' => 'admin'
        ]);

        $roles = factory(App\roles::class)->create([
            'name' => 'worker'
        ]);

        //create users
        $users = factory(App\User::class, 10)->create()->each(function($u) {
        	$u->roles()->attach(2);
        });

        // NOT WORKING!!!!
        
  //       $users = factory(App\User::class, 10)->create()->each(function($u) {
		//    $u->roles()->attach(2);
  //          $u->jobs()->save(factory(App\jobs::class, rand(1,5))->create()
  //               ->each(function($j) {
  //                   for($i = 0; $i < rand(2,6); $i++) {
  //                       $j->tasks()->save(factory(App\Task::class)->create([
  //                           'jobs_id' => $j->id,
  //                       ]));
  //                   }
  //               })
  //           );
		// });

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
