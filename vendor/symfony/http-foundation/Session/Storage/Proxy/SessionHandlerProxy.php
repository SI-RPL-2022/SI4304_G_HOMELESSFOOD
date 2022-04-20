<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session\Storage\Proxy;

/**
 * @author Drak <drak@zikula.org>
 */
class SessionHandlerProxy extends AbstractProxy implements \SessionHandlerInterface, \SessionUpdateTimestampHandlerInterface
{
    protected $handler;

    public function __construct(\SessionHandlerInterface $handler)
    {
        $this->handler = $handler;
        $this->wrapper = ($handler instanceof \SessionHandler);
        $this->saveHandlerName = $this->wrapper ? ini_get('session.save_handler') : 'user';
    }

    /**
     * @return \SessionHandlerInterface
     */
    public function getHandler()
    {
        return $this->handler;
    }

    // \SessionHandlerInterface

    /**
     * @return bool
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function open($savePath, $sessionName)
    {
        return (bool) $this->handler->open($savePath, $sessionName);
    }

    /**
     * @return bool
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function close()
    {
        return (bool) $this->handler->close();
    }

    /**
<<<<<<< HEAD
     * @return string|false
     */
    #[\ReturnTypeWillChange]
=======
     * @return string
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function read($sessionId)
    {
        return (string) $this->handler->read($sessionId);
    }

    /**
     * @return bool
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function write($sessionId, $data)
    {
        return (bool) $this->handler->write($sessionId, $data);
    }

    /**
     * @return bool
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function destroy($sessionId)
    {
        return (bool) $this->handler->destroy($sessionId);
    }

    /**
<<<<<<< HEAD
     * @return int|false
     */
    #[\ReturnTypeWillChange]
=======
     * @return bool
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function gc($maxlifetime)
    {
        return (bool) $this->handler->gc($maxlifetime);
    }

    /**
     * @return bool
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function validateId($sessionId)
    {
        return !$this->handler instanceof \SessionUpdateTimestampHandlerInterface || $this->handler->validateId($sessionId);
    }

    /**
     * @return bool
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function updateTimestamp($sessionId, $data)
    {
        return $this->handler instanceof \SessionUpdateTimestampHandlerInterface ? $this->handler->updateTimestamp($sessionId, $data) : $this->write($sessionId, $data);
    }
}
