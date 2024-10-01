<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdatePasswords extends Command
{
    protected $signature = 'passwords:update';

    protected $description = 'Update passwords to use Bcrypt algorithm';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Retrieve all users
        $users = User::all();

        // Hash passwords for each user
        foreach ($users as $user) {
            $user->password = Hash::make($user->password);
            $user->save();
        }

        $this->info('Passwords updated successfully.');
    }
}
