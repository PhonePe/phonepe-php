## PhonePe Merchant Client Php

This is a Php client for merchant integration. A minimum of PHP 5.3 is required for using this client. For references on all the API's visit:
 
 **<http://developer.phonepe.com>**.
### Namespacing
* The Client is namespaced under **PhonePe**
* The Request and Response objects are defined in models that are namespaced under **PhonePe\\Models**

### Installation

* If your project uses composer, add the following lines to your composer.json :
```json
    {
        "require": {
            "phonepe/php-merchant-client": "1.*"
        }
    }
```
* Now, run **"composer update"**. You will find the php-merchant-client folder inside the vendors folder.

Please note that you will have to require the vendor/autoloader.php in order to autoload all the required classes.
  
### Usage

Use namespace PhonePe to access the client and call the function of the required Api from
the object of PhonePeClient Class.
<br> <p>
    For Example : 
```PHP
    use PhonePe\PhonePeClientImpl;
    use PhonePe\Models\RegularCreditRequest;
    
    require('vendor/autoload.php')      // For autoloading all the required classes
    
    $phonePeClientObject = new PhonePeClientImpl();
    $regularCreditRequestObject = new RegularCreditRequest();
    
    // 
    // Build the regularCreditRequestObject here
    // 
    
    $response = $phonePeClientObject->$regularCredit($regularCreditRequestObject)
    
    echo $response->redirectUrl;    // To get the location to redirect to.
```
</p>

The function will always return an Object of the corresponding return type.

#### Checksum Generator Usage

* Namespaced under PhonePe\Utils
* Call the function checkSumGenerate with an array of all the required variables and
the salt index
* Check the following example :

```php
    use PhonePe\Utils\ChecksumGenerator
    
    require('vendor/autoload.php')
    
    $args = array($merchantId, $transactionId, $amount, $saltKey, $saltIndex);
    $result = ChecksumGenerator::checkSumGenerate($args);
```
