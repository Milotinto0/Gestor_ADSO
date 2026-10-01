<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class AprendizFactory extends Factory
{
 public function definition(): array
 {
 return [
 'nombre' => $this->faker->name(),
 'documento' => (string) $this->faker->unique()->numerify('##########'),
 'correo' => $this->faker->unique()->safeEmail(),
 'ficha_id'     => $this->faker->numberBetween(1000000, 9999999),
 ];
 }
}
