<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\File;

/**
 * A PHP stream of unknown size.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class Stream extends File
{
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
    public function getSize()
    {
        return false;
    }
}
