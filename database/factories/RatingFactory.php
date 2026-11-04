<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Rating>
 */
class RatingFactory extends Factory
{
    protected $model = Rating::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'device_key' => hash('sha256', Str::random(48)),
            'stars' => fake()->numberBetween(3, 5),
            'author' => fake()->optional(0.75)->firstName(),
            'body' => fake()->randomElement([
                'Laptop saya yang mati total sekarang normal lagi, pengerjaannya cepat.',
                'Ganti keyboard rapi, semua tombol berfungsi dan tidak ada yang macet.',
                'Instalasi Windows selesai di hari yang sama, aplikasi dasar sudah terpasang.',
                'Servis HP cepat, layar sudah diganti dan responsif kembali.',
                'iPhone saya yang baterainya cepat habis sudah kembali normal.',
                'Pengerjaan rapi dan dijelaskan dulu sebelum diperbaiki.',
                'Harga bersahabat untuk ukuran servis di lingkungan sekolah.',
                'Siswanya teliti, perangkat dicek dulu sebelum diserahkan kembali.',
            ]),
            'is_visible' => true,
        ];
    }

    public function hidden(): static
    {
        return $this->state(fn (): array => ['is_visible' => false]);
    }
}
