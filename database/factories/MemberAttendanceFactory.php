<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\MemberAttendance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MemberAttendance>
 */
class MemberAttendanceFactory extends Factory
{
    protected $model = MemberAttendance::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_id' => Member::factory(),
            'device_user_id' => (string) $this->faker->numerify('####'),
            'punched_at' => $this->faker->dateTimeBetween('-7 days'),
            'direction' => $this->faker->randomElement(['in', 'out']),
            'device_serial' => $this->faker->bothify('ZK####'),
            'verify_type' => 1,
            'status_code' => 0,
            'source' => 'manual',
            'raw_payload' => null,
        ];
    }
}
