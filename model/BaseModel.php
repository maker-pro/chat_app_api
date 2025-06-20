<?php
/**
 * BaseModel.php
 * User: Joe
 * Date: 2023/3/22
 * Time: 14:59
 */

namespace model;

use \common\DB;
use \common\Result;
use libs\Conf;

class BaseModel
{
    protected $table = null;
    protected $mysql_object = null;
    protected $where_array = [];
    protected $group_by_field = null;
    protected $order_by = [];
    protected $offset = null;
    protected $limit = null;

    protected $redis_object = null;

    protected $redis_keys = [];

    public function __construct()
    {
        $this->mysql_object = DB::getMysqlInstance();
        $this->redis_object = DB::getRedisInstance();
        $this->redis_keys = Conf::get('redis_config');
        if (empty($this->table)) {
            Result::toJson([], Result::NOT_FOUND_TABLE, Result::NOT_FOUND_TABLE_MSG);
        }
    }

    protected function getRows($fields, $index_field = '')
    {
        $sql = 'select ';
        if ($fields == '*') {
            $sql .= '* ';
        } else if (is_array($fields)) {
            $sql .= '`' . implode('`, `', $fields) . '` ';;
        } else {
            $sql .= '`' . $fields . '` ';
        }
        $sql .= 'from `' . $this->table . '` ';

        if ($this->where_array) {
            $sql .= 'where ' . implode(' and ', $this->where_array) . ' ';
        }
        if ($this->order_by) {
            $order_by_arr = [];
            foreach ($this->order_by as $field => $order_by_type) {
                $order_by_arr[] = $field . ' ' . $order_by_type;
            }
            $sql .= 'order by ' . implode(', ', $order_by_arr) . ' ';
        }
        if (!is_null($this->limit)) {
            $limit_string = 'limit ';
            if (!is_null($this->offset)) {
                $limit_string .= $this->offset . ', ';
            }
            $limit_string .= $this->limit;
            $sql .= $limit_string . ' ';
        }
        if (!is_null($this->group_by_field)) {
            $sql .= 'group by ' . $this->group_by_field;
        }

        if ($index_field) {
            $result = $this->mysql_object->getRows($sql, $index_field);
        } else {
            $result = $this->mysql_object->getRows($sql);
        }
        return $result;
    }

    protected function where($field, $operator = '=', $conditions = '')
    {
        if ($field && $operator) {
            if (is_array($conditions)) {
                $condition_string = '("' . implode('", "', array_map('addslashes', $conditions)) . '")';
            } else {
                $condition_string = '"' . addslashes($conditions) . '"';
            }
            $where_string = '`' . $field . '` ' . $operator . $condition_string;
            array_push($this->where_array, $where_string);
        }
        return $this;
    }

    protected function orderBy($order_by = []) {
        $this->order_by = $order_by;
        return $this;
    }

    protected function groupBy($group_by_field = '') {
        $this->group_by_field = $group_by_field;
        return $this;
    }

    protected function limit($limit = 10, $offset = null) {
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }
}
