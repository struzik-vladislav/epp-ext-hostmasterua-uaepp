<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Tests\Request\Addon;

use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon\UAEPPDeleteHost;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Tests\UAEPPTestCase;
use Struzik\EPPClient\Request\Host\DeleteHostRequest;

class UAEPPDeleteHostTest extends UAEPPTestCase
{
    public function testDelete(): void
    {
        $expected = <<<'EOF'
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
  <command>
    <delete>
      <host:delete xmlns:host="urn:ietf:params:xml:ns:host-1.0">
        <host:name>ns5.example.epp1.ua</host:name>
      </host:delete>
    </delete>
    <extension>
      <uaepp:delete xmlns:uaepp="http://hostmaster.ua/epp/uaepp-1.1">
        <uaepp:deleteNS confirm="yes"/>
      </uaepp:delete>
    </extension>
    <clTRID>TEST-REQUEST-ID</clTRID>
  </command>
</epp>

EOF;
        $request = new DeleteHostRequest($this->eppClient);
        $request->setHost('ns5.example.epp1.ua');
        $request->addExtAddon(new UAEPPDeleteHost());
        $request->build();

        $this->assertSame($expected, $request->getDocument()->saveXML());
    }
}
