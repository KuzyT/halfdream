<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 19.02.2019
 */

namespace KuzyT\Halfdream\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\InputOption;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

class AdminCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'halfdream:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user and assign him an superadmin role.';

    /**
     * Get user options.
     */
    protected function getOptions()
    {
        return [
            ['create', null, InputOption::VALUE_NONE, 'Create an admin user', null],
        ];
    }

    public function fire()
    {
        return $this->handle();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $superadminRole = config('halfdream.admin.roles.superadmin');
        // Check if role exists
        try {
            Role::findByName($superadminRole);
        } catch (RoleDoesNotExist $exception) {
            $this->error($exception->getMessage());
            $this->line(__('halfdream::commands.admin.install_first'));
            exit;
        }

        // Get or create user
        $user = $this->getUser(
            $this->option('create')
        );

        // the user not returned
        if (!$user) {
            exit;
        }


        $user->assignRole($superadminRole);
        $this->info(__('halfdream::commands.admin.role_assigned', ['role' => $superadminRole]));
    }

    /**
     * Get command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['email', InputOption::VALUE_REQUIRED, 'User\'s email.', null],
        ];
    }

    /**
     * Get or create user.
     *
     *
     * @param bool $create
     *
     * @return null|\App\User
     */
    protected function getUser($create = false)
    {
        $email = $this->argument('email');
        // Ask for email if there wasnt set one
        if (!$email) {
            $email = $this->ask(__('halfdream::commands.admin.enter_email'));
        }

        $model = config('auth.providers.users.model');

        // If we need to create a new user go ahead and create it
        if ($create) {
            $name = $this->ask(__('halfdream::commands.admin.enter_name'));
            $password = $this->secret(__('halfdream::commands.admin.enter_password'));
            $confirmPassword = $this->secret(__('halfdream::commands.admin.confirm_password'));

            // Passwords don't match
            if ($password != $confirmPassword) {
                $this->error(__('halfdream::commands.admin.not_match'));
                return;
            }

            $this->info(__('halfdream::commands.admin.creating_user'));

            $model::create([
                'name'     => $name,
                'email'    => $email,
                'password' => Hash::make($password),
            ]);

            $this->info(__('halfdream::commands.admin.user_created', ['user' => $name]));
        }

        $user = $model::where('email', $email)->first();

        if (!$user) {
            $this->error(__('halfdream::commands.admin.user_not_found', ['email' => $email]));
            return;
        }

        return $user;
    }
}
