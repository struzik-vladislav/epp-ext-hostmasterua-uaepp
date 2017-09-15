<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Request\Addon;

use Struzik\EPPClient\Request\RequestInterface;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node\Delete;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node\DeleteNS;
use Struzik\EPPClient\Extension\RequestAddonInterface;
use Struzik\EPPClient\Exception\LogicException;

/**
 * Object representation of the add-on for host deleting command.
 * Add-on used for unconditionally delete a host object.
 */
class DeleteHost implements RequestAddonInterface
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
     * {@inheritdoc}
     */
    public function build(RequestInterface $request)
    {
        $uaeppDelete = new Delete($request);

        $uaeppDeleteNS = new DeleteNS($request);
        $uaeppDelete->append($uaeppDeleteNS);

        $uaeppDelete->build();
        $this->root = $uaeppDelete->getNode();
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
}
