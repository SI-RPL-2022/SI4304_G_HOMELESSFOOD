<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Finder\Iterator;

use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Extends the \RecursiveDirectoryIterator to support relative paths.
 *
 * @author Victor Berchet <victor@suumit.com>
 */
class RecursiveDirectoryIterator extends \RecursiveDirectoryIterator
{
    /**
     * @var bool
     */
    private $ignoreUnreadableDirs;

    /**
     * @var bool
     */
    private $rewindable;

    // these 3 properties take part of the performance optimization to avoid redoing the same work in all iterations
    private $rootPath;
    private $subPath;
    private $directorySeparator = '/';

    /**
     * @throws \RuntimeException
     */
    public function __construct(string $path, int $flags, bool $ignoreUnreadableDirs = false)
    {
        if ($flags & (self::CURRENT_AS_PATHNAME | self::CURRENT_AS_SELF)) {
            throw new \RuntimeException('This iterator only support returning current as fileinfo.');
        }

        parent::__construct($path, $flags);
        $this->ignoreUnreadableDirs = $ignoreUnreadableDirs;
        $this->rootPath = $path;
        if ('/' !== \DIRECTORY_SEPARATOR && !($flags & self::UNIX_PATHS)) {
            $this->directorySeparator = \DIRECTORY_SEPARATOR;
        }
    }

    /**
     * Return an instance of SplFileInfo with support for relative paths.
     *
<<<<<<< HEAD
     * @return SplFileInfo
     */
    #[\ReturnTypeWillChange]
=======
     * @return SplFileInfo File information
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function current()
    {
        // the logic here avoids redoing the same work in all iterations

        if (null === $subPathname = $this->subPath) {
<<<<<<< HEAD
            $subPathname = $this->subPath = $this->getSubPath();
=======
            $subPathname = $this->subPath = (string) $this->getSubPath();
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
        }
        if ('' !== $subPathname) {
            $subPathname .= $this->directorySeparator;
        }
        $subPathname .= $this->getFilename();

        if ('/' !== $basePath = $this->rootPath) {
            $basePath .= $this->directorySeparator;
        }

        return new SplFileInfo($basePath.$subPathname, $this->subPath, $subPathname);
    }

<<<<<<< HEAD
    /**
     * @param bool $allowLinks
     *
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function hasChildren($allowLinks = false)
    {
        $hasChildren = parent::hasChildren($allowLinks);

        if (!$hasChildren || !$this->ignoreUnreadableDirs) {
            return $hasChildren;
        }

        try {
            parent::getChildren();

            return true;
        } catch (\UnexpectedValueException $e) {
            // If directory is unreadable and finder is set to ignore it, skip children
            return false;
        }
    }

    /**
     * @return \RecursiveDirectoryIterator
     *
     * @throws AccessDeniedException
     */
    #[\ReturnTypeWillChange]
=======
    /**
     * @return \RecursiveIterator
     *
     * @throws AccessDeniedException
     */
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function getChildren()
    {
        try {
            $children = parent::getChildren();

            if ($children instanceof self) {
                // parent method will call the constructor with default arguments, so unreadable dirs won't be ignored anymore
                $children->ignoreUnreadableDirs = $this->ignoreUnreadableDirs;

                // performance optimization to avoid redoing the same work in all children
                $children->rewindable = &$this->rewindable;
                $children->rootPath = $this->rootPath;
            }

            return $children;
        } catch (\UnexpectedValueException $e) {
            if ($this->ignoreUnreadableDirs) {
                // If directory is unreadable and finder is set to ignore it, a fake empty content is returned.
                return new \RecursiveArrayIterator([]);
            } else {
                throw new AccessDeniedException($e->getMessage(), $e->getCode(), $e);
            }
        }
    }

    /**
     * Do nothing for non rewindable stream.
     *
     * @return void
     */
<<<<<<< HEAD
    #[\ReturnTypeWillChange]
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    public function rewind()
    {
        if (false === $this->isRewindable()) {
            return;
        }

        parent::rewind();
    }

    /**
     * Checks if the stream is rewindable.
     *
<<<<<<< HEAD
     * @return bool
=======
     * @return bool true when the stream is rewindable, false otherwise
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function isRewindable()
    {
        if (null !== $this->rewindable) {
            return $this->rewindable;
        }

        if (false !== $stream = @opendir($this->getPath())) {
            $infos = stream_get_meta_data($stream);
            closedir($stream);

            if ($infos['seekable']) {
                return $this->rewindable = true;
            }
        }

        return $this->rewindable = false;
    }
}
