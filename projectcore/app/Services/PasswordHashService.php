<?php
namespace App\Services;

use Illuminate\Hashing\BcryptHasher as Hasher;

class PasswordHashService
{
    /**
     * @var Hasher
     */
    protected $hasher;

    /**
     * PasswordHashService constructor.
     *
     * @param Hasher $hasher
     */
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param string $password
     *
     * @return string
     */
    public function createPasswordHash(string $password): string
    {
        return $this->hasher->make($password);
    }
}