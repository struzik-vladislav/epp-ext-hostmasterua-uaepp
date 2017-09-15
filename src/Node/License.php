<?php

namespace Struzik\EPPClient\Extension\HostmasterUA\UAEPP\Node;

use Struzik\EPPClient\Node\AbstractNode;
use Struzik\EPPClient\Request\RequestInterface;
use Struzik\EPPClient\Exception\InvalidArgumentException;

/**
 * Object representation of the <uaepp:license> node.
 */
class License extends AbstractNode
{
    /**
     * @param RequestInterface $request    The request object to which the node belongs
     * @param array            $parameters Array of parameters who will be passed in self::handleParameters
     */
    public function __construct(RequestInterface $request, $parameters = [])
    {
        parent::__construct($request, 'uaepp:license', $parameters);
    }

    /**
     * {@inheritdoc}
     */
    protected function handleParameters($parameters = [])
    {
        if (!isset($parameters['license']) || empty($parameters['license'])) {
            throw new InvalidArgumentException('Missing parameter with a key \'license\'.');
        }

        $this->getNode()->nodeValue = $parameters['license'];
    }
}
