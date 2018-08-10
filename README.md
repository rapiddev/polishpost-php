# Polish Post PHP API
[Created with ![heart](http://i.imgur.com/oXJmdtz.gif) in Poland by RapidDev](http://rapiddev.pl/)<br />
Get parcel information, it's easy!
***

![PHP version from PHP-Eye](https://img.shields.io/php-eye/symfony/symfony.svg?style=for-the-badge)
![CRAN](https://img.shields.io/cran/l/devtools.svg?style=for-the-badge)

***

## The easiest way
Download information from Polish Post, without using Soap, without knowing WSDL. PHP only.

## Use in your applications
With the help of this simple class, you can easily use the Polish Post API in your applications. Useful in plugins for WooCommerce! All you need to do is mark the author and put a copy of the license.

## Example usage
```php
include('polishpost_api.php');

$package = new PolishPostAPI('testp0');
$event = $package->get_last_event();
```

## Application in practice
```php
$package = new PolishPostAPI('00459007736006736603');
$event = $package->get_last_event();
if (isset($event['czas']) && isset($event['nazwa']))
{
	$html = '<small>'.$event['czas'].'</small>';
	$html .= '<p><strong>'.$event['nazwa'].'</strong></p>';
}
else
{
	$html = '<strong>'.__('Unknown shipment status', 'plugin_locale').'</strong>';
}
echo $html;
```

## Available methods
```php
$package->get_package();
$package->get_posting_date();
$package->get_events();
$package->get_last_event();
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
#### 0.4.0
1. The get_posting_date method was created and tested
2. The get_events method was created and tested
#### 0.3.0
1. The get_last_event method was created and tested
#### 0.2.0
1. Class was created
2. The get_package method was created and tested
3. Precise description of all elements
#### 0.1.0
1. Function was created
