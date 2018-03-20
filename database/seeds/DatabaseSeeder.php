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
        $this->call('RoleTableSeeder');
        $this->command->info('Role table seeded!');

        $this->call('DepartTableSeeder');
        $this->command->info('Department table seeded!');

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

        $this->call('CategoryTableSeeder');
        $this->command->info('Idea table seeded!');

        $this->call('IdeaTableSeeder');
        $this->command->info('Idea table seeded!');
    }
}

class RoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();
        DB::table('departments')->delete();
        DB::table('comments')->delete();
        DB::table('ideas')->delete();
        DB::table('students')->delete();
        DB::table('admins')->delete();
        DB::table('qamanagers')->delete();
        DB::table('coordinators')->delete();
        DB::table('categories')->delete();

        DB::table('users')->delete();
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 1;");
        DB::statement("ALTER TABLE roles AUTO_INCREMENT = 1;");
        DB::statement("ALTER TABLE departments AUTO_INCREMENT = 1;");
        DB::statement("ALTER TABLE categories AUTO_INCREMENT = 1;");


        App\Role::create([
            'role_name' => 'admin',

        ]);

        App\Role::create([
            'role_name' => 'student',

        ]);

        App\Role::create([
            'role_name' => 'coordinator',

        ]);

        App\Role::create([
            'role_name' => 'qamanager',

        ]);


    }

}
class UserTableSeeder extends Seeder {

    public function run()
    {
        User::create([
            'name' => 'Student',
            'email' => 'student@bar.com',
            'password' => bcrypt('111111'),
            'role_id' => 2

        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@bar.com',
            'password' => bcrypt('111111'),
            'role_id' => 1

        ]);

        User::create([
            'name' => 'QA Manager',
            'email' => 'manager@bar.com',
            'password' => bcrypt('111111'),
            'role_id' => 4

        ]);

        User::create([
            'name' => 'QA Coordinator',
            'email' => 'coordinator@bar.com',
            'password' => bcrypt('111111'),
            'role_id' => 3

        ]);


    }

}
class DepartTableSeeder extends Seeder {

    public function run()
    {
        \App\Department::create([
            'depart_name' => 'CSE',

        ]);

        \App\Department::create([
            'depart_name' => 'Software Engineering',

        ]);

        \App\Department::create([
            'depart_name' => 'IT',

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
            'depart_id' => 1,
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
            'depart_id' => 2
        ]);

    }

}
class CategoryTableSeeder extends Seeder {

    public function run()
    {
        App\Category::create([
            'cat_name' => 'Campus',
            'start_date' => '2018-03-04',
            'end_date' => '2018-03-10',
            'final_end_date' => '2018-03-14',
            'depart_id' => 1

        ]);


    }

}
class IdeaTableSeeder extends Seeder {

    public function run()
    {

        DB::table('ideas')->delete();
        App\Idea::create([
            'idea' => 'Wonderful Idea 1',
            'cat_id' => 1,
            'student_id' => 1
        ]);

        App\Idea::create([
            'idea' => 'Wonderful Idea 2',
            'cat_id' => 1,
            'student_id' => 1
        ]);

    }

}
