# HostmasterUA UAEPP Extension for EPP Client

UAEPP extension who was provided by Hostmaster (https://hostmaster.ua/).

Extension for `struzik-vladislav/epp-client` library.

## Usage
```php
<?php

use Psr\Log\NullLogger;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\UAEPPExtension;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon\UAEPPDeleteHost;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon\UAEPPCreateLicense;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon\UAEPPUpdateLicense;
use Struzik\EPPClient\Request\Host\DeleteHostRequest;
use Struzik\EPPClient\Request\Domain\CreateDomainRequest;
use Struzik\EPPClient\Request\Domain\UpdateDomainRequest;

// ...

$client->pushExtension(new UAEPPExtension('http://hostmaster.ua/epp/uaepp-1.1', new NullLogger()));

// ...

$request = new DeleteHostRequest($client);
$request->setHost('subdomain.example.net')
    ->addExtAddon(new UAEPPDeleteHost());
$response = $client->send($request);

// ...

$request = new CreateDomainRequest($client);
$addon = new UAEPPCreateLicense();
$addon->setLicense('certificate-number');
$request->addExtAddon($addon);
$response = $client->send($request);

// ...

$request = new UpdateDomainRequest($client);
$addon = new UAEPPUpdateLicense();
$addon->setLicense('certificate-number');
$request->addExtAddon($addon);
$response = $client->send($request);
```
