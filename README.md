# W3samiStripeBundle
A simple wrapper for Stripe Api to use with Symfony 5.

This bundle wraps the stripe-php library, so you can inject it in your own symfony code with ease.
It provides a few shortcuts too, for getting and creating a client, creating and canceling a subscription and
making a single charge.

To see all available methods of stripe's php library, see https://github.com/stripe/stripe-php

## Setup

### Step 1: Install W3samiStripeBundle using composer

Install with composer by running the command:

``` bash
$ composer require "w3sami/stripe-bundle:1.*"
```

### Step 2: Add configuration

``` yml
# config/packages/w3sami.yml
w3sami:
  stripe:
    stripe_private_key: %stripe_private_key%
```

## Usage

**Using service**

``` php
<?php
  use W3sami\StripeBundle\Services\StripeClient;
  public function __construct(StripeClient $stripeClient) {
  }
?>
```

or 

``` php
<?php
  $stripeClient = $this->get('stripe_client');
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

To see all available api calls of stripe service see https://stripe.com/docs/api
