<?php namespace Taskforcedev\Blog\Models;

use \Exception;
use \Validator;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'post_status';

    protected $fillable = [ 'name' ];

    public $timestamps = false;


    public static function exists($status)
    {
        try {
            $status = Status::where('name', $status)->firstOrFail();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getStatusByName($status)
    {
        try {
            $status = Status::where('name', $status)->firstOrFail();
            return $status;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getStatusById($id)
    {
        try {
            $status = Status::where('id', $id)->firstOrFail();
            return $status;
        } catch (Exception $e) {
            return null;
        }
    }
}
