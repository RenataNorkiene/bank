<?php

namespace Tests\Unit;

use http\Client\Curl\User;
use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Transfer;

class TransferTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();
        $transfer = Transfer::factory()->count(3)->create();

        $response = $this->actingAs($user)->transfer('/create-transfers');
        $response->assertSeeText('Transfer is created');
    }
}
