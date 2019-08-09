# Buffer SDK PHP
Buffer SDK PHP is a wrapper for the Buffer API service

## Getting Started

### Prerequisites
- PHP >=7.1

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

## Authors
* **Miguel Ángel Martín** - [@miguelbemartin](https://twitter.com/miguelbemartin)

## License
This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
