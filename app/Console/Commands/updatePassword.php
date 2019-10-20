<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;

class updatePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update password user';

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
    public function handle() {

        $this->info('update password user:');
        $this->getDetails();
    }


    private function getDetails() {

        $details['email'] = $this->ask('Email');
        $details['new_password'] = $this->secret('New password');
        $isValidLogin = $this->isValidEmail($details['email'],$details['new_password']);
        while (!$isValidLogin) {
          $details['try'] = $this->ask('Try again ? yes : no');
          switch ($details['try']) {
            case 'yes':
              $this->getDetails();
              break;
            default:
              return 0;
              break;
          }
        }
        return $details;
    }

    /**
     * Check if user login is valide
     *
     * @param string $email
     * @param string $password
     * @return boolean
     */
    private function isValidEmail(string $email, string $password) : bool
    {
        // check if email existe
        // $credentials =  array('email' => $email,'new_password' => $password );
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->info('Email not existe!');
            return false;
        }
        $user->password = Hash::make($password);
        $user->save();
        $this->info("Password changed successfully !");
        return true;

    }
}
