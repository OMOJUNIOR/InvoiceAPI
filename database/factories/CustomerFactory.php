<?php

namespace Database\Factories;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type= $this->faker->randomElement(['I','B']);
        $name = $type == 'B' ? $this->faker->company()  : $this->faker->name();
    	return [
    	    'name'=> $name,
            'type'=> $type,
            'email'=> $this->faker->email(),
            'address'=> $this->faker->streetAddress(),
            'city'=> $this->faker->city(),
            'state'=> $this->faker->streetAddress(),
            'postal_code'=>$this->faker->postcode(),


    	];
    }
}
