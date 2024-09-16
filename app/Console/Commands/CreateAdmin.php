<?php

namespace App\Console\Commands;

// app/Console/Commands/CreateAdmin.php

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Create an admin account';

    public function handle()
    {
        $name = $this->ask('Enter admin firstname');
        $name = $this->ask('Enter admin lastname');
        $email = $this->ask('Enter admin email');
        $password = $this->secret('Enter admin password');

        $admin = User::create([
            'firstname' => $name,
            'lastname' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info('Admin account created successfully!');

         // Log or output debug information
    $this->line('Admin ID: ' . $admin->id);
    $this->line('Admin Role: ' . $admin->role);

    }
}

