<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class EmailValidationTest extends TestCase
{
    /**
     * SKPL-UNT-02 / DUPL-UNT-02: Pengujian fungsi validasi format email
     * Jenis: Unit Test (White-box)
     */
    public function test_email_format_validation(): void
    {
        $validEmails = [
            'test@example.com',
            'user.name@domain.co.id',
            'user_name123@sub.domain.org',
        ];

        foreach ($validEmails as $email) {
            $validator = Validator::make(['email' => $email], [
                'email' => 'required|email',
            ]);

            $this->assertFalse($validator->fails(), "Email seharusnya valid: {$email}");
        }

        $invalidEmails = [
            'plainaddress',                  // Tidak ada @ dan domain
            '#@%^%#$@#$@#.com',              // Karakter tidak valid
            '@example.com',                  // Tidak ada username
            'Joe Smith <email@example.com>', // Ada teks tambahan
            'email.example.com',             // Tidak ada @
            'email@example@example.com',     // @ ganda
        ];

        foreach ($invalidEmails as $email) {
            $validator = Validator::make(['email' => $email], [
                'email' => 'required|email',
            ]);

            $this->assertTrue($validator->fails(), "Email seharusnya tidak valid: {$email}");
        }
    }
}
