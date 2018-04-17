<?php

namespace App\Console\Commands;

use Caffeinated\Modules\Facades\Module;
use Caffeinated\Modules\Modules;
use Illuminate\Console\Command;
use Modules\Account\Models\Role;
use Modules\Users\Models\User;
use Modules\Account\Repositories\PermissionRepository;

class InstallSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var Modules
     */
    private $modules;

    /**
     * Create a new command instance.
     * @param Modules $modules
     */
    public function __construct(Modules $modules)
    {
        parent::__construct();
        $this->modules = $modules;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //dispatch(new Installer());
        // $this->prepareDatabase();

        $this->line('Optimizing....');
        \Artisan::call('module:optimize');

        $modules = $this->modules->all();

        $bar = $this->output->createProgressBar(count($modules));

        \Artisan::call('migrate:reset');

        foreach ($modules as $module){
            \Artisan::call('module:migrate', ['slug' => $module['slug']]);
            \Artisan::call('module:seed', ['slug' => $module['slug']]);

            $bar->advance();

        }

        $bar->finish();

        $this->setupACL();
		
		$this->autoVerifyAllUsers();
    }

    private function setupACL(){
        $modules = $this->modules->all();

        $this->alert('Setting ACL...');
        \DB::statement("SET foreign_key_checks=0");

        $bar = $this->output->createProgressBar(count($modules));

        foreach($modules->all() as $module){
            $module_slug = $module['slug'];

            $config_file = module_path($module_slug,'acl.config.php');

            if(file_exists($config_file)){
                $acl_config = require_once $config_file;

                $this->configureModuleACL($module_slug, $acl_config);
            }

            $bar->advance();
        }

        \DB::statement("SET foreign_key_checks=1");

        $bar->finish();
    }

    private function configureModuleACL($module_slug, array $acl_config)
    {
        /**
         * @var PermissionRepository $permissionRepo
         */
        $permissionRepo = app(PermissionRepository::class);

        foreach ($acl_config as $config){
            $permission = $permissionRepo->savePermission([
                'module' => $module_slug,
                'name' => $config['name']
            ]);

            // attach permission to configured roles
            foreach ($config['roles'] as $config_role){
                $permission->roles()->attach(
                    Role::whereName($config_role)->first()->id
                );
            }
        }
    }

    private function prepareDatabase(){
        $modules = $this->modules->all();

        $this->info('Installing system....');
        \DB::statement("SET foreign_key_checks=0");

        $bar = $this->output->createProgressBar(count($modules));

        foreach($modules->all() as $module){
            // migrate module database
            \Artisan::call('module:migrate', [
                'slug' => str_slug($module['slug']),
            ]);

            $bar->advance();
        }

        \DB::statement("SET foreign_key_checks=1");

        $bar->finish();
    }
	
	
	private function autoVerifyAllUsers(){
		$this->alert('Auto-verifying dummy users...');
		
		$users = User::all();
		
		$bar = $this->output->createProgressBar($users->count());
		foreach($users as $user){
			$user->phone = mt_rand(1000000000,9999999999);
			$user->email_verified = true;
			$user->phone_verified = true;
			
			$user->save();
			$bar->advance();
		}
		$bar->finish();
	}
}