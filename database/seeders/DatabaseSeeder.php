<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Roibul Manun',
            'email' => 'roibulmanun33@gmail.com',
            'password' =>  Hash::make('12345678'),
        ]);
        //dumy for company
        \App\Models\Company::create([
            'name' => 'PT Adina Multi Wahana',
            'email' => 'roibulmanun33@gmail.com',
            'address' => 'Jl. Garuda No.99, RT.006/RW.005, Batujaya, Kec. Batuceper, Kota Tangerang, Banten 15121',
            'latitude'=>'-6.155660',
            'longitude'=>'106.662205',
            'radius_km'=>'100',
            'time_in'=>'08:00',
            'time_out'=>'17:00',
        ]);

        $this->call([
            AttendanceSeeder::class,
            PermissionSeeder::class,
             ]);

    }


}
