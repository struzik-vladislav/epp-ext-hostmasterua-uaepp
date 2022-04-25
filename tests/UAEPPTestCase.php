<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Tests;

use Psr\Log\NullLogger;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\UAEPPExtension;
use Struzik\EPPClient\Tests\EPPTestCase;

class UAEPPTestCase extends EPPTestCase
{
    public UAEPPExtension $uaeppExtension;

    protected function setUp(): void
    {
        parent::setUp();
        $this->uaeppExtension = new UAEPPExtension('http://hostmaster.ua/epp/uaepp-1.1', new NullLogger());
        $this->eppClient->pushExtension($this->uaeppExtension);
    }
}
