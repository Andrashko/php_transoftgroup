<?php

namespace Core;

use Core\Util;

/**
 * Class Model
 */
class Model implements DbModelInterface
{
    /**
     * @var
     */
    protected $table_name;
    /**
     * @var
     */
    protected $id_column;
    /**
     * @var array
     */
    protected $columns = [];
    /**
     * @var
     */
    protected $collection;
    /**
     * @var
     */
    protected $sql;
    /**
     * @var array
     */
    protected $params = [];
    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @return $this
     */
    public function initCollection()
    {
        $columns = implode(',', $this->getColumns());
        $this->sql = "select $columns from " . $this->table_name;
        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        $db = new DB();
        $sql = "show columns from  $this->table_name;";
        $results = $db->query($sql);
        foreach ($results as $result) {
            array_push($this->columns, $result['Field']);
        }
        return $this->columns;
    }


    /**
     * @param $params
     * @return $this
     */
    public function sort($params)
    {
        if (count($params) > 0) {
            $this->sql .= sprintf(
                " order by %s",
                Util::keyValueToList($params, "%s %s")
            );
        }
        return $this;
    }

    /**
     * @param $params
     */
    public function filter($params, $sign = "=")
    {
        if (count($params) > 0) {
            if (strrpos($this->sql , "where")){
                $template = " and %s ";
            } else {
                $template = " where %s";
            }
            $this->sql .= sprintf(
                $template,
                Util::keyValueToList(Util::quoteStringValues($params), "%s$sign%s", " and ")
            );
        }
        return $this;
    }


    /**
     * @return $this
     */
    public function getCollection()
    {
        $db = new DB();
        $this->sql .= ";";
        $this->collection = $db->query($this->sql, $this->params);
        return $this;
    }

    /**
     * @return mixed
     */
    public function select()
    {
        return $this->collection;
    }

    /**
     * @return null
     */
    public function selectFirst()
    {
        return isset($this->collection[0]) ? $this->collection[0] : null;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getItem($id)
    {
        $sql = "select * from $this->table_name where $this->id_column = ?;";
        $db = new DB();
        $params = array($id);
        return $db->query($sql, $params)[0];
    }

    /**
     * @return array
     */
    public function getPostValues()
    {
        $values = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            $column_value = filter_input(INPUT_POST, $column);
            if ($column_value && $column !== $this->id_column) {
                $values[$column] = $column_value;
            }
        }
        return $values;
    }


    /**
     * @return array
     */
    public function getFiltredValues()
    {
        $values = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            $column_value = filter_input(INPUT_POST, $column, $this->filterOrDefault($column), $this->optionsOrDefault(($column)));
            if ($column_value && $column !== $this->id_column) {
                $values[$column] = $column_value;
            }
        }
        return $values;
    }

    protected function filterOrDefault($field)
    {
        if ($this->filters[$field]) {
            if (gettype($this->filters[$field]) == "array") {
                return $this->filters[$field]["filter"];
            }
            return $this->filters[$field];
        }
        return FILTER_DEFAULT;
    }

    protected function optionsOrDefault($field)
    {
        if ($this->filters[$field] && gettype($this->filters[$field]) == "array") {
            return $this->filters[$field]["options"];
        }
        return 0;
    }

    /**
     * 
     */

    public function getTableName(): string
    {
        return $this->table_name;
    }

    public function getPrimaryKeyName(): string
    {
        return $this->id_column;
    }


    /**
     * ERROR
     */
    public function getId(): int
    {
        return 1;
    }


    public function addItem($values)
    {
        $db = new DB();
        $id = $db->createEntity($this, $values);
        if ($id) {
            return $this->getItem($id);
        }
        return null;
    }

    public function deleteItem($id)
    {
        $db = new DB();
        $db->deleteEntity($this, $id);
    }

    public function saveItem($id, $values)
    {
        $db = new DB();
        return  $db->updateEntity($this, $id, $values);
    }

    public function maxValue($field)
    {
        $sql = "select $field from $this->table_name order by $field desc limit 1;";
        $db = new DB();
        return $db->query($sql)[0][$field];
    }
}
