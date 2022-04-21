<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node;

use Struzik\EPPClient\Exception\InvalidArgumentException;
use Struzik\EPPClient\Request\RequestInterface;

class UAEPPLicenseNode
{
    public static function create(RequestInterface $request, \DOMElement $parentNode, string $license): \DOMElement
    {
        if ($license === '') {
            throw new InvalidArgumentException('Invalid parameter "license".');
        }

        $node = $request->getDocument()->createElement('uaepp:license', $license);
        $parentNode->appendChild($node);

        return $node;
    }
}
