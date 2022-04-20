<?php

namespace Illuminate\Session;

use Illuminate\Support\InteractsWithTime;
use SessionHandlerInterface;

class ArraySessionHandler implements SessionHandlerInterface
{
    use InteractsWithTime;

    /**
     * The array of stored values.
     *
     * @var array
     */
    protected $storage = [];

    /**
     * The number of minutes the session should be valid.
     *
     * @var int
     */
    protected $minutes;

    /**
     * Create a new array driven handler instance.
     *
     * @param  int  $minutes
     * @return void
     */
    public function __construct($minutes)
    {
        $this->minutes = $minutes;
    }

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
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function read($sessionId)
    {
        if (! isset($this->storage[$sessionId])) {
            return '';
        }

        $session = $this->storage[$sessionId];

        $expiration = $this->calculateExpiration($this->minutes * 60);

        if (isset($session['time']) && $session['time'] >= $expiration) {
            return $session['data'];
        }

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
        $this->storage[$sessionId] = [
            'data' => $data,
            'time' => $this->currentTime(),
        ];

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
        if (isset($this->storage[$sessionId])) {
            unset($this->storage[$sessionId]);
        }

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
        $expiration = $this->calculateExpiration($lifetime);

        foreach ($this->storage as $sessionId => $session) {
            if ($session['time'] < $expiration) {
                unset($this->storage[$sessionId]);
            }
        }

        return true;
    }

    /**
     * Get the expiration time of the session.
     *
     * @param  int  $seconds
     * @return int
     */
    protected function calculateExpiration($seconds)
    {
        return $this->currentTime() - $seconds;
    }
}
