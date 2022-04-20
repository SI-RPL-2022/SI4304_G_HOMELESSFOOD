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

/**
 * Can be used in unit testing or in a situations where persisted sessions are not desired.
 *
 * @author Drak <drak@zikula.org>
 */
class NullSessionHandler extends AbstractSessionHandler
{
    /**
     * @return bool
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function close()
    {
        return true;
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
        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function doRead(string $sessionId)
    {
        return '';
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
        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function doWrite(string $sessionId, string $data)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function doDestroy(string $sessionId)
    {
        return true;
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
        return true;
    }
}
