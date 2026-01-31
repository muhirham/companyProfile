<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactMessage;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'name'    => 'Budi Setiawan',
                'email'   => 'budi@example.com',
                'phone'   => '081234567890',
                'subject' => 'Permintaan Penawaran Genset 100 kVA',
                'message' => 'Halo, saya ingin meminta penawaran harga untuk genset 100 kVA untuk pabrik kami.',
                'is_read' => false,
            ],
            [
                'name'    => 'Siti Aminah',
                'email'   => 'siti@example.com',
                'phone'   => '082233445566',
                'subject' => 'Sewa Genset untuk Event',
                'message' => 'Apakah tersedia layanan sewa genset untuk event selama 3 hari di Jakarta?',
                'is_read' => false,
            ],
        ];

        foreach ($messages as $msg) {
            ContactMessage::create($msg);
        }
    }
}
