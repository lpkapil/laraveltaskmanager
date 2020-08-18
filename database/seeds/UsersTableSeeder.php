<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin User';
        $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->email = 'admin@example.com';
        $user->password = bcrypt('admin');
        $user->save();

        $roles = Role::orderBy('id', 'desc')->pluck('id')->toArray();
        $user->roles()->sync(Role::whereIn('id', ($roles) ?? [])->get());
    }
}
