<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node;

use Struzik\EPPClient\Request\RequestInterface;

class UAEPPDeleteNSNode
{
    public const CONFIRM_YES = 'yes';

    public static function create(RequestInterface $request, \DOMElement $parentNode): \DOMElement
    {
        $node = $request->getDocument()->createElement('uaepp:deleteNS');
        $node->setAttribute('confirm', self::CONFIRM_YES);
        $parentNode->appendChild($node);

        return $node;
    }
}
