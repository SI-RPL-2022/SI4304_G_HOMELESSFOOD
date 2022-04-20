<?php

namespace Illuminate\View\Compilers\Concerns;

trait CompilesEchos
{
    /**
     * Compile Blade echos into valid PHP.
     *
     * @param  string  $value
     * @return string
     */
    public function compileEchos($value)
    {
        foreach ($this->getEchoMethods() as $method) {
            $value = $this->$method($value);
        }

        return $value;
    }

    /**
     * Get the echo methods in the proper order for compilation.
     *
     * @return array
     */
    protected function getEchoMethods()
    {
        return [
            'compileRawEchos',
            'compileEscapedEchos',
            'compileRegularEchos',
        ];
    }

    /**
     * Compile the "raw" echo statements.
     *
     * @param  string  $value
     * @return string
     */
    protected function compileRawEchos($value)
    {
        $pattern = sprintf('/(@)?%s\s*(.+?)\s*%s(\r?\n)?/s', $this->rawTags[0], $this->rawTags[1]);

        $callback = function ($matches) {
            $whitespace = empty($matches[3]) ? '' : $matches[3].$matches[3];

            return $matches[1] ? substr($matches[0], 1) : "<?php echo {$matches[2]}; ?>{$whitespace}";
        };

        return preg_replace_callback($pattern, $callback, $value);
    }

    /**
     * Compile the "regular" echo statements.
     *
     * @param  string  $value
     * @return string
     */
    protected function compileRegularEchos($value)
    {
        $pattern = sprintf('/(@)?%s\s*(.+?)\s*%s(\r?\n)?/s', $this->contentTags[0], $this->contentTags[1]);

        $callback = function ($matches) {
            $whitespace = empty($matches[3]) ? '' : $matches[3].$matches[3];

            $wrapped = sprintf($this->echoFormat, $matches[2]);

            return $matches[1] ? substr($matches[0], 1) : "<?php echo {$wrapped}; ?>{$whitespace}";
        };

        return preg_replace_callback($pattern, $callback, $value);
    }

    /**
     * Compile the escaped echo statements.
     *
     * @param  string  $value
     * @return string
     */
    protected function compileEscapedEchos($value)
    {
        $pattern = sprintf('/(@)?%s\s*(.+?)\s*%s(\r?\n)?/s', $this->escapedTags[0], $this->escapedTags[1]);

        $callback = function ($matches) {
            $whitespace = empty($matches[3]) ? '' : $matches[3].$matches[3];

            return $matches[1] ? $matches[0] : "<?php echo e({$matches[2]}); ?>{$whitespace}";
        };

        return preg_replace_callback($pattern, $callback, $value);
    }
<<<<<<< HEAD

    /**
     * Add an instance of the blade echo handler to the start of the compiled string.
     *
     * @param  string  $result
     * @return string
     */
    protected function addBladeCompilerVariable($result)
    {
        return "<?php \$__bladeCompiler = app('blade.compiler'); ?>".$result;
    }

    /**
     * Wrap the echoable value in an echo handler if applicable.
     *
     * @param  string  $value
     * @return string
     */
    protected function wrapInEchoHandler($value)
    {
        $value = Str::of($value)
            ->trim()
            ->when(Str::endsWith($value, ';'), function ($str) {
                return $str->beforeLast(';');
            });

        return empty($this->echoHandlers) ? $value : '$__bladeCompiler->applyEchoHandler('.$value.')';
    }

    /**
     * Apply the echo handler for the value if it exists.
     *
     * @param  string  $value
     * @return string
     */
    public function applyEchoHandler($value)
    {
        if (is_object($value) && isset($this->echoHandlers[get_class($value)])) {
            return call_user_func($this->echoHandlers[get_class($value)], $value);
        }

        return $value;
    }
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
}
