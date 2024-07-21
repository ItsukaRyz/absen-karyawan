<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //data dummy
        $users = User::all();

        foreach ($users as $user) {
            for ($day = 1; $day <= 30; $day++) {
                Attendance::factory()->create([
                    'user_id' => $user->id,
                    'date' => '2023-07-' . str_pad($day, 2, '0', STR_PAD_LEFT),
                ]);
            }
        }
    }
}
