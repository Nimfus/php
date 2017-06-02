<?php
namespace Tests\Unit\Services;

use App\Services\PasswordHashService;
use Illuminate\Hashing\BcryptHasher;
use PHPUnit\Framework\TestCase;

class PasswordHashServiceTest extends TestCase
{
    /**
     * @test
     */
    public function testCreatePasswordHash(): void
    {
        $passwordHashService = new PasswordHashService(new BcryptHasher());
        $expectedHashLength = 60;

        $hash = $passwordHashService->createPasswordHash('MyAwesomePassword4');

        $this->assertEquals($expectedHashLength, strlen($hash));
    }
}