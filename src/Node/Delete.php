<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node;

use Struzik\EPPClient\Node\AbstractNode;
use Struzik\EPPClient\Request\RequestInterface;
use Struzik\EPPClient\Exception\UnexpectedValueException;
use Struzik\EPPClient\Extension\HostmasterUA\UAEPP\UAEPPExtension;

/**
 * Object representation of the <uaepp:delete> node.
 */
class Delete extends AbstractNode
{
    /**
     * @param RequestInterface $request The request object to which the node belongs
     */
    public function __construct(RequestInterface $request)
    {
        parent::__construct($request, 'uaepp:delete');
    }

    /**
     * {@inheritdoc}
     */
    protected function handleParameters($parameters = [])
    {
        $namespace = $this->getRequest()
            ->getClient()
            ->getExtNamespaceCollection()
            ->offsetGet(UAEPPExtension::NS_NAME_UAEPP);
        if (!$namespace) {
            throw new UnexpectedValueException('URI of the UAEPP namespace cannot be empty.');
        }

        $this->getNode()->setAttribute('xmlns:uaepp', $namespace);
    }
}
