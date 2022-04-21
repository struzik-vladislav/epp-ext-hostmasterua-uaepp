<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon;

use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node\UAEPPDeleteNode;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node\UAEPPDeleteNSNode;
use Struzik\EPPClient\Extension\RequestAddonInterface;
use Struzik\EPPClient\Node\Common\ExtensionNode;
use Struzik\EPPClient\Request\RequestInterface;

/**
 * Object representation of the add-on for host deleting command.
 * Add-on used for unconditionally delete a host object.
 */
class UAEPPDeleteHost implements RequestAddonInterface
{
    /**
     * {@inheritdoc}
     */
    public function build(RequestInterface $request): void
    {
        $extensionNodeList = $request->getDocument()->getElementsByTagName('extension');
        $extensionNode = $extensionNodeList->count() > 0 ? $extensionNodeList->item(0) : null;
        if ($extensionNode === null) {
            $extensionNode = ExtensionNode::create($request);
        }

        $uaeppDeleteNode = UAEPPDeleteNode::create($request, $extensionNode);
        UAEPPDeleteNSNode::create($request, $uaeppDeleteNode);
    }
}
