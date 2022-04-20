<?php

namespace Illuminate\Database\Concerns;

use Illuminate\Container\Container;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\MultipleRecordsFoundException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Pagination\Cursor;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Traits\Conditionable;
use InvalidArgumentException;
use RuntimeException;
=======
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f

trait BuildsQueries
{
    /**
     * Chunk the results of the query.
     *
     * @param  int  $count
     * @param  callable  $callback
     * @return bool
     */
    public function chunk($count, callable $callback)
    {
        $this->enforceOrderBy();

        $page = 1;

        do {
            // We'll execute the query for the given page and get the results. If there are
            // no results we can just break and return from here. When there are results
            // we will call the callback with the current chunk of these results here.
            $results = $this->forPage($page, $count)->get();

            $countResults = $results->count();

            if ($countResults == 0) {
                break;
            }

            // On each chunk result set, we will pass them to the callback and then let the
            // developer take care of everything within the callback, which allows us to
            // keep the memory low for spinning through large result sets for working.
            if ($callback($results, $page) === false) {
                return false;
            }

            unset($results);

            $page++;
        } while ($countResults == $count);

        return true;
    }

    /**
     * Execute a callback over each item while chunking.
     *
     * @param  callable  $callback
     * @param  int  $count
     * @return bool
     */
    public function each(callable $callback, $count = 1000)
    {
        return $this->chunk($count, function ($results) use ($callback) {
            foreach ($results as $key => $value) {
                if ($callback($value, $key) === false) {
                    return false;
                }
            }
        });
    }

    /**
     * Chunk the results of a query by comparing IDs.
     *
     * @param  int  $count
     * @param  callable  $callback
     * @param  string|null  $column
     * @param  string|null  $alias
     * @return bool
     */
    public function chunkById($count, callable $callback, $column = null, $alias = null)
    {
        $column = $column ?? $this->defaultKeyName();

        $alias = $alias ?? $column;

        $lastId = null;

        $page = 1;

        do {
            $clone = clone $this;

            // We'll execute the query for the given page and get the results. If there are
            // no results we can just break and return from here. When there are results
            // we will call the callback with the current chunk of these results here.
            $results = $clone->forPageAfterId($count, $lastId, $column)->get();

            $countResults = $results->count();

            if ($countResults == 0) {
                break;
            }

            // On each chunk result set, we will pass them to the callback and then let the
            // developer take care of everything within the callback, which allows us to
            // keep the memory low for spinning through large result sets for working.
            if ($callback($results, $page) === false) {
                return false;
            }

            $lastId = $results->last()->{$alias};

            unset($results);

            $page++;
        } while ($countResults == $count);

        return true;
    }

    /**
     * Execute a callback over each item while chunking by ID.
     *
     * @param  callable  $callback
     * @param  int  $count
     * @param  string|null  $column
     * @param  string|null  $alias
     * @return bool
     */
    public function eachById(callable $callback, $count = 1000, $column = null, $alias = null)
    {
        return $this->chunkById($count, function ($results, $page) use ($callback, $count) {
            foreach ($results as $key => $value) {
                if ($callback($value, (($page - 1) * $count) + $key) === false) {
                    return false;
                }
            }
        }, $column, $alias);
    }

    /**
<<<<<<< HEAD
     * Query lazily, by chunks of the given size.
     *
     * @param  int  $chunkSize
     * @return \Illuminate\Support\LazyCollection
     *
     * @throws \InvalidArgumentException
     */
    public function lazy($chunkSize = 1000)
    {
        if ($chunkSize < 1) {
            throw new InvalidArgumentException('The chunk size should be at least 1');
        }

        $this->enforceOrderBy();

        return LazyCollection::make(function () use ($chunkSize) {
            $page = 1;

            while (true) {
                $results = $this->forPage($page++, $chunkSize)->get();

                foreach ($results as $result) {
                    yield $result;
                }

                if ($results->count() < $chunkSize) {
                    return;
                }
            }
        });
    }

    /**
     * Query lazily, by chunking the results of a query by comparing IDs.
     *
     * @param  int  $chunkSize
     * @param  string|null  $column
     * @param  string|null  $alias
     * @return \Illuminate\Support\LazyCollection
     *
     * @throws \InvalidArgumentException
     */
    public function lazyById($chunkSize = 1000, $column = null, $alias = null)
    {
        return $this->orderedLazyById($chunkSize, $column, $alias);
    }

    /**
     * Query lazily, by chunking the results of a query by comparing IDs in descending order.
     *
     * @param  int  $chunkSize
     * @param  string|null  $column
     * @param  string|null  $alias
     * @return \Illuminate\Support\LazyCollection
     *
     * @throws \InvalidArgumentException
     */
    public function lazyByIdDesc($chunkSize = 1000, $column = null, $alias = null)
    {
        return $this->orderedLazyById($chunkSize, $column, $alias, true);
    }

    /**
     * Query lazily, by chunking the results of a query by comparing IDs in a given order.
     *
     * @param  int  $chunkSize
     * @param  string|null  $column
     * @param  string|null  $alias
     * @param  bool  $descending
     * @return \Illuminate\Support\LazyCollection
     *
     * @throws \InvalidArgumentException
     */
    protected function orderedLazyById($chunkSize = 1000, $column = null, $alias = null, $descending = false)
    {
        if ($chunkSize < 1) {
            throw new InvalidArgumentException('The chunk size should be at least 1');
        }

        $column = $column ?? $this->defaultKeyName();

        $alias = $alias ?? $column;

        return LazyCollection::make(function () use ($chunkSize, $column, $alias, $descending) {
            $lastId = null;

            while (true) {
                $clone = clone $this;

                if ($descending) {
                    $results = $clone->forPageBeforeId($chunkSize, $lastId, $column)->get();
                } else {
                    $results = $clone->forPageAfterId($chunkSize, $lastId, $column)->get();
                }

                foreach ($results as $result) {
                    yield $result;
                }

                if ($results->count() < $chunkSize) {
                    return;
                }

                $lastId = $results->last()->{$alias};
            }
        });
    }

