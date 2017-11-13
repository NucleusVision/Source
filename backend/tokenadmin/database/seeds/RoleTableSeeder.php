<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('roles')->insert(array(
            array('role' => 'Super'),
            array('role' => 'Admin'),
            array('role' => 'User')
        ));
    }
}
