<?php namespace Taskforcedev\Blog\Models;

use \Exception;
use \Validator;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';

    protected $fillable = [ 'name' ];

    public static function getStatusByName($status)
    {
        try {
            $status = Status::where('name', $status);
            return $status;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getStatusById($id)
    {
        try {
            $status = Status::where('id', $id);
            return $status;
        } catch (Exception $e) {
            return null;
        }
    }
}
