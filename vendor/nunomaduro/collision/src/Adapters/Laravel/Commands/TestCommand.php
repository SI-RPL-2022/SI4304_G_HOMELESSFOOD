<?php

declare(strict_types=1);

namespace NunoMaduro\Collision\Adapters\Laravel\Commands;

use Dotenv\Exception\InvalidPathException;
use Dotenv\Parser\Parser;
use Dotenv\Store\StoreBuilder;
use Illuminate\Console\Command;
use Illuminate\Support\Env;
use Illuminate\Support\Str;
<<<<<<< HEAD
use NunoMaduro\Collision\Adapters\Laravel\Exceptions\RequirementsException;
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
use RuntimeException;
use Symfony\Component\Process\Exception\ProcessSignaledException;
use Symfony\Component\Process\Process;

/**
 * @final
 */
class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $signature = 'test
        {--without-tty : Disable output to TTY}
        {--p|parallel : Indicates if the tests should run in parallel}
        {--recreate-databases : Indicates if the test databases should be re-created}
    ';
=======
    protected $signature = 'test {--without-tty : Disable output to TTY}';
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the application tests';

    /**
     * The arguments to be used while calling phpunit.
     *
     * @var array
     */
    protected $arguments = [
        '--printer',
        'NunoMaduro\Collision\Adapters\Phpunit\Printer',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->ignoreValidationErrors();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ((int) \PHPUnit\Runner\Version::id()[0] < 9) {
            throw new RuntimeException('Running Collision ^5.0 artisan test command requires PHPUnit ^9.0.');
        }

        // @phpstan-ignore-next-line
        if ((int) \Illuminate\Foundation\Application::VERSION[0] < 8) {
<<<<<<< HEAD
            throw new RequirementsException('Running Collision ^5.0 artisan test command requires at least Laravel ^8.0.');
        }

        if ($this->option('parallel') && !$this->isParallelDependenciesInstalled()) {
            if (!$this->confirm('Running tests in parallel requires "brianium/paratest". Do you wish to install it as a dev dependency?')) {
                return 1;
            }

            $this->installParallelDependencies();
=======
            throw new RuntimeException('Running Collision ^5.0 artisan test command requires Laravel ^8.0.');
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
        }

        $options = array_slice($_SERVER['argv'], $this->option('without-tty') ? 3 : 2);

        $this->clearEnv();

        $process = (new Process(array_merge(
            $this->binary(),
            array_merge(
                $this->arguments,
                $this->phpunitArguments($options)
            )
        )))->setTimeout(null);

        try {
            $process->setTty(!$this->option('without-tty'));
        } catch (RuntimeException $e) {
            $this->output->writeln('Warning: ' . $e->getMessage());
        }

        try {
            return $process->run(function ($type, $line) {
                $this->output->write($line);
            });
        } catch (ProcessSignaledException $e) {
            if (extension_loaded('pcntl') && $e->getSignal() !== SIGINT) {
                throw $e;
            }
        }
    }

    /**
     * Get the PHP binary to execute.
     *
     * @return array
     */
    protected function binary()
    {
<<<<<<< HEAD
        if (class_exists(\Pest\Laravel\PestServiceProvider::class)) {
            $command = $this->option('parallel') ? ['vendor/pestphp/pest/bin/pest', '--parallel'] : ['vendor/pestphp/pest/bin/pest'];
        } else {
            $command = $this->option('parallel') ? ['vendor/brianium/paratest/bin/paratest'] : ['vendor/phpunit/phpunit/phpunit'];
        }

        if ('phpdbg' === PHP_SAPI) {
            return array_merge([PHP_BINARY, '-qrr'], $command);
        }

        return array_merge([PHP_BINARY], $command);
=======
        $command = class_exists(\Pest\Laravel\PestServiceProvider::class)
            ? 'vendor/pestphp/pest/bin/pest'
            : 'vendor/phpunit/phpunit/phpunit';

        if ('phpdbg' === PHP_SAPI) {
            return [PHP_BINARY, '-qrr', $command];
        }

        return [PHP_BINARY, $command];
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    }

    /**
     * Get the array of arguments for running PHPUnit.
     *
     * @param array $options
     *
     * @return array
     */
    protected function phpunitArguments($options)
    {
<<<<<<< HEAD
        $options = array_merge(['--printer=NunoMaduro\\Collision\\Adapters\\Phpunit\\Printer'], $options);

        $options = array_values(array_filter($options, function ($option) {
            return !Str::startsWith($option, '--env=');
        }));

        if (!file_exists($file = base_path('phpunit.xml'))) {
            $file = base_path('phpunit.xml.dist');
        }

        return array_merge(["--configuration=$file"], $options);
    }

    /**
     * Get the array of arguments for running Paratest.
     *
     * @param array $options
     *
     * @return array
     */
    protected function paratestArguments($options)
    {
        $options = array_values(array_filter($options, function ($option) {
            return !Str::startsWith($option, '--env=')
                && !Str::startsWith($option, '-p')
                && !Str::startsWith($option, '--parallel')
                && !Str::startsWith($option, '--recreate-databases');
=======
        $options = array_values(array_filter($options, function ($option) {
            return !Str::startsWith($option, '--env=');
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
        }));

        if (!file_exists($file = base_path('phpunit.xml'))) {
            $file = base_path('phpunit.xml.dist');
        }

<<<<<<< HEAD
        return array_merge([
            "--configuration=$file",
            "--runner=\Illuminate\Testing\ParallelRunner",
        ], $options);
    }

    /**
     * Get the array of environment variables for running PHPUnit.
     *
     * @return array
     */
    protected function phpunitEnvironmentVariables()
    {
        return [];
    }

    /**
     * Get the array of environment variables for running Paratest.
     *
     * @return array
     */
    protected function paratestEnvironmentVariables()
    {
        return [
            'LARAVEL_PARALLEL_TESTING'                    => 1,
            'LARAVEL_PARALLEL_TESTING_RECREATE_DATABASES' => $this->option('recreate-databases'),
        ];
=======
        return array_merge(['-c', $file], $options);
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    }

    /**
     * Clears any set Environment variables set by Laravel if the --env option is empty.
     *
     * @return void
     */
    protected function clearEnv()
    {
        if (!$this->option('env')) {
            $vars = self::getEnvironmentVariables(
                // @phpstan-ignore-next-line
                $this->laravel->environmentPath(),
                // @phpstan-ignore-next-line
                $this->laravel->environmentFile()
            );

            $repository = Env::getRepository();

            foreach ($vars as $name) {
                $repository->clear($name);
            }
        }
    }

    /**
     * @param string $path
     * @param string $file
     *
     * @return array
     */
    protected static function getEnvironmentVariables($path, $file)
    {
        try {
            $content = StoreBuilder::createWithNoNames()
                ->addPath($path)
                ->addName($file)
                ->make()
                ->read();
        } catch (InvalidPathException $e) {
            return [];
        }

        $vars = [];

        foreach ((new Parser())->parse($content) as $entry) {
            $vars[] = $entry->getName();
        }

        return $vars;
    }
}
