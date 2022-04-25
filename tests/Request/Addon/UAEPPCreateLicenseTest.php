<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Tests\Request\Addon;

use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon\UAEPPCreateLicense;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Tests\UAEPPTestCase;
use Struzik\EPPClient\Node\Domain\DomainContactNode;
use Struzik\EPPClient\Node\Domain\DomainPeriodNode;
use Struzik\EPPClient\Request\Domain\CreateDomainRequest;
use Struzik\EPPClient\Request\Domain\Helper\HostObject;

class UAEPPCreateLicenseTest extends UAEPPTestCase
{
    public function testCreate(): void
    {
        $expected = <<<'EOF'
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
  <command>
    <create>
      <domain:create xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
        <domain:name>example1.ua</domain:name>
        <domain:period unit="y">2</domain:period>
        <domain:ns>
          <domain:hostObj>ns1.domain.ua</domain:hostObj>
          <domain:hostObj>ns2.domain.ua</domain:hostObj>
        </domain:ns>
        <domain:registrant>ex123</domain:registrant>
        <domain:contact type="admin">ex11</domain:contact>
        <domain:contact type="tech">ex11</domain:contact>
        <domain:authInfo>
          <domain:pw>password</domain:pw>
        </domain:authInfo>
      </domain:create>
    </create>
    <extension>
      <uaepp:create xmlns:uaepp="http://hostmaster.ua/epp/uaepp-1.1">
        <uaepp:license>12345</uaepp:license>
      </uaepp:create>
    </extension>
    <clTRID>TEST-REQUEST-ID</clTRID>
  </command>
</epp>

EOF;
        $request = new CreateDomainRequest($this->eppClient);
        $request->setDomain('example1.ua');
        $request->setPeriod(2);
        $request->setUnit(DomainPeriodNode::UNIT_YEAR);
        $request->setNameservers([
            (new HostObject())->setHost('ns1.domain.ua'),
            (new HostObject())->setHost('ns2.domain.ua'),
        ]);
        $request->setRegistrant('ex123');
        $request->setContacts([
            DomainContactNode::TYPE_ADMIN => 'ex11',
            DomainContactNode::TYPE_TECH => 'ex11',
        ]);
        $request->setPassword('password');
        $request->addExtAddon((new UAEPPCreateLicense())->setLicense('12345'));
        $request->build();

        $this->assertSame($expected, $request->getDocument()->saveXML());
    }
}
