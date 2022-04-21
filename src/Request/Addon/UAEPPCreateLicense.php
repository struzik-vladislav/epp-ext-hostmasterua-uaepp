<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon;

use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node\UAEPPCreateNode;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node\UAEPPLicenseNode;
use Struzik\EPPClient\Extension\RequestAddonInterface;
use Struzik\EPPClient\Node\Common\ExtensionNode;
use Struzik\EPPClient\Request\RequestInterface;

/**
 * Object representation of the add-on for domain creating command.
 * Add-on used for setting the number of certificate on trademark.
 */
class UAEPPCreateLicense implements RequestAddonInterface
{
    private string $license = '';

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

        $uaeppCreateNode = UAEPPCreateNode::create($request, $extensionNode);
        UAEPPLicenseNode::create($request, $uaeppCreateNode, $this->license);
    }

    /**
     * Setting the number of certificate on trademark. REQUIRED.
     *
     * @param string $license number of certificate
     */
    public function setLicense(string $license): self
    {
        $this->license = $license;

        return $this;
    }

    /**
     * Getting the number of certificate on trademark.
     */
    public function getLicense(): string
    {
        return $this->license;
    }
}
