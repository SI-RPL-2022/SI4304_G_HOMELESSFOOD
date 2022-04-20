<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\CacheClearer;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class Psr6CacheClearer implements CacheClearerInterface
{
    private $pools = [];

    public function __construct(array $pools = [])
    {
        $this->pools = $pools;
    }

<<<<<<< HEAD
    /**
     * @return bool
     */
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function hasPool(string $name)
    {
        return isset($this->pools[$name]);
    }

<<<<<<< HEAD
    /**
     * @return CacheItemPoolInterface
     *
     * @throws \InvalidArgumentException If the cache pool with the given name does not exist
     */
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function getPool(string $name)
    {
        if (!$this->hasPool($name)) {
            throw new \InvalidArgumentException(sprintf('Cache pool not found: "%s".', $name));
        }

        return $this->pools[$name];
    }

<<<<<<< HEAD
    /**
     * @return bool
     *
     * @throws \InvalidArgumentException If the cache pool with the given name does not exist
     */
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function clearPool(string $name)
    {
        if (!isset($this->pools[$name])) {
            throw new \InvalidArgumentException(sprintf('Cache pool not found: "%s".', $name));
        }

        return $this->pools[$name]->clear();
    }

    /**
     * {@inheritdoc}
     */
    public function clear(string $cacheDir)
    {
        foreach ($this->pools as $pool) {
            $pool->clear();
        }
    }
}
