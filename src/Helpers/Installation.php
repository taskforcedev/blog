<?php namespace Taskforcedev\Blog\Helpers;

use \Schema;
use Illuminate\Database\Schema\Blueprint;
use Taskforcedev\Blog\Models\Status;

class Installation
{
    public static function checkOrRunMigrations()
    {
        if (!self::hasMigrated()) {
            self::migrate();
        }

        if (!self::hasSeeded()) {
            self::seed();
        }

        return (self::hasMigrated() && self::hasSeeded());
    }

    public static function hasMigrated()
    {
        $tables = [ 'posts', 'post_status' ];
        foreach ($tables as $table) {
            if (!Schema::hasTable($table)) {
                return false;
            }
        }
        return true;
    }

    private static function migrate()
    {
        self::createPostStatusesTable();
        self::createPostsTable();
    }

    private static function createPostsTable()
    {
        $table = 'posts';
        if (!Schema::hasTable($table)) {
            Schema::create($table, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('author_id')->unsigned();
                $table->foreign('author_id')->references('id')->on('users');
                $table->string('title', 100);
                $table->longText('body');
                $table->integer('status_id')->unsigned();
                $table->foreign('status_id')->references('id')->on('post_status');
                $table->string('image', 255);
            });
        }

        return true;
    }

    private static function createPostStatusesTable()
    {
        $table = 'post_status';
        if (!Schema::hasTable($table)) {
            Schema::create($table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
            });
        }

        return true;
    }

    private static function hasSeeded()
    {
        $statuses = [ 'draft', 'published', 'hidden' ];
        foreach ($statuses as $status) {
            if (!Status::exists($status)) {
                return false;
            }
        }
        return true;
    }

    private static function seed()
    {
        $statuses = [ 'draft', 'published', 'hidden' ];
        foreach ($statuses as $status) {
            if (!Status::exists($status)) {
                Status::create(['name' => $status]);
            }
        }
        return true;
    }
}
