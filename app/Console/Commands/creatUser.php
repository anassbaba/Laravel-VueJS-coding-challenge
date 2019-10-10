<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class creatUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new user';

    /**
     * User model.
     *
     * @var object
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->info('Create new user:');
        $details = $this->getDetails();
        // if ($details) {
        //   $user = new User($details);
        //   $user->save();
        //   $this->display($user);
        // }
        // $this->display($user);

    }

    /**
    * Ask for user details.
    *
    * @return array
    */
   private function getDetails()
   {

       $details['name'] = $this->ask('Name');
       $details['email'] = $this->ask('Email');
       $details['password'] = $this->secret('Password');
       $details['confirm_password'] = $this->secret('Confirm password');

       $validator = Validator::make([
           'name' => $details['name'],
           'email' => $details['email'],
           'password' => $details['password'],
       ], [
           'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           'password' => ['required', 'string', 'min:5'],
       ]);
       if ($validator->fails()) {
         $this->info('User not created. See error message blew:');

         foreach ($validator->errors()->all() as $error) {
            $this->error($error);
         }
         return 0;
       }

       while (! $this->isValidPassword($details['password'], $details['confirm_password'])) {
           if (! $this->isRequiredLength($details['password'])) {
               $this->error('Password must be more that six characters');
           }
           if (! $this->isMatch($details['password'], $details['confirm_password'])) {
               $this->error('Password and Confirm password do not match');
           }
           $details['password'] = Hash::make($this->secret('Password'));
           $details['confirm_password'] = $this->secret('Confirm password');
       }

       $user = User::create([
           'name' => $details['name'],
           'email' => $details['email'],
           'password' => Hash::make($details['password']),
       ]);
       $this->display($user);
       // return $details;
   }

   /**
     * Display created admin.
     *
     * @param array $admin
     * @return void
     */
    private function display(User $user) : void
    {
        $headers = ['Name', 'Email'];
        $fields = [
            'Name' => $user->name,
            'email' => $user->email,
            'password' => '*********'
        ];
        $this->info('new user created');
        $this->table($headers, [$fields]);
    }

    /**
     * Check if password is vailid
     *
     * @param string $password
     * @param string $confirmPassword
     * @return boolean
     */
    private function isValidPassword(string $password, string $confirmPassword) : bool
    {
        return $this->isRequiredLength($password) &&
        $this->isMatch($password, $confirmPassword);
    }

    /**
     * Check if password and confirm password matches.
     *
     * @param string $password
     * @param string $confirmPassword
     * @return bool
     */
    private function isMatch(string $password, string $confirmPassword) : bool
    {
        return $password === $confirmPassword;
    }

    /**
     * Checks if password is longer than six characters.
     *
     * @param string $password
     * @return bool
     */
    private function isRequiredLength(string $password) : bool
    {
        return strlen($password) > 6;
    }


}
