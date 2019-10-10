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
    public function handle()
    {
        $this->info('update password user:');
        $this->getDetails();
    }


    private function getDetails()
    {
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


        // $details['new-password'] = $this->ask('new-password');
        // $details['repat-password'] = $this->ask('repat-password');
        //
        // $user = Auth::user();
        // $user->password = bcrypt($request->get('new-password'));
        // $user->save();
        // $this->info("success","Password changed successfully !");



        // $details['confirm_password'] = $this->secret('Confirm password');

        // $validator = Validator::make([
        //     'name' => $details['name'],
        //     'email' => $details['email'],
        //     'password' => $details['password'],
        // ], [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:5'],
        // ]);
        // if ($validator->fails()) {
        //   $this->info('User not created. See error message blew:');
        //
        //   foreach ($validator->errors()->all() as $error) {
        //      $this->error($error);
        //   }
        //   return 0;
        // }
        //
        // while (! $this->isValidPassword($details['password'], $details['confirm_password'])) {
        //     if (! $this->isRequiredLength($details['password'])) {
        //         $this->error('Password must be more that six characters');
        //     }
        //     if (! $this->isMatch($details['password'], $details['confirm_password'])) {
        //         $this->error('Password and Confirm password do not match');
        //     }
        //     $details['password'] = Hash::make($this->secret('Password'));
        //     $details['confirm_password'] = $this->secret('Confirm password');
        // }


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
