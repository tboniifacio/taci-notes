<?php

namespace Tests\Unit;

use App\Services\Operations;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class OperationsTest extends TestCase
{
    public function test_decrypt_id_returns_the_original_value(): void
    {
        $encrypted = Crypt::encrypt(42);

        $this->assertSame(42, Operations::decryptId($encrypted));
    }

    public function test_decrypt_id_redirects_home_on_invalid_input(): void
    {
        $redirect = Operations::decryptId('not-a-valid-encrypted-token');

        $this->assertInstanceOf(RedirectResponse::class, $redirect);
        $this->assertSame(route('home'), $redirect->getTargetUrl());
    }
}
