<?php

namespace Illuminate\Console\Scheduling;

use Illuminate\Console\Command;
<<<<<<< HEAD
=======
use Illuminate\Support\Carbon;
use Symfony\Component\Console\Attribute\AsCommand;
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f

#[AsCommand(name: 'schedule:test')]
class ScheduleTestCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'schedule:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a scheduled command';

    /**
     * Execute the console command.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function handle(Schedule $schedule)
    {
        $commands = $schedule->events();

        $commandNames = [];

        foreach ($commands as $command) {
            $commandNames[] = $command->command ?? $command->getSummaryForDisplay();
        }

        $index = array_search($this->choice('Which command would you like to run?', $commandNames), $commandNames);

        $event = $commands[$index];

        $this->line('<info>['.date('c').'] Running scheduled command:</info> '.$event->getSummaryForDisplay());

        $event->run($this->laravel);
    }
}
