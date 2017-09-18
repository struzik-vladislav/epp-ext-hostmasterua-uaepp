# UAEPP Extension for EPP Client

UAEPP extension who was provided by Hostmaster (https://hostmaster.ua/).

Extension for struzik-vladislav/epp-client library.

## Usage
```php
<?php

use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\UAEPPExtension;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon\DeleteHost as UAEPPDeleteHost;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon\CreateLicense;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon\UpdateLicense;
use Struzik\EPPClient\Request\Host\Delete as DeleteHost;
use Struzik\EPPClient\Request\Domain\Create as CreateDomain;
use Struzik\EPPClient\Request\Domain\Update as UpdateDomain;

// ...

$client->pushExtension(new UAEPPExtension('http://hostmaster.ua/epp/uaepp-1.1', $logger));

// ...

$request = new DeleteHost($client);
$request->setHost('subdomain.example.net')
    ->addExtAddon(new UAEPPDeleteHost());
$response = $client->send($request);

// ...

$request = new CreateDomain($client);
$addon = new CreateLicense();
$addon->setLicense('certificate-number');
$request->addExtAddon($addon);
$response = $client->send($request);

// ...

$request = new UpdateDomain($client)
$addon = new UpdateLicense();
$addon->setLicense('certificate-number');
$request->addExtAddon($addon);
$response = $client->send($request);
```
