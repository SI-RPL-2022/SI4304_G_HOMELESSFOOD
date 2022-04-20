<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Finder;

/**
 * Extends \SplFileInfo to support relative paths.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class SplFileInfo extends \SplFileInfo
{
    private $relativePath;
    private $relativePathname;

    /**
     * @param string $file             The file name
     * @param string $relativePath     The relative path
     * @param string $relativePathname The relative path name
     */
    public function __construct(string $file, string $relativePath, string $relativePathname)
    {
        parent::__construct($file);
        $this->relativePath = $relativePath;
        $this->relativePathname = $relativePathname;
    }

    /**
     * Returns the relative path.
     *
     * This path does not contain the file name.
     *
<<<<<<< HEAD
     * @return string
=======
     * @return string the relative path
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getRelativePath()
    {
        return $this->relativePath;
    }

    /**
     * Returns the relative path name.
     *
     * This path contains the file name.
     *
<<<<<<< HEAD
     * @return string
=======
     * @return string the relative path name
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getRelativePathname()
    {
        return $this->relativePathname;
    }

    public function getFilenameWithoutExtension(): string
    {
        $filename = $this->getFilename();

        return pathinfo($filename, \PATHINFO_FILENAME);
    }

    /**
     * Returns the contents of the file.
     *
<<<<<<< HEAD
     * @return string
=======
     * @return string the contents of the file
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     *
     * @throws \RuntimeException
     */
    public function getContents()
    {
        set_error_handler(function ($type, $msg) use (&$error) { $error = $msg; });
        $content = file_get_contents($this->getPathname());
        restore_error_handler();
        if (false === $content) {
            throw new \RuntimeException($error);
        }

        return $content;
    }
}
