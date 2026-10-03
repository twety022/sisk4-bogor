<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@smkn4bogor.sch.id'],
            [
                'name'     => 'Admin SISK4',
                'password' => Hash::make('gantipasswordini123'), 
                'role'     => 'super_admin',
            ]
        );
    }
}
