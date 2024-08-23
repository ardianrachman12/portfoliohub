<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserView>
 */
class UserViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static $userId = 1;
    
    public function definition(): array
    {
        return [
            'user_id' => self::$userId++,
            'ipaddress' => '127.0.0.1',
        ];
    }
}
