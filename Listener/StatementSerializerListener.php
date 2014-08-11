<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xabbuh\XApi\Bundle\LrsBundle\Listener;

use Xabbuh\XApi\Common\Serializer\StatementSerializerInterface;
use Xabbuh\XApi\Model\StatementInterface;

/**
 * Kernel event listener transforming statements into proper JSON responses.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
class StatementSerializerListener extends AbstractSerializerListener
{
    /**
     * @var \Xabbuh\XApi\Common\Serializer\StatementSerializerInterface
     */
    private $serializer;

    public function __construct(StatementSerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritDoc}
     */
    protected function isControllerResultSupported($result)
    {
        return $result instanceof StatementInterface;
    }

    /**
     * {@inheritDoc}
     */
    protected function serializeControllerResult($result)
    {
        return $this->serializer->serializeStatement($result);
    }
}
