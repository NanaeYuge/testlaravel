<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Faker\Factory as FakerFactory;


class ContactFactory extends Factory
{
    protected $faker;

    public function __construct(...$attributes)
    {
        parent::__construct(...$attributes);
        $this->faker = FakerFactory::create('ja_JP');
    }

    public function definition(): array
    {
        $categoryId = Category::where('content', '商品の交換について')->value('id') ?? 1;

        return [
            'category_id' => $categoryId,
            'last_name' => '山田',
            'first_name' => '太郎',
            'gender' => 1,
            'email' => $this->faker->unique()->safeEmail(),
            'tel1' => $this->faker->numberBetween(100, 999),
            'tel2' => $this->faker->numberBetween(1000, 9999),
            'tel3' => $this->faker->numberBetween(1000, 9999),
            'address' => $this->faker->address(),
            'building' => $this->faker->secondaryAddress(),
            'message' => $this->faker->realText(100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
