<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 16.03.2019
 */

namespace KuzyT\Halfdream\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use KuzyT\Halfdream\HalfdreamServiceProvider;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'halfdream:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Halfdream package';

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Copy elements force', null],
        ];
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {
        $force = $this->option('force');

        if (!file_exists(config_path('halfdream.php'))) {
            $this->info('Making default Laravel auth');
            $this->call('make:auth');

            $force = true;
        }

        $this->info('Publishing the HalfDream and other packages assets, database, and config files');

        $this->call('vendor:publish', ['--provider' => HalfdreamServiceProvider::class, $force ? '--force' : null]);

        $this->info('Publishing the additional packages assets, database, and config files');
        $this->call('vendor:publish', ['--provider' => \Spatie\Permission\PermissionServiceProvider::class]);

        $this->info('Dumping the autoloaded files and reloading all new files');

        $this->info('Migrating the database tables into your application');
        $this->call('migrate');

        $this->info('Adding role and other magic to App\Models\User');

        if ($force) {
            if (file_exists(app_path('Models\User.php'))) {
                $str = file_get_contents(app_path('Models\User.php'));

                if ($str !== false) {
                    $str = str_replace('use HasApiTokens, HasFactory, Notifiable;', 'use HasApiTokens, HasFactory, Notifiable, \Spatie\Permission\Traits\HasRoles, \KuzyT\Halfdream\General\Traits\Front\HasAvatar;', $str);

                    file_put_contents(app_path('Models\User.php'), $str);
                }
            } else {
                $this->warn('Unable to locate "app/Models/User.php". Did you move this file?');
                $this->warn('You will need to update this manually.  Change "use HasApiTokens, HasFactory, Notifiable;" to "use HasApiTokens, HasFactory, Notifiable, \Spatie\Permission\Traits\HasRoles, \KuzyT\Halfdream\General\Traits\Front\HasAvatar;" in your User model');
            }

            $this->info('HalfDream routes to routes/web.php');
            $contents = $filesystem->get(__DIR__ . '/../../publishable/routes/web.php');
            $filesystem->put(base_path('routes/web.php'), $contents);

            $this->info('HalfDream package.json to package.json');
            $contents = $filesystem->get(__DIR__ . '/../../publishable/package.json');
            $filesystem->put(base_path('package.json'), $contents);

            $this->info('HalfDream webpack.mix.js to webpack.mix.js');
            $contents = $filesystem->get(__DIR__ . '/../../publishable/webpack.mix.js');
            $filesystem->put(base_path('webpack.mix.js'), $contents);

            $this->info('HalfDream favicon.ico to favicon.ico');
            $contents = $filesystem->get(__DIR__ . '/../../publishable/public/favicon.ico');
            $filesystem->put(public_path('favicon.ico'), $contents);

            $this->info('HalfDream package.json to package.json');
            $contents = $filesystem->get(__DIR__ . '/../../publishable/public/css/app.css');
            $filesystem->put(public_path('css/app.css'), $contents);

            $this->info('HalfDream package.json to package.json');
            $contents = $filesystem->get(__DIR__ . '/../../publishable/public/js/app.js');
            $filesystem->put(public_path('js/app.js'), $contents);

            $this->info('Force for some view files');

            $contents = $filesystem->get(__DIR__ . '/../../publishable/resources/views/layouts/app.blade.php');
            $filesystem->put(resource_path('views/layouts/app.blade.php'), $contents);

            $contents = $filesystem->get(__DIR__ . '/../../publishable/resources/views/home.blade.php');
            $filesystem->put(resource_path('views/home.blade.php'), $contents);

            $filesystem->put(
                resource_path('views/auth/login.blade.php'),
                $filesystem->get(__DIR__ . '/../../publishable/resources/views/auth/login.blade.php')
            );
            $filesystem->put(
                resource_path('views/auth/register.blade.php'),
                $filesystem->get(__DIR__ . '/../../publishable/resources/views/auth/register.blade.php')
            );
            $filesystem->put(
                resource_path('views/auth/verify.blade.php'),
                $filesystem->get(__DIR__ . '/../../publishable/resources/views/auth/verify.blade.php')
            );
            $filesystem->put(
                resource_path('views/auth/passwords/email.blade.php'),
                $filesystem->get(__DIR__ . '/../../publishable/resources/views/auth/passwords/email.blade.php')
            );
            $filesystem->put(
                resource_path('views/auth/passwords/reset.blade.php'),
                $filesystem->get(__DIR__ . '/../../publishable/resources/views/auth/passwords/reset.blade.php')
            );

            $this->info('Force for js and sass files');

            $filesystem->put(
                resource_path('js/app.js'),
                $filesystem->get(__DIR__ . '/../../publishable/resources/js/app.js')
            );
            $filesystem->put(
                resource_path('js/bootstrap.js'),
                $filesystem->get(__DIR__ . '/../../publishable/resources/js/bootstrap.js')
            );
            $filesystem->put(
                resource_path('sass/app.scss'),
                $filesystem->get(__DIR__ . '/../../publishable/resources/sass/app.scss')
            );
        }

        $composer = $this->findComposer();

        $process = new Process($composer.' dump-autoload');
        $process->setTimeout(null); // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Seeding data into the database');
        $this->call('db:seed', ['--class' => 'IconSeeder']);
        $this->call('db:seed', ['--class' => 'MenuSeeder']);

        foreach (config('halfdream.admin.roles.access', []) as $role) {
            $this->call('permission:create-role', ['name' => $role]);
        }

        $this->info('Adding the storage symlink to your public folder');
        $this->call('storage:link');

        $this->info('Successfully installed Halfdream!');
    }
}
