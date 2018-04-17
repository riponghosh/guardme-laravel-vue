<?php

namespace Modules\Jobs\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\App\Models\Category;
use Modules\Company\Models\Company;
use Modules\Jobs\Models\Job;
use Modules\Users\Models\User;
use Faker\Generator as Faker;

class DummyJobsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::truncate();
        Company::truncate();
        $categories_id_array = Category::all()->pluck('id')->toArray();

        $user = User::whereUsername('employer')->first();
        /** @var Faker $faker */
        $faker = app(Faker::class);


        factory(Company::class, 10)->create([
            'user_id' => $user->id
        ])->each(function ($company) use ($categories_id_array, $faker) {
            /** @var Company $company */

            factory(Job::class, 15)->create([
                'company_id' => $company->id
            ])->each(function ($job) use ($categories_id_array, $faker){
                $ids = $faker->randomElements($categories_id_array, 2);
                /**
                 * @var Job $job
                 */
                $job->categories()->sync($ids);
            });
        });
    }
}
