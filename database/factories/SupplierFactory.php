<?php

namespace Database\Factories;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class SupplierFactory extends Factory
{
    protected $model = Supplier::class;
   
    public function definition()
    {
        $bankNames = ['UniCredit', 'Intesa Sanpaolo', 'Mediobanca', 'Banca Nazionale del Lavoro (BNL)','Other']; // Replace with your actual options

        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'store_name' => $this->faker->company,
            'type' => $this->faker->randomElement(['Bottle and Packaging', 'Equipment']),
            'photo' => null,
            'account_holder' => $this->faker->name,
            'account_number' => $this->faker->bankAccountNumber,
            'bank_name' => $this->faker->randomElement($bankNames), // Use the ready options
        ];
    }
}
