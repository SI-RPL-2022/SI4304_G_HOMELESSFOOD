<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Event;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Allows to inspect input and output of a command.
 *
 * @author Francesco Levorato <git@flevour.net>
 */
class ConsoleEvent extends Event
{
    protected $command;

    private $input;
    private $output;

    public function __construct(Command $command = null, InputInterface $input, OutputInterface $output)
    {
        $this->command = $command;
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * Gets the command that is executed.
     *
<<<<<<< HEAD
     * @return Command|null
=======
     * @return Command|null A Command instance
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Gets the input instance.
     *
<<<<<<< HEAD
     * @return InputInterface
=======
     * @return InputInterface An InputInterface instance
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Gets the output instance.
     *
<<<<<<< HEAD
     * @return OutputInterface
=======
     * @return OutputInterface An OutputInterface instance
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getOutput()
    {
        return $this->output;
    }
}
