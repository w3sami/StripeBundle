<?php

namespace DriveOp\TwilioBundle\Services;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Charge;

class StripeClient
{


    public function __construct($stripe_private_key)
    {
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        Stripe::setApiKey($stripe_private_key);
    }


    #########################
    ##       Customer      ##
    #########################

    /**
     * @param $token
     * @param $email
     * @param $name
     * @param $phone
     * @return Customer
     */
    public function createCustomer($token, $email, $name, $phone)
    {
        return Customer::create(array(
                "source" => $token,
                "name" => $name,
                "email" => $email,
                'phone' => $phone
            )
        );
    }

    /**
     * @param $customerId
     * @return Customer
     */
    public function getCustomer($customerId)
    {
        return Customer::retrieve($customerId);
    }

    #########################
    ##     Subscription    ##
    #########################

    /**
     * @param $customerId
     * @param $planId
     * @param null $trialEnd
     * @param null $billingCycleAnchor
     * @param null $coupon
     * @return Subscription
     */
    public function createSubscription($customerId, $planId, $trialEnd = null, $billingCycleAnchor = null, $coupon = null)
    {
        $subscriptionOptions = [
            'customer' => $customerId,
            'items' => [['plan' => $planId]]
        ];

        if ($trialEnd) $subscriptionOptions['trial_end'] = $trialEnd;
        if ($billingCycleAnchor) $subscriptionOptions['billing_cycle_anchor'] = $billingCycleAnchor;
        if ($coupon) $subscriptionOptions['coupon'] = $coupon;

        return Subscription::create($subscriptionOptions);
    }

    /**
     * @param $subscriptionId
     * @return Subscription
     */
    public function getSubscription($subscriptionId)
    {
        return Subscription::retrieve($subscriptionId);
    }

    /**
     * @param $subscriptionId
     */
    public function cancelSubscription($subscriptionId)
    {
        $subscription = $this->getSubscription($subscriptionId);
        $subscription->cancel();
    }


    #########################
    ##        Charge       ##
    #########################

    /**
     * @param $token
     * @param $amount
     * @param $description
     * @param string $currency
     * @return Charge
     */
    public function createCharge($token, $amount, $description, $currency = 'mxn')
    {
        return Charge::create([
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'source' => $token,
        ]);
    }

}