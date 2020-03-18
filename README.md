# DriveOpStripeBundle
A simple Symfony bundle for Stripe Api.

# Only SMS/WhatsApp!

## Setup

### Step 1: Download DriveOpStripeBundle using composer

Add Stripe Bundle in your composer.json:

```js
{
    "require": {
        "driveop/stripe-bundle": "^1.0"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update "driveop/stripe-bundle"
```


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new DriveOp\StripeBundle\DriveOpStripeBundle()
    );
}
```

### Step 3: Add configuration

``` yml
# app/config/config.yml
driveop:
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
