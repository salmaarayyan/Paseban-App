<?php

namespace Database\Seeders;

use App\Models\Dinas;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Data awal minimal: 1 dinas contoh, 1 akun Admin BPS, 1 akun Dinas.
     * Password diambil dari SEED_DEFAULT_PASSWORD di .env (tidak di-hardcode).
     */
    public function run(): void
    {
        $password = env('SEED_DEFAULT_PASSWORD');

        if (blank($password)) {
            throw new RuntimeException('SEED_DEFAULT_PASSWORD belum diisi di file .env.');
        }

        $dinkes = Dinas::updateOrCreate(
            ['slug' => 'dinkes'],
            [
                'nama' => 'Dinas Kesehatan',
                'singkatan' => 'Dinkes',
                'instansi_code' => null,
            ],
        );

        User::updateOrCreate(
            ['email' => 'admin@bpsbantul.com'],
            [
                'nama' => 'Admin BPS',
                'password' => $password,
                'role' => 'admin_bps',
                'id_dinas' => null,
            ],
        );

        User::updateOrCreate(
            ['email' => 'dinkes@bpsbantul.com'],
            [
                'nama' => 'Dinas Kesehatan',
                'password' => $password,
                'role' => 'dinas',
                'id_dinas' => $dinkes->id,
            ],
        );
    }
}
