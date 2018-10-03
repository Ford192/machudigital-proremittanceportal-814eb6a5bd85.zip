<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
          'name' => 'Zeepay rem',
          'email' => 'admin@mail.com',
          'password' => bcrypt('secret'),
          'account_type' => 'bank_teller',
          'created_at' => now(),
          'updated_at' => now()
        ]);
    }
}
