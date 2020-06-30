<?php

use Illuminate\Database\Seeder;

class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email','admin@aipx.com')->get();
        //dd($user);
        if (count($user) == 0) {
            DB::table('users')->insert([
                'fullname' => 'admin',
                'email' => 'admin@ecom.com',
                'password' => Hash::make(12345678),
            ]);
        }
    }
}
