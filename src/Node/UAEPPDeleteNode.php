<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node;

use Struzik\EPPClient\Exception\UnexpectedValueException;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\UAEPPExtension;
use Struzik\EPPClient\Request\RequestInterface;

class UAEPPDeleteNode
{
    public static function create(RequestInterface $request, \DOMElement $parentNode): \DOMElement
    {
        $namespace = $request->getClient()
            ->getExtNamespaceCollection()
            ->offsetGet(UAEPPExtension::NS_NAME_UAEPP);
        if (!$namespace) {
            throw new UnexpectedValueException('URI of the UAEPP namespace cannot be empty.');
        }

        $node = $request->getDocument()->createElement('uaepp:delete');
        $node->setAttribute('xmlns:uaepp', $namespace);
        $parentNode->appendChild($node);

        return $node;
    }
}
