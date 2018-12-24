![Project Image](images/project-image-small.png)

# Google Authenticator

[![Build Status](https://travis-ci.org/jocic/PHP.GoogleAuthenticator.svg?branch=master)](https://travis-ci.org/jocic/PHP.GoogleAuthenticator) [![Coverage Status](https://coveralls.io/repos/github/jocic/PHP.GoogleAuthenticator/badge.svg?branch=master)](https://coveralls.io/github/jocic/PHP.GoogleAuthenticator?branch=master) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/8e44ebb82f3746cca8443b60b683706f)](https://www.codacy.com/app/jocic/PHP.GoogleAuthenticator?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=jocic/PHP.GoogleAuthenticator&amp;utm_campaign=Badge_Grade)

Google Authenticator is a mini PHP library for implementing Multi-Factor Authentication by utilizing Google's Authenticator App. It was written to simplify the implementation process and has no other dependencies.

Following specifications are referenced:

* [RFC 4648](documentation/rfc4648.txt) - Base 16, Base 32 & Base 64 Data Encodings
* [RFC 6238](documentation/rfc6238.txt) - TOTP: Time-Based One-Time Password Algorithm
* [RFC 6287](documentation/rfc6287.txt) - OCRA: OATH Challenge-Response Algorithm

**Note:** Composer is only used for managing testing-related libraries for development purposes, ex. PHPUnit.

[![Buy Me Coffee](images/buy-me-coffee.png)](https://www.paypal.me/DjordjeJocic)

**Project is still under development.**

## Versioning Scheme

I use a 3-digit [Semantic Versioning](https://semver.org/spec/v2.0.0.html) identifier, for example 1.0.2. These digits have the following meaning:

* The first digit (1) specifies the MAJOR version number.
* The second digit (0) specifies the MINOR version number.
* The third digit (2) specifies the PATCH version number.

Complete documentation can be found by following the link above.

## Examples

Following examples should be more then enough to get you started. I tried my best to make them as simple as possible so that everyone, even junior developers, can successfully use them for implementing two-factor authentication.

### Example 1 - Generating Secret

Generating a secret is quite a straightforward process, it is done upon instantiating an object.

```php
$secret = new Security\Mfa\GoogleAuthenticator\Secret();

echo $secret->getValue();
```

And if you are not satisfied with the returned value, you can simply generate a new one.

```php
$newSecret = $secret->generateValue();

$secret->setValue($newSecret);
```

**Note:** Secret is an encoded 80-bit value used for one-time password generation, and should be unique for each account.

### Example 2 - Different Methods

Secret can be generated using two different methods:

* **Base Method** - Random values from the base table are picked until an 80-bit value is formed.
* **Numerical Method** - Random numbers, ranging from 0 to 256, are generated until an 80-bit value is formed.

Base method is used by default, so you need not specify it. But in case something compels you, Satan for example, you can use the following.

```php
use Security\Mfa\GoogleAuthenticator\Secret;

$secret = new Secret();

echo $secret->generateValue(Secret::M_BASE);

```

To generate a secret using numerical method, use the following snippet.


```php
use Security\Mfa\GoogleAuthenticator\Secret;

$secret = new Secret();

echo $secret->generateValue(Secret::M_NUMERICAL);
```

### Example 3 - Setting Existing Secret

Settings a pre-existing secret is extremely simple.

```php
$existingSecret = "3SJRXZHGUVHAGD7R"; // Maybe It's Fetched From The Database

$secret = new Security\Mfa\GoogleAuthenticator\Secret();

$secret->setValue($existingSecret);
```

## Installation

There's two ways you can add **Google Authenticator** library to your project:

* Copying files from the "source" directory to your project and requiring the "Autoload.php" script
* Via Composer, by executing the command below

```bash
composer require jocic/google-authenticator
```

## Tests

Following unit tests are available:

* **Essentials** - Base 32 encoder, QR code generator, etc.
* **Elements** - Secret, etc.

You can execute them easily from the terminal like in the example below.

```bash
bash ./tests/wrapper.sh --testsuite essentials
bash ./tests/wrapper.sh --testsuite elements
```

## Contribution

Please review the following documents if you are planning to contribute to the project:

* [Contributor Covenant Code of Conduct](code_of_conduct.md)
* [Contribution Guidelines](contributing.md)
* [Pull Request Template](pull_request_template.md)
* [MIT License](license.md)

## Support

Please don't hessitate to contact me if you have any questions, ideas, or concerns.

My Twitter account is: [@jocic_91](https://www.twitter.com/jocic_91)

My support E-Mail address is: <support@djordjejocic.com>

## Copyright & License

Copyright (C) 2018 Đorđe Jocić

Licensed under the MIT license.