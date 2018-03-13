<?php

namespace App;

/**
 * Base model implement Create, Read from CRUD
 */
abstract class Model
{
    const TABLE = '';
    public $id;

    /**
     * Select all data about model from DB
     * @return mixed
     */
    public static function findAll()
    {
        $db = DB::instance();
        return $db->query('SELECT * FROM ' . static::TABLE, static::class);
    }

    /**
     * Check if model is new
     * @return bool
     */
    public function isNew()
    {
        return empty($this->id);
    }

    /**
     * Initiate inserting for new model
     */
    public function save()
    {
        if ($this->isNew()) {
            $this->insert();
        }
    }

    /**
     * Insert data from model to DB
     * @return mixed
     */
    public function insert()
    {
        if (!$this->isNew()) {
            return;
        }

        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }

            $columns[] = $k;
            $values[':' . $k] = $v;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' (' .
          implode(',', $columns) . ') VALUES (' .
          implode(',', array_keys($values)) . ')';
        $db = DB::instance();
        $db->execute($sql, $values);
    }
}