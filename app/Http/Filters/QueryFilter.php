<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


abstract class  QueryFilter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * query string params delimiter for parse
     *
     * @var string
     */
    protected $delimiter = ',';


    /**
     * QueryFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $delimiter
     */
    private function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
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
        $this->setDelimiter('-');
        return explode($this->delimiter, $param);
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
    public function apply(Builder $builder)
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