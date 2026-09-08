# ![Buffer logo](https://buffer.com/images/buffer-logo.svg)

[![Build Status](https://travis-ci.org/miguelbemartin/buffer-sdk-php.svg?branch=master)](https://travis-ci.org/miguelbemartin/buffer-sdk-php)

This library allows you to quickly and easily use the Buffer Web API v1 via PHP.

[Official Documentation](https://buffer.com/developers)


## Getting Started

### Prerequisites
- PHP >=8.2

### Installation
Run into the terminal the next command

```
composer require miguelbemartin/buffer-sdk-php
```

## Usage

```php
// Create a new AuthorizationToken
$auth = new AuthorizationToken('XXX');

// Create a new Buffer Wrapper Client
$buffer = new Buffer($auth);

// Get User
$user = $buffer->userService->getUser();

// Get the profiles
$profiles = $buffer->profileService->getProfiles();
```

## Run the tests

```
./vendor/bin/phpunit
```

## Contributing
* Open a PR: https://github.com/miguelbemartin/buffer-sdk-php/pulls
* Open an issue: https://github.com/miguelbemartin/buffer-sdk-php/issues

## Authors
* **Miguel Ángel Martín** - [@miguelbemartin](https://twitter.com/miguelbemartin)

## License
This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
