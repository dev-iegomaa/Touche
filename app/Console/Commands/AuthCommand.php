<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AuthCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command To Create An Account For User';

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
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Enter Your Name');
        $email = $this->ask('Enter Your Email');
        $password = $this->secret('Enter Your Password');

        if (User::where('email',$email)->first()) {
            $this->info('Sorry This Account Already Exists In Table User');
            return Command::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        $this->info('Account Was Created');
        return Command::SUCCESS;
    }
}
