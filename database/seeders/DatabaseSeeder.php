<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('Contributor');
        });
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('Administrator');
        });
        $user = User::all();
        Blog::factory(10)->create([
            'user_id' => $user->pluck('id')->first(),
        ]);

        $user =  User::create([
            'name' => 'Nick',
            'email' => 'nwhitaker@aaanortheast.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
         ]);
        $user->assignRole('Administrator');
    }
}
