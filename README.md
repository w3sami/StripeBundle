# W3samiStripeBundle
A simple wrapper for Stripe Api to use with Symfony 5.

This bundle wraps the stripe-php library, so you can inject it in your own symfony code with ease.
It provides a few shortcuts too, for creating a client and subscription.

To see all available methods see https://github.com/stripe/stripe-php

## Setup

### Step 1: Install W3samiStripeBundle using composer

Install with composer by running the command:

``` bash
$ composer require "W3sami/stripe-bundle:^1.0.6"
```

### Step 2: Add configuration

``` yml
# app/config/config.yml
W3sami:
  stripe:
    stripe_private_key:    %stripe_private_key%
```

## Usage

**Using service**

``` php
<?php
  $stripeClient = $this->get('stripe_client');
?>
```

or 

``` php
<?php
  use W3sami\StripeBundle\Services\StripeClient;
  public function __construct(StripeClient $stripeClient) {
  }
?>
```

##Example

###Create customer & subscription
``` php
<?php 
    $customer = $stripeClient->createCustomer($token, $email, $name, $phone);

    // Store customer information

    $subsciption = $stripeClient->createSubscription($customerId, $planId);

    // Store subscription information

?>
```

To see all available api calls see https://stripe.com/docs/api
