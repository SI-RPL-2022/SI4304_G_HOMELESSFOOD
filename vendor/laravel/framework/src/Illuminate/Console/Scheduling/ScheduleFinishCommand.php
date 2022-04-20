<?php

namespace Illuminate\Console\Scheduling;

use Illuminate\Console\Command;

class ScheduleFinishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'schedule:finish {id} {code=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle the completion of a scheduled command';

    /**
     * Indicates whether the command should be shown in the Artisan command list.
     *
     * @var bool
     */
    protected $hidden = true;

    /**
     * Execute the console command.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function handle(Schedule $schedule)
    {
        collect($schedule->events())->filter(function ($value) {
            return $value->mutexName() == $this->argument('id');
<<<<<<< HEAD
        })->each(function ($event) {
            $event->callafterCallbacksWithExitCode($this->laravel, $this->argument('code'));

            $this->laravel->make(Dispatcher::class)->dispatch(new ScheduledBackgroundTaskFinished($event));
        });
=======
        })->each->callAfterCallbacksWithExitCode($this->laravel, $this->argument('code'));
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    }
}
