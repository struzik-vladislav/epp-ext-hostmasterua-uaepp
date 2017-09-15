<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon;

use Struzik\EPPClient\Request\RequestInterface;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node\Update;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node\License;
use Struzik\EPPClient\Extension\RequestAddonInterface;
use Struzik\EPPClient\Exception\LogicException;

/**
 * Object representation of the add-on for domain updating command.
 * Add-on used for setting the number of certificate on trademark.
 */
class UpdateLicense implements RequestAddonInterface
{
    /**
     * @var \DOMElement
     */
    private $root;

    /**
     * @var bool
     */
    private $isBuilt = false;

    /**
     * @var string
     */
    private $license;

    /**
     * {@inheritdoc}
     */
    public function build(RequestInterface $request)
    {
        $uaeppUpdate = new Update($request);

        $uaeppLicense = new License($request, ['license' => $this->license]);
        $uaeppUpdate->append($uaeppLicense);

        $uaeppUpdate->build();
        $this->root = $uaeppUpdate->getNode();
        $this->isBuilt = true;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoot()
    {
        if (!$this->isBuilt) {
            throw new LogicException('You must build add-on before get the root element.');
        }

        return $this->root;
    }

    /**
     * Setting the number of certificate on trademark. REQUIRED.
     *
     * @param string $license number of certificate
     *
     * @return self
     */
    public function setLicense($license)
    {
        $this->license = $license;

        return $this;
    }

    /**
     * Getting the number of certificate on trademark.
     *
     * @return string
     */
    public function getLicense()
    {
        return $this->license;
    }
}
