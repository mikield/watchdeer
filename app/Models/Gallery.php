<?php
namespace App\Models;

use App\Services\Model;

class Gallery extends Model {

    public  $images = [];
     public $id,
            $title,
            $url;
    protected static $with = ['images'];
    protected static $table = 'galleries';


    /**
     * Relationship
     */
    public function images() {
        $rows = static::$connection->select('images', ['id', 'name'], ["gallery_id[=]" => $this->id]);
        foreach ($rows as $row) {
            $images[] = new Image($row);
        }
        return $images;
    }

    public function sort(\Closure $callable) {
        call_user_func_array($callable, [$this->images]);
    }
}