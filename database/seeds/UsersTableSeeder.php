<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
          [
            'name'      => 'petugas',
            'role'      => 'petugas',
            'password'  => bcrypt('samarinda')
          ],
          [
            'name'      => 'admin',
            'role'      => 'admin',
            'password'  => bcrypt('samarinda')
          ]
        ]);
    }
}
