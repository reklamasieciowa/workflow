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
        //$rand_number = rand(3,7);

        // $jobs = factory(App\Job::class)->create()->each(function($j) {
        //   for($i=0;$i<rand(3,7);$i++) {
        //     $j->tasks()->save(factory(App\Task::class)->make());
        //   }
        // });

        //create user roles
        $roles = factory(App\Role::class)->create([
            'name' => 'admin'
        ]);

        $roles = factory(App\Role::class)->create([
            'name' => 'worker'
        ]);

        //create users with jobs and tasks
        $users = factory(App\User::class, 10)->create()->each(function($u) {
        	$u->roles()->attach(2);

          $u->jobs()->saveMany(factory(App\Job::class,3)->make()
                // ->each(function($j) {
                //       $j->tasks()->saveMany(factory(App\Task::class,5)->make());
                //  })
          );

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
