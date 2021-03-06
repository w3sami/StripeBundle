<?php

namespace W3sami\StripeBundle\Services;

use DateTime;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Charge;
use Stripe\SetupIntent;
use Stripe\StripeClient as StripeStripeClient;

class StripeClient extends Stripe
{
    public function __construct($stripe_private_key)
    {
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        self::setApiKey($stripe_private_key);
        self::setAppInfo("W3sami/StripeBundle", "0.1", "https://github.com/W3sami/StripeBundle");
    }

    public function getClient()
    {
        return new StripeStripeClient(self::getApiKey());
    }


    #########################
    ##       Customer      ##
    #########################

    public function createCustomer(
        string $name,
        string $email,
        string $phone,
        string $token = null
    ): Customer
    {
        $params = [
            "name" => $name,
            "email" => $email,
            'phone' => $phone
        ];
        if ($token) {
            $params["source"] = $token;
        }
        return Customer::create($params);
    }

    public function createIntent(
        Customer $customer
    ): SetupIntent
    {
        return SetupIntent::create([
            'customer' => $customer->id
        ]);
    }

    public function getCustomer(string $customerId): Customer
    {
        return Customer::retrieve($customerId);
    }

    #########################
    ##     Subscription    ##
    #########################

    public function createSubscription(
        string $customerId,
        string $planId,
        DateTime $trialEnd = null,
        DateTime $billingCycleAnchor = null,
        string $coupon = null): Subscription
    {
        $subscriptionOptions = [
            'customer' => $customerId,
            'items' => [['plan' => $planId]]
        ];

        if ($trialEnd) $subscriptionOptions['trial_end'] = $trialEnd->getTimestamp();
        if ($billingCycleAnchor) $subscriptionOptions['billing_cycle_anchor'] = $billingCycleAnchor->getTimestamp();
        if ($coupon) $subscriptionOptions['coupon'] = $coupon;

        return Subscription::create($subscriptionOptions);
    }

    public function getSubscription(string $subscriptionId): Subscription
    {
        return Subscription::retrieve($subscriptionId);
    }

    public function cancelSubscription(string $subscriptionId)
    {
        $subscription = $this->getSubscription($subscriptionId);
        $subscription->cancel();
    }


    #########################
    ##        Charge       ##
    #########################

    public function createCharge(
        string $token,
        int $amount,
        string $description,
        string $currency = 'mxn'
    ): Charge
    {
        return Charge::create([
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'source' => $token,
        ]);
    }

}
