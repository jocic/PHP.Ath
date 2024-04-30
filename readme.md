# Google Authenticator

[![Coverage Status](https://coveralls.io/repos/github/jocic/PHP.GoogleAuthenticator/badge.svg?branch=master)](https://coveralls.io/github/jocic/PHP.GoogleAuthenticator?branch=master)
[![Latest Stable Version](https://poser.pugx.org/jocic/google-authenticator/v/stable)](https://packagist.org/packages/jocic/google-authenticator)
[![License](https://poser.pugx.org/jocic/google-authenticator/license)](https://packagist.org/packages/jocic/google-authenticator)

Google Authenticator is a mini PHP library for implementing Multi-Factor Authentication by utilizing Google's Authenticator App. It was written to simplify the usually complicated implementation process.

![Project Image](images/project-image-small.png)

Following specifications were referenced:

*   [RFC 4226](other/specifications/rfc4226.txt) - HMAC-Based One-Time Password Algorithm
*   [RFC 6238](other/specifications/rfc6238.txt) - TOTP: Time-Based One-Time Password Algorithm
*   [RFC 6287](other/specifications/rfc6287.txt) - OCRA: OATH Challenge-Response Algorithm

[![Buy Me Coffee](images/buy-me-coffee.png)](https://www.paypal.me/DjordjeJocic)

## Versioning Scheme

I use a 3-digit [Semantic Versioning](https://semver.org/spec/v2.0.0.html) identifier, for example 1.0.2. These digits have the following meaning:

*   The first digit (1) specifies the MAJOR version number.
*   The second digit (0) specifies the MINOR version number.
*   The third digit (2) specifies the PATCH version number.

Complete documentation can be found by following the link above.

## Examples

Following examples should be more then enough to get you started. I tried my best to make them as simple as possible so that everyone, even junior developers, can successfully use them for implementing two-factor authentication.

1.  [Creating a Secret](https://github.com/jocic/PHP.GoogleAuthenticator/wiki/Creating-a-Secret)
2.  [Secret Creation Methods](https://github.com/jocic/PHP.GoogleAuthenticator/wiki/Secret-Creation-Methods)
3.  [Setting Existing Secrets](https://github.com/jocic/PHP.GoogleAuthenticator/wiki/Setting-Existing-Secrets)
4.  [Creating an Account](https://github.com/jocic/PHP.GoogleAuthenticator/wiki/Creating-an-Account)
5.  [Account Management](https://github.com/jocic/PHP.GoogleAuthenticator/wiki/Account-Management)
6.  [QR Codes](https://github.com/jocic/PHP.GoogleAuthenticator/wiki/QR-Codes)
7.  [Code Validation](https://github.com/jocic/PHP.GoogleAuthenticator/wiki/Code-Validation)

For additional examples please review the official project's [wiki](https://github.com/jocic/PHP.GoogleAuthenticator/wiki).

## Requirements

You only need to have PHP >=7.0 available on your system to use **Google Authenticator** in your application. However, for running unit tests, you need to have the following extensions installed:

*   [Multibyte String](https://secure.php.net/manual/en/book.mbstring.php)
*   [DOM](https://secure.php.net/manual/en/dom.setup.php)

## Installation

There's two ways you can add **Google Authenticator** library to your project:

*   Copying files from the "source" directory to your project and requiring the "Autoload.php" script (this includes doing the same for project's dependencies ex. Encoders)
*   Via Composer, by executing the command below

```bash
composer require jocic/google-authenticator 1.0.0
```

## Tests

Following unit tests are available:

*   **Essentials** - Tests for library's essentials ex. Autoloader, Base 32 encoder, etc.
*   **QR Generators** - Tests for available QR code generators in the library.
*   **Elements** - Tests for library's core elements ex. Secret, Account, etc.

You can execute them easily from the terminal like in the example below.

```bash
bash ./scripts/phpunit.sh --testsuite essentials
bash ./scripts/phpunit.sh --testsuite qr-generators
bash ./scripts/phpunit.sh --testsuite elements
```

Please don’t forget to install necessary dependencies before attempting to do the God's work above. They may be important.

```bash
bash ./scripts/composer.sh install
```

## Copyright & License

Copyright (C) 2024 Đorđe Jocić

Licensed under the MIT license.
