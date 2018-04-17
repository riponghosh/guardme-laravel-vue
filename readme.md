## GuardMe code documentation

### Installation
Run: php artisan app:install

### Module hierarchy
- App = 0
- Users = 10
- Account = 20
- Company = 30
- Jobs = 50

### Important!!!!
All user roles are referenced in the 'guardme.php' configuration file
Endeavour to reference user roles via the configuration file instead of
hard-coding them in your modules. This is to prevent breakage when database
values change"# guardme-laravel-vue" 
