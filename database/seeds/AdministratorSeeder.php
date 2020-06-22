<?php

// use App\User;
use Illuminate\Database\Seeder;

use function GuzzleHttp\json_encode;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "admin";
        $administrator->name = "Site Admin";
        $administrator->email = "admin@gmail.com";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("larashop");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Cibubur, Jakarta Timur";
        $administrator->phone = "08111512711";

        $administrator->save();
        $this->command->info("User Admin Berhasil Diinsert");
    }
}
