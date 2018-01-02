<?php namespace App\Services;

use Illuminate\Support\Collection;

abstract class Model {

    protected static $connection;
    protected static $table;
    protected static $with;

    public function __construct(array $data = []) {
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
        if(isset(static::$with) && !empty(static::$with)){
            foreach (static::$with as $with){
                $this->$with = $this->load($with);
            }
        }
    }

    public static function configure($connection){
        static::$connection = $connection;
    }

    public function load($relation) {
        if(method_exists($this,$relation)){
            $data = call_user_func([$this, $relation]);
            return $data;
        }
    }


    public function fill(array $data) {
        foreach ($data as $key => $value){
            $this->$key = $value;
        }
        return $this;
    }

    public static function all() {
        $rows = static::$connection->select(static::$table, ["id", "url", "title"]);
        foreach ($rows as $row){
            $galleries[] = new static($row);
        }
        return collect($galleries);
    }

    public static function find($id) {
        $query = static::$connection->select(static::$table, ["id", "url", "title"], ["id[=]" => $id], ['LIMIT' => 1]);
        if(isset($query[0]) && !empty($query[0])){
            return new static($query[0]);
        }
    }
}