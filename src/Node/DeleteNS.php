<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node;

use Struzik\EPPClient\Node\AbstractNode;
use Struzik\EPPClient\Request\RequestInterface;

/**
 * Object representation of the <uaepp:deleteNS> node.
 */
class DeleteNS extends AbstractNode
{
    const CONFIRM_YES = 'yes';

    /**
     * @param RequestInterface $request The request object to which the node belongs
     */
    public function __construct(RequestInterface $request)
    {
        parent::__construct($request, 'uaepp:deleteNS');
    }

    /**
     * {@inheritdoc}
     */
    protected function handleParameters($parameters = [])
    {
        $this->getNode()->setAttribute('confirm', self::CONFIRM_YES);
    }
}
