<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $oUser = User::create([
            'first_name'  => "Admin",
            'last_name' => 'Nucleus',
            'email' => 'admin@nucleus.vision',
            'password' => \Hash::make('12345678'),
            'status' => User::STATUS_ACTIVE,
        ]);
        
        $oRole = Role::where('role', 'super')->first();
        
        $oUser->roles()->attach($oUser->user_id);
        
    }
}
