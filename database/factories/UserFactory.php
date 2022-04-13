<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
     */
    public function definition()
    {
        $data = [
            'wallet_id' => Str::uuid(),
            'username' => $this->faker->userName,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'contact_no' => $this->faker->phoneNumber,
            'nationality' => $this->faker->randomElement(Country::pluck('id')->toArray()),
        ];

        if ($data['nationality'] == Country::where('code', 'MY')->value('id')) {
            $data += [
                'personal_id_no' => random_int(111111111111, 999999999999),
                'personal_id_type' => Country::ID_TYPE_MYKAD,
            ];
        } else {
            $data += [
                'personal_id_no' => Str::random(14),
                'personal_id_type' => Country::ID_TYPE_PASSPORT,
            ];
        }

        return $data;
    }
}
