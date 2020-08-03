<?php

use Illuminate\Database\Seeder;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new \App\User;
        $user->username = "admin";
        $user->name = "kepala Disdukcapil";
        $user->email = "administrator@mail.com";
        $user->password = \Hash::make("admin");
        $user->save();
        $this->command->info("User Admin berhasil dibuat");
    }
}
