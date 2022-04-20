<?php

namespace Illuminate\Session;

use SessionHandlerInterface;

class NullSessionHandler implements SessionHandlerInterface
{
    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function open($savePath, $sessionName)
    {
        return true;
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
<<<<<<< HEAD
     *
     * @return string|false
     */
    #[\ReturnTypeWillChange]
=======
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function read($sessionId)
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function write($sessionId, $data)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function destroy($sessionId)
    {
        return true;
    }

    /**
     * {@inheritdoc}
<<<<<<< HEAD
     *
     * @return int|false
     */
    #[\ReturnTypeWillChange]
=======
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function gc($lifetime)
    {
        return true;
    }
}