    /**
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     * Execute the query and get the first result.
     *
     * @param  array|string  $columns
     * @return \Illuminate\Database\Eloquent\Model|object|static|null
     */
    public function first($columns = ['*'])
    {
        return $this->take(1)->get($columns)->first();
    }

    /**
     * Apply the callback's query changes if the given "value" is true.
     *
     * @param  mixed  $value
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return mixed|$this
     */
    public function when($value, $callback, $default = null)
    {
<<<<<<< HEAD
        $result = $this->take(2)->get($columns);

        if ($result->isEmpty()) {
            throw new RecordsNotFoundException;
        }

        if ($result->count() > 1) {
            throw new MultipleRecordsFoundException;
=======
        if ($value) {
            return $callback($this, $value) ?: $this;
        } elseif ($default) {
            return $default($this, $value) ?: $this;
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
        }

        return $this;
    }

    /**
     * Pass the query to a given callback.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function tap($callback)
    {
<<<<<<< HEAD
        if (! $cursor instanceof Cursor) {
            $cursor = is_string($cursor)
                ? Cursor::fromEncoded($cursor)
                : CursorPaginator::resolveCurrentCursor($cursorName, $cursor);
        }

        $orders = $this->ensureOrderForCursorPagination(! is_null($cursor) && $cursor->pointsToPreviousItems());

        if (! is_null($cursor)) {
            $addCursorConditions = function (self $builder, $previousColumn, $i) use (&$addCursorConditions, $cursor, $orders) {
                if (! is_null($previousColumn)) {
                    $builder->where(
                        $this->getOriginalColumnNameForCursorPagination($this, $previousColumn),
                        '=',
                        $cursor->parameter($previousColumn)
                    );
                }

                $builder->where(function (self $builder) use ($addCursorConditions, $cursor, $orders, $i) {
                    ['column' => $column, 'direction' => $direction] = $orders[$i];

                    $builder->where(
                        $this->getOriginalColumnNameForCursorPagination($this, $column),
                        $direction === 'asc' ? '>' : '<',
                        $cursor->parameter($column)
                    );

                    if ($i < $orders->count() - 1) {
                        $builder->orWhere(function (self $builder) use ($addCursorConditions, $column, $i) {
                            $addCursorConditions($builder, $column, $i + 1);
                        });
                    }
                });
            };

            $addCursorConditions($this, null, 0);
        }

        $this->limit($perPage + 1);

        return $this->cursorPaginator($this->get($columns), $perPage, $cursor, [
            'path' => Paginator::resolveCurrentPath(),
            'cursorName' => $cursorName,
            'parameters' => $orders->pluck('column')->toArray(),
        ]);
=======
        return $this->when(true, $callback);
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    }

    /**
     * Apply the callback's query changes if the given "value" is false.
     *
     * @param  mixed  $value
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return mixed|$this
     */
    public function unless($value, $callback, $default = null)
    {
<<<<<<< HEAD
        $columns = $builder instanceof Builder ? $builder->getQuery()->columns : $builder->columns;

        if (! is_null($columns)) {
            foreach ($columns as $column) {
                if (($position = stripos($column, ' as ')) !== false) {
                    $as = substr($column, $position, 4);

                    [$original, $alias] = explode($as, $column);

                    if ($parameter === $alias) {
                        return $original;
                    }
                }
            }
=======
        if (! $value) {
            return $callback($this, $value) ?: $this;
        } elseif ($default) {
            return $default($this, $value) ?: $this;
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
        }

        return $this;
    }

    /**
     * Create a new length-aware paginator instance.
     *
     * @param  \Illuminate\Support\Collection  $items
     * @param  int  $total
     * @param  int  $perPage
     * @param  int  $currentPage
     * @param  array  $options
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }

    /**
     * Create a new simple paginator instance.
     *
     * @param  \Illuminate\Support\Collection  $items
     * @param  int  $perPage
     * @param  int  $currentPage
     * @param  array  $options
     * @return \Illuminate\Pagination\Paginator
     */
    protected function simplePaginator($items, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(Paginator::class, compact(
            'items', 'perPage', 'currentPage', 'options'
        ));
    }
<<<<<<< HEAD

    /**
     * Create a new cursor paginator instance.
     *
     * @param  \Illuminate\Support\Collection  $items
     * @param  int  $perPage
     * @param  \Illuminate\Pagination\Cursor  $cursor
     * @param  array  $options
     * @return \Illuminate\Pagination\CursorPaginator
     */
    protected function cursorPaginator($items, $perPage, $cursor, $options)
    {
        return Container::getInstance()->makeWith(CursorPaginator::class, compact(
            'items', 'perPage', 'cursor', 'options'
        ));
    }

    /**
     * Pass the query to a given callback.
     *
     * @param  callable  $callback
     * @return $this|mixed
     */
    public function tap($callback)
    {
        return $this->when(true, $callback);
    }
=======
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
}
