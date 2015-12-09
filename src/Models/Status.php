<?php namespace Taskforcedev\Blog\Models;

use \Exception;
use \Validator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package Taskforcedev\Blog\Models
 */
class Status extends Model
{
    protected $table = 'post_status';

    protected $fillable = [ 'name' ];

    public $timestamps = false;

    /**
     * Check if a given status (name) exists.
     * @param $status
     * @return bool
     */
    public static function exists($status)
    {
        try {
            $status = Status::where('name', $status)->firstOrFail();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get a status by name.
     * @param $status
     * @return null
     */
    public static function getStatusByName($status)
    {
        try {
            $status = Status::where('name', $status)->firstOrFail();
            return $status;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Get a status by id.
     * @param $id
     * @return null
     */
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
