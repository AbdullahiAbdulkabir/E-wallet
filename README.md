# E-wallet
RUn this command to add paystack library
```bash
composer require unicodeveloper/laravel-paystack
```
You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel Paystack is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

> If you use **Laravel >= 5.5** you can skip this step and go to [**`configuration`**](https://github.com/unicodeveloper/laravel-paystack#configuration)

* `Unicodeveloper\Paystack\PaystackServiceProvider::class`

Also, register the Facade like so:
## Configuration

You can publish the configuration file using this command:

```bash
php artisan vendor:publish --provider="Unicodeveloper\Paystack\PaystackServiceProvider"
```

A configuration-file named `paystack.php` with some sensible defaults will be placed in your `config` directory:

```php
<?php

return [

    /**
     * Public Key From Paystack Dashboard
     *
     */
    'publicKey' => getenv('PAYSTACK_PUBLIC_KEY'),

    /**
     * Secret Key From Paystack Dashboard
     *
     */
    'secretKey' => getenv('PAYSTACK_SECRET_KEY'),

    /**
     * Paystack Payment URL
     *
     */
    'paymentUrl' => getenv('PAYSTACK_PAYMENT_URL'),

    /**
     * Optional email address of the merchant
     *
     */
    'merchantEmail' => getenv('MERCHANT_EMAIL'),

];
```


##General payment flow

Though there are multiple ways to pay an order, most payment gateways expect you to follow the following flow in your checkout process:

###1. The customer is redirected to the payment provider
After the customer has gone through the checkout process and is ready to pay, the customer must be redirected to site of the payment provider.

The redirection is accomplished by submitting a form with some hidden fields. The form must post to the site of the payment provider. The hidden fields minimally specify the amount that must be paid, the order id and a hash.

The hash is calculated using the hidden form fields and a non-public secret. The hash used by the payment provider to verify if the request is valid.


###2. The customer pays on the site of the payment provider
The customer arrived on the site of the payment provider and gets to choose a payment method. All steps necessary to pay the order are taken care of by the payment provider.

###3. The customer gets redirected back
After having paid the order the customer is redirected back. In the redirection request to the shop-site some values are returned. The values are usually the order id, a paymentresult and a hash.

The hash is calculated out of some of the fields returned and a secret non-public value. This hash is used to verify if the request is valid and comes from the payment provider. It is paramount that this hash is thoroughly checked.


## Usage

Open your .env file and add your public key, secret key, merchant email and payment url like so:


```php
PAYSTACK_PUBLIC_KEY=pk_test_6636127768f5f9a45047f62a08c7f7f20e8b106b
PAYSTACK_SECRET_KEY=sk_test_7dbaacccea5003afe6f89f82a0f755cbba99d959
PAYSTACK_PAYMENT_URL=https://api.paystack.co
MERCHANT_EMAIL=youremail@example.com
```
