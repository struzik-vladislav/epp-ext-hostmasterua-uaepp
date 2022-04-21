<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Struzik\EPPClient\Connection\ConnectionInterface;
use Struzik\EPPClient\EPPClient;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Tests\Connection\TestConnection;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Tests\IdGenerator\TestGenerator;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\UAEPPExtension;
use Struzik\EPPClient\NamespaceCollection;

class EPPTestCase extends TestCase
{
    public ConnectionInterface $eppConnection;
    public EPPClient $eppClient;
    public UAEPPExtension $uaeppExtension;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eppConnection = new TestConnection();
        $this->eppClient = new EPPClient($this->eppConnection, new NullLogger());
        $this->eppClient->setIdGenerator(new TestGenerator());
        $namespaceCollection = $this->eppClient->getNamespaceCollection();
        $namespaceCollection->offsetSet(NamespaceCollection::NS_NAME_ROOT, 'urn:ietf:params:xml:ns:epp-1.0');
        $namespaceCollection->offsetSet(NamespaceCollection::NS_NAME_CONTACT, 'http://hostmaster.ua/epp/contact-1.1');
        $namespaceCollection->offsetSet(NamespaceCollection::NS_NAME_HOST, 'http://hostmaster.ua/epp/host-1.1');
        $namespaceCollection->offsetSet(NamespaceCollection::NS_NAME_DOMAIN, 'http://hostmaster.ua/epp/domain-1.1');

        $this->uaeppExtension = new UAEPPExtension('http://hostmaster.ua/epp/uaepp-1.1', new NullLogger());
        $this->eppClient->pushExtension($this->uaeppExtension);
    }
}
