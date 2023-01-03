<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cat =$this->faker->text(10);
        return [
            'name'      =>$cat,
            'slug'      =>Str::slug($cat),
            'image'     =>$this->faker->image(),
            'parent'    =>'0',
            'status'    =>'1'
        ];
    }
}
