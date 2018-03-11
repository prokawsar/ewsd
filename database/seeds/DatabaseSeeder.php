<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');

        $this->call('StudentTableSeeder');
        $this->command->info('Student table seeded!');

        $this->call('AdminTableSeeder');
        $this->command->info('Admin table seeded!');

        $this->call('QAManagerTableSeeder');
        $this->command->info('QAManager table seeded!');

        $this->call('CoordinatorTableSeeder');
        $this->command->info('Coordinator table seeded!');
    }
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('students')->delete();
        DB::table('admins')->delete();
        DB::table('qamanagers')->delete();
        DB::table('coordinators')->delete();

        DB::table('users')->delete();
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 1;");

        User::create([
            'name' => 'Student',
            'email' => 'student@bar.com',
            'password' => bcrypt('111111')

        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'kouther80@gmail.com',
            'password' => bcrypt('111111')

        ]);

        User::create([
            'name' => 'QA Manager',
            'email' => 'manager@bar.com',
            'password' => bcrypt('111111')

        ]);

        User::create([
            'name' => 'QA Coordinator',
            'email' => 'coordinator@gmail.com',
            'password' => bcrypt('111111')

        ]);


    }

}
class StudentTableSeeder extends Seeder {

    public function run()
    {
        DB::table('students')->delete();

        DB::table('students')->delete();
        App\Student::create([
            'student_id' => 1,
        ]);

    }

}
class AdminTableSeeder extends Seeder {

    public function run()
    {
        DB::table('admins')->delete();

        App\Admin::create([
            'admin_id' => 2,
        ]);

    }

}
class QAManagerTableSeeder extends Seeder {

    public function run()
    {
        DB::table('qamanagers')->delete();

        DB::table('qamanagers')->delete();
        App\Qamanager::create([
            'qamanage_id' => '3',
        ]);

    }

}
class CoordinatorTableSeeder extends Seeder {

    public function run()
    {

        DB::table('coordinators')->delete();
        App\Coordinator::create([
            'cord_id' => '4',
        ]);

    }

}
