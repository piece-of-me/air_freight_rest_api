<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter implements FilterInterface
{
    public function __construct(private readonly array $queryParams)
    {
    }

    public function apply(Builder $builder): void
    {
        $this->before($builder);

        foreach ($this->getCallbacks() as $name => $callback) {
            if (isset($this->queryParams[$name])) {
                call_user_func($callback, $builder, $this->queryParams[$name]);
            }
        }

        $this->after($builder);
    }

    protected function before(Builder $builder): void
    {
    }

    protected function after(Builder $builder): void
    {
    }

    abstract protected function getCallbacks(): array;
}
