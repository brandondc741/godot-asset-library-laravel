<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AdminCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "
        admin:create
        {email? : The administrator's email address (leave blank to prompt)}
        {password? : The administrator's password (leave blank to prompt)}
        {name? : The administrator's full name (leave blank to prompt)}
    ";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an user with admin privileges';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email') ?? $this->ask('Email address');
        $password = $this->argument('password') ?? $this->secret('Password');
        $name = $this->argument('name') ?? $this->ask('Name');

        // Create an user, mark it as an administrator then save it
        // (`markEmailAsVerified()` automatically saves the model)
        $user = new User();
        $user->forceFill([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ])->markEmailAsVerified();

        $this->info("Administrator \"$name\" <$email> created!");
    }
}
