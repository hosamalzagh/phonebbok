<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = [
            'الرياضيات', 'العلوم', 'اللغة العربية', 'اللغة الإنجليزية',
            'التاريخ', 'الجغرافيا', 'الفيزياء', 'الكيمياء', 'الأحياء',
            'التربية الإسلامية', 'التربية الفنية', 'التربية الرياضية'
        ];

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'mobile' => fake()->phoneNumber(),
            'age' => fake()->numberBetween(25, 60),
            'gender' => fake()->randomElement(['male', 'female']),
            'subject' => fake()->randomElement($subjects),
            'salary' => fake()->randomFloat(2, 3000, 15000),
        ];
    }
}
