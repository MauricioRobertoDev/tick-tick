<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\Status;
use App\Enums\Priority;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => fake()->sentence(),
            'status' => fake()->randomElement(Status::cases()),
            'priority' => fake()->randomElement(Priority::cases()),
            'department_id' => Department::factory(),
            'user_id' => User::factory(),
            'agent_id'=> User::factory(),
            'closed_by'=> User::factory(),
            'closed_at' => fake()->dateTimeBetween('-20 days', now())
        ];
    }
}
