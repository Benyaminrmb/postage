<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $arrayValues = ['agency','member'];
        $arrayValues3 = ['تهران مفتح شمالی خیابان مطهری پلاک 180 واحد 2','تهران چهار دانگه روبروی پل خاجو پلاک 44'];
        $arrayValues2 = ['{"location":{"state":{"id":"8","name":"\u062a\u0647\u0631\u0627\u0646"},"city":{"id":"349","name":"\u0627\u0633\u0644\u0627\u0645\u0634\u0647\u0631"}}}',
            '{"location":{"state":{"id":"8","name":"\u062a\u0647\u0631\u0627\u0646"},"city":{"id":"350","name":"\u0686\u0647\u0627\u0631\u062f\u0627\u0646\u06af\u0647"}}}'];
        return [
            'name' => $this->faker->name,
            'family' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'userType' => $arrayValues[random_int(0,1)],
            'client_id' => '4',
            'token' => '4',
            'member_id' => random_int(500,999),
            'agencyInfo' => $arrayValues2[random_int(0,1)],
            'mobile' => random_int(500,999),
            'nationalCode' => random_int(500,999),
            'telephone' => random_int(500,999),
            'password' => '641b7754e063147020c19b3a13305835139eec0285308718f0c315aadad00cdf1457fbd926d11958244164ca2f99a7d04f3be0e5add256ad0072ac5f8ddd1527', // password
            'gender' => 'Male',
            'birthday' => now(),
            'address' => $arrayValues[random_int(0,1)],
            'register_date' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
//    public function unverified()
//    {
//        return $this->state(function (array $attributes) {
//            return [
//                'email_verified_at' => null,
//            ];
//        });
//    }
}
