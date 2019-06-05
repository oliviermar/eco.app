<?php

namespace Infra\Client;

use Domain\Client\StripeGatewayInterface;
use Domain\Entity\User;
use Stripe\HttpClient\CurlClient;
use Stripe\Stripe;
use Stripe\Account;

/**
 * Class StripeGateway
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class StripeGateway implements StripeGatewayInterface
{
    /** @var CurlClient */
    private $client;

    /**
     * @param string $apiKey
     */
    public function __construct(string $secretApiKey, string $publicApiKey)
    {
        $this->client = new CurlClient('https://api.stripe.com');
        Stripe::setApiKey($secretApiKey);
        Stripe::setClientId($publicApiKey);
    }

    /**
     * {@inheritdoc}
     */
    public function createAccount(User $user): string
    {
        try {
            $account = Account::create(
                [
                    "type" => "custom",
                    "country" => "FR",
                    "email" => $user->getUsername()
                ]
            );

            return $account['id'];
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die('Error processing during creating account');
        }
    }

    private function createAccountToken(User $user)
    {
        \Stripe\Token::create([
            'account' => [
                'individual' => [
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                ],
                'tos_shown_and_accepted' => true
            ]
        ]);
    }
}
