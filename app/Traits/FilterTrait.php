<?php
namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait FilterTrait
{
    /**
     * Filter the result follow the filter request.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query  of Model.
     * @param array                                 $fields fields
     *
     * @return void.
     */
    public function scopeFilter($query, $fields)
    {
        if (isset($fields)) {
            foreach ($fields as $field => $value) {
                $columnsFilter = $this->getColummnsFilter($field);
                if ($columnsFilter !=null) {
                    foreach ($columnsFilter as $key => $operator) {
                        $this->addCondition($query, $key, $operator, $value);
                    }
                }
            }
        }
    }
    /**
     * Add query condition
     *
     * @param \Illuminate\Database\Eloquent\Builder $query    of Model.
     * @param string                                $column   filter field
     * @param string                                $operator operator
     * @param string                                $value    keyword
     *
     * @return void.
     */
    private function addCondition($query, $column, $operator, $value)
    {
        switch ($operator) {
            case 'like':
                $query->where($column, 'like', '%' . $value . '%');
                break;
            case 'between':
                $query->whereBetween($column, explode(',', $value));
                break;
            case 'not_null':
                $query->whereNotNull($column);
                break;
            case 'null':
                $query->whereNull($column);
                break;
            case 'in':
                $query->whereIn($column, explode(',', $value));
                break;
            case 'notIn':
                $query->whereNotIn($column, explode(',', $value));
                break;
            default:
                $query->where($column, $operator, $value);
                break;
        }
    }
    /**
     * Get columns fieldSearchable
     *
     * @param array $field field
     *
     * @return mixed
     */
    protected function getColummnsFilter($field)
    {
        return array_get($this->fieldSearchable, $field);
    }
}
