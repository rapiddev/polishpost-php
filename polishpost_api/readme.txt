CONTENTS OF THIS FILE
---------------------
 * Introduction
 * Requirements
 * Installation


 INTRODUCTION
------------
PolishPostAPI is a simple class that facilitates the use of the Poczta
Polska API. By default, the API uses WSDL. Using PHP 7 and the SOAP
library, we processed many requests and converted them into simple requests
using CURL.

 * For a full description of the module, visit the project page:
   https://github.com/rapiddev/polishpost-php

 * To submit bug reports and feature suggestions, or to track changes:
   https://github.com/rapiddev/polishpost-php/issues


 REQUIREMENTS
------------
For this class to work properly, the following functions must work for you:

 * curl_init (http://php.net/manual/en/book.curl.php)
 * simplexml_load_string (http://php.net/manual/en/function.simplexml-load-string.php)

 INSTALLATION
------------
To make this class work, use include for the file polishpost_api.php