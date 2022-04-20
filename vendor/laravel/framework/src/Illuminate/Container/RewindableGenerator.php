<?php

namespace Illuminate\Container;

use Countable;
use IteratorAggregate;

class RewindableGenerator implements Countable, IteratorAggregate
{
    /**
     * The generator callback.
     *
     * @var callable
     */
    protected $generator;

    /**
     * The number of tagged services.
     *
     * @var callable|int
     */
    protected $count;

    /**
     * Create a new generator instance.
     *
     * @param  callable  $generator
     * @param  callable|int  $count
     * @return void
     */
    public function __construct(callable $generator, $count)
    {
        $this->count = $count;
        $this->generator = $generator;
    }

    /**
     * Get an iterator from the generator.
     *
     * @return mixed
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function getIterator()
    {
        return ($this->generator)();
    }

    /**
     * Get the total number of tagged services.
     *
     * @return int
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function count()
    {
        if (is_callable($count = $this->count)) {
            $this->count = $count();
        }

        return $this->count;
    }
}
