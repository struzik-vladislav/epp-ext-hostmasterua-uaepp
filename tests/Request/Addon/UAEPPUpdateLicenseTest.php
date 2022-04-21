<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Tests\Request\Addon;

use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon\UAEPPUpdateLicense;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Tests\EPPTestCase;
use Struzik\EPPClient\Request\Domain\UpdateDomainRequest;

class UAEPPUpdateLicenseTest extends EPPTestCase
{
    public function testUpdate(): void
    {
        $expected = <<<'EOF'
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
  <command>
    <update>
      <domain:update xmlns:domain="http://hostmaster.ua/epp/domain-1.1">
        <domain:name>example1.ua</domain:name>
      </domain:update>
    </update>
    <extension>
      <uaepp:update xmlns:uaepp="http://hostmaster.ua/epp/uaepp-1.1">
        <uaepp:license>12345</uaepp:license>
      </uaepp:update>
    </extension>
    <clTRID>TEST-REQUEST-ID</clTRID>
  </command>
</epp>

EOF;
        $request = new UpdateDomainRequest($this->eppClient);
        $request->setDomain('example1.ua');
        $request->addExtAddon((new UAEPPUpdateLicense())->setLicense('12345'));
        $request->build();

        $this->assertSame($expected, $request->getDocument()->saveXML());
    }
}
