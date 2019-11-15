# FlightDeck - Level up your Laravel API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yabhq/flightdeck.svg?style=flat-square)](https://packagist.org/packages/yabhq/flightdeck)
[![CircleCI](https://img.shields.io/circleci/project/github/yabhq/flightdeck/master.svg)](https://circleci.com/gh/yabhq/flightdeck)
[![Quality Score](https://img.shields.io/scrutinizer/g/yabhq/flightdeck.svg?style=flat-square)](https://scrutinizer-ci.com/g/yabhq/flightdeck)
[![Total Downloads](https://img.shields.io/packagist/dt/yabhq/flightdeck.svg?style=flat-square)](https://packagist.org/packages/yabhq/flightdeck)


## Installation

You can install the package via composer:

```bash
composer require yabhq/flightdeck
```

## Usage

Generate new API key for authorization
```bash
php artisan flightdeck:generate app1
```

List all available API keys
```bash
php artisan flightdeck:list
```

## Multi-Auth

FlightDeck makes authenticating users with multiple guards a breeze.

Suppose you wish to add support for login, logout and token refreshing for a hypothetical "customer" user type.

Simply extend the FlightDeck `AuthController` class as follows:

```php
<?php

namespace App\Http\Controllers\Customer;

use Yab\FlightDeck\Http\Controllers\AuthController as FlightAuthController;

class AuthController extends FlightAuthController
{
    /**
     * Get the guard to be used for login, logout and token refreshes.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard('customer');
    }
}
```

You can also extend `FlightDeckForgotPasswordController` and `FlightDeckResetPasswordController` in a similar way.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email us instead of using the issue tracker.

## Credits

- [Chris Blackwell](https://github.com/chrisblackwell)
- [Jim Hlad](https://github.com/jimhlad)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
