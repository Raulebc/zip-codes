<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ZipCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'       => 123,
            'locality'       => $this->faker->city,
            'federal_entity' => [
                'key' => 9,
                'name' => 'CIUDAD DE MEXICO',
                'code' => 123,
            ],
            'settlements'    => [
                [
                    'key'             => 9,
                    'name'            => 'SANTA FE',
                    'zone_type'       => 'URBANO',
                    'settlement_type' => [
                        'name' => 'PUEBLO',
                    ]
                ],
            ],
            'municipality'    => [
                'key'  => 10,
                'name' => "ALVARO OBREGON",
            ],
        ];
    }
}
