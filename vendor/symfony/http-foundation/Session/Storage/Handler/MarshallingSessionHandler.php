<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session\Storage\Handler;

use Symfony\Component\Cache\Marshaller\MarshallerInterface;

/**
 * @author Ahmed TAILOULOUTE <ahmed.tailouloute@gmail.com>
 */
class MarshallingSessionHandler implements \SessionHandlerInterface, \SessionUpdateTimestampHandlerInterface
{
    private $handler;
    private $marshaller;

    public function __construct(AbstractSessionHandler $handler, MarshallerInterface $marshaller)
    {
        $this->handler = $handler;
        $this->marshaller = $marshaller;
    }

    /**
<<<<<<< HEAD
     * @return bool
     */
    #[\ReturnTypeWillChange]
=======
     * {@inheritdoc}
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function open($savePath, $name)
    {
        return $this->handler->open($savePath, $name);
    }

    /**
<<<<<<< HEAD
     * @return bool
     */
    #[\ReturnTypeWillChange]
=======
     * {@inheritdoc}
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function close()
    {
        return $this->handler->close();
    }

    /**
<<<<<<< HEAD
     * @return bool
     */
    #[\ReturnTypeWillChange]
=======
     * {@inheritdoc}
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function destroy($sessionId)
    {
        return $this->handler->destroy($sessionId);
    }

    /**
<<<<<<< HEAD
     * @return int|false
     */
    #[\ReturnTypeWillChange]
=======
     * {@inheritdoc}
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function gc($maxlifetime)
    {
        return $this->handler->gc($maxlifetime);
    }

    /**
<<<<<<< HEAD
     * @return string
     */
    #[\ReturnTypeWillChange]
=======
     * {@inheritdoc}
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function read($sessionId)
    {
        return $this->marshaller->unmarshall($this->handler->read($sessionId));
    }

    /**
<<<<<<< HEAD
     * @return bool
     */
    #[\ReturnTypeWillChange]
=======
     * {@inheritdoc}
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function write($sessionId, $data)
    {
        $failed = [];
        $marshalledData = $this->marshaller->marshall(['data' => $data], $failed);

        if (isset($failed['data'])) {
            return false;
        }

        return $this->handler->write($sessionId, $marshalledData['data']);
    }

    /**
<<<<<<< HEAD
     * @return bool
     */
    #[\ReturnTypeWillChange]
=======
     * {@inheritdoc}
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function validateId($sessionId)
    {
        return $this->handler->validateId($sessionId);
    }

    /**
<<<<<<< HEAD
     * @return bool
     */
    #[\ReturnTypeWillChange]
=======
     * {@inheritdoc}
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function updateTimestamp($sessionId, $data)
    {
        return $this->handler->updateTimestamp($sessionId, $data);
    }
}
