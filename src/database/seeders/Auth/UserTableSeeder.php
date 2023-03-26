<?php

namespace Database\Seeders\Auth;

use App\Models\Core\Auth\User;
use App\Models\Core\Status;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::query()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'admin@demo.com',
            'password' => Hash::make('123456'),
            'status_id' => Status::findByNameAndType('status_active', 'user')->id
        ]);

        User::query()->create([
            'first_name' => 'Joan',
            'last_name' => 'Toy',
            'email' => 'manager@demo.com',
            'password' => Hash::make('123456'),
            'status_id' => 1
        ]);

        User::query()->create([
            'first_name' => 'Rosey',
            'last_name' => 'Martin',
            'email' => 'agent@demo.com',
            'password' => Hash::make('123456'),
            'status_id' => 1
        ]);

        User::query()->create([
            'first_name' => 'Jack',
            'last_name' => 'Sparrow',
            'email' => 'client@demo.com',
            'password' => Hash::make('123456'),
            'status_id' => 1
        ]);

        $this->enableForeignKeys();
    }

    public function addMoreDemoUser()
    {
        for ($i = 0; $i <= 10; $i++) {
            User::query()->create([
                'first_name' => 'Jack' . rand(1, 100),
                'last_name' => 'Sparrow',
                'email' => 'client' . rand(1, 100) . '@demo.com',
                'password' => Hash::make('123456'),
                'status_id' => rand(1, 3)
            ]);
        }
    }
}
