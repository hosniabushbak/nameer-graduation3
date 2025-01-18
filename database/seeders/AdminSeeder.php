<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::firstOrCreate([
            'email' => 'admin@gmail.com'
        ],[
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            // 'admin_image' => '/admin/media/our-image/logo-colored.png',
            'password' => bcrypt('123456789')
        ]);

    }
}
