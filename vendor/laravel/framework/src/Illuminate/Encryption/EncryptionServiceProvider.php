<?php

namespace Illuminate\Encryption;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
<<<<<<< HEAD
use Laravel\SerializableClosure\SerializableClosure;
use Opis\Closure\SerializableClosure as OpisSerializableClosure;
=======
use Opis\Closure\SerializableClosure;
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f

class EncryptionServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerEncrypter();
        $this->registerOpisSecurityKey();
<<<<<<< HEAD
        $this->registerSerializableClosureSecurityKey();
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    }

    /**
     * Register the encrypter.
     *
     * @return void
     */
    protected function registerEncrypter()
    {
        $this->app->singleton('encrypter', function ($app) {
            $config = $app->make('config')->get('app');

            return new Encrypter($this->parseKey($config), $config['cipher']);
        });
    }

    /**
     * Configure Opis Closure signing for security.
<<<<<<< HEAD
     *
     * @return void
     *
     * @deprecated Will be removed in a future Laravel version.
     */
    protected function registerOpisSecurityKey()
    {
        if (\PHP_VERSION_ID < 80100) {
            $config = $this->app->make('config')->get('app');

            if (! class_exists(OpisSerializableClosure::class) || empty($config['key'])) {
                return;
            }

            OpisSerializableClosure::setSecretKey($this->parseKey($config));
        }
    }

    /**
     * Configure Serializable Closure signing for security.
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     *
     * @return void
     */
    protected function registerOpisSecurityKey()
    {
        $config = $this->app->make('config')->get('app');

        if (! class_exists(SerializableClosure::class) || empty($config['key'])) {
            return;
        }

        SerializableClosure::setSecretKey($this->parseKey($config));
    }

    /**
     * Parse the encryption key.
     *
     * @param  array  $config
     * @return string
     */
    protected function parseKey(array $config)
    {
        if (Str::startsWith($key = $this->key($config), $prefix = 'base64:')) {
            $key = base64_decode(Str::after($key, $prefix));
        }

        return $key;
    }

    /**
     * Extract the encryption key from the given configuration.
     *
     * @param  array  $config
     * @return string
     *
     * @throws \RuntimeException
     */
    protected function key(array $config)
    {
        return tap($config['key'], function ($key) {
            if (empty($key)) {
                throw new MissingAppKeyException;
            }
        });
    }
}
