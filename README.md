# Polish Post PHP API
[Created with ![heart](http://i.imgur.com/oXJmdtz.gif) in Poland by RapidDev](http://rapiddev.pl/)<br />
Get parcel information, it's easy!
***

![PHP version from PHP-Eye](https://img.shields.io/php-eye/symfony/symfony.svg?style=for-the-badge)
![CRAN](https://img.shields.io/cran/l/devtools.svg?style=for-the-badge)
![234234](https://img.shields.io/github/languages/code-size/badges/shields.svg?style=for-the-badge)

***

## The easiest way
Download information from Polish Post, without using Soap, without knowing WSDL. PHP only.

## Use in your applications
With the help of this simple class, you can easily use the Polish Post API in your applications. Useful in plugins for WooCommerce! All you need to do is mark the author and put a copy of the license.

## Example usage
```php
include('polishpost_api.php');

$package = new PolishPostAPI();
var_dump($package->get_package('testp0'));
```
## What's included
```
polishpost_api/
├── readme.txt
└── polishpost_api.php
```

## How to install it?
Put the class in your project files, and then use the PolishPostApi.

### Other rights
* The class communicates with Poczta Polska, which is owned by Poczta Polska S.A.

## Update history
#### 1.0.0
1. Function was created
