<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon;

use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node\UAEPPLicenseNode;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node\UAEPPUpdateNode;
use Struzik\EPPClient\Extension\RequestAddonInterface;
use Struzik\EPPClient\Node\Common\ExtensionNode;
use Struzik\EPPClient\Request\RequestInterface;

/**
 * Object representation of the add-on for domain updating command.
 * Add-on used for setting the number of certificate on trademark.
 */
class UAEPPUpdateLicense implements RequestAddonInterface
{
    private string $license = '';

    /**
     * {@inheritdoc}
     */
    public function build(RequestInterface $request): void
    {
        $extensionNode = ExtensionNode::create($request);
        $uaeppUpdateNode = UAEPPUpdateNode::create($request, $extensionNode);
        UAEPPLicenseNode::create($request, $uaeppUpdateNode, $this->license);
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
