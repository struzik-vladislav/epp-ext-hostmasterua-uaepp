# HostmasterUA UAEPP Extension for EPP Client
![Build Status](https://github.com/struzik-vladislav/epp-ext-hostmasterua-uaepp/actions/workflows/ci.yml/badge.svg?branch=master)
[![Latest Stable Version](https://img.shields.io/github/v/release/struzik-vladislav/epp-ext-hostmasterua-uaepp?sort=semver&style=flat-square)](https://packagist.org/packages/struzik-vladislav/epp-ext-hostmasterua-uaepp)
[![Total Downloads](https://img.shields.io/packagist/dt/struzik-vladislav/epp-ext-hostmasterua-uaepp?style=flat-square)](https://packagist.org/packages/struzik-vladislav/epp-ext-hostmasterua-uaepp/stats)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![StandWithUkraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/badges/StandWithUkraine.svg)](https://github.com/vshymanskyy/StandWithUkraine/blob/main/docs/README.md)

UAEPP extension provided by [HostmasterUA](https://hostmaster.ua/).

Extension for [struzik-vladislav/epp-client](https://github.com/struzik-vladislav/epp-client) library.

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
