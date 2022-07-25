<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


abstract class  QueryFilters
{

    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * query string params delimiter for parse
     *
     * @var string
     */
    protected string $delimiter = ',';

    protected string $betweenDelimiter = '-';


    /**
     * QueryFilter constructor.
     * @param Request $request
     */
    public function __construct(private readonly Request $request)
    {
    }


    /**
     * @param string $param
     * @return array
     */
    protected function paramToArray(string $param): array
    {
        return explode($this->delimiter, $param);
    }

    /**
     * @param string $param
     * @return array
     */
    protected function paramBetweenToArray(string $param): array
    {
        return explode($this->betweenDelimiter, $param);
    }

    /**
     * @return array
     */
    protected function fields(): array
    {
        return array_filter(
            array_map('trim', $this->request->all())
        );
    }


    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {

            $method = Str::camel($field);

            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], (array)$value);
            }

        }
        return $this->builder;
    }
}
