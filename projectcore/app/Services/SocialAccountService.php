<?php
namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\SocialAccount;
use App\Models\User;

class SocialAccountService
{
    /**
     * @var SocialAccount
     */
    protected $socialAccount;

    /**
     * @var User
     */
    protected $user;

    /**
     * SocialAccountService constructor.
     *
     * @param SocialAccount $socialAccount
     * @param User $user
     */
    public function __construct(SocialAccount $socialAccount, User $user)
    {
        $this->socialAccount = $socialAccount;
        $this->user = $user;
    }

    /**
     * @param ProviderUser $providerUser
     *
     * @return Authenticatable
     */
    public function createOrGetUser(ProviderUser $providerUser): Authenticatable
    {
        $account = $this->socialAccount->whereProvider('facebook')->whereProviderUserId($providerUser->getId())->first();
        if($account) {
            return $account->user;
        }

        $account = new SocialAccount([
            'provider_user_id' => $providerUser->getId(),
            'provider' => 'facebook',
            'gender' => $providerUser->user['gender'],
            'link' => $providerUser->user['link']
        ]);

        $user = $this->user->where('email', $providerUser->getEmail())->first();

        if (!$user) {
            $user = $this->user->create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName()
            ]);
        }

        $account->user()->associate($user);
        $account->save();

        return $user;
    }
}