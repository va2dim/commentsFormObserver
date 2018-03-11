<?php

namespace App;


abstract class Model
{
    const TABLE = '';
    public $id;

    public static function findAll()
    {
        $db = DB::instance();
        return $db->query('SELECT * FROM ' . static::TABLE, static::class);
    }

    /**
     * @param int $id
     * @return bool || Object содержащий рез-т выборки
     */
    public static function findById($id = 1)
    {
        $db = DB::instance();
        $res = $db->query('SELECT * FROM ' . static::TABLE . ' WHERE id=:id',
          static::class,
          [':id' => $id])[0]; // +[0] превращает массив из одного obj в obj;
        //$res1 = $db->query('SELECT * FROM '.static::TABLE.' WHERE id=:id', static::class, [':id' => $id]); var_dump($res1);
        //var_dump($res);


        if (!empty($res)) {
            return $res;
        } else {
            return false;
        }
    }

    public function isNew()
    {
        return empty($this->id);
    }

    /**
     * TODO delete()
     */
    public function delete()
    {
        $id = $this->id;
        //$sql = ('DELETE FROM '.static::TABLE.' WHERE id=:id', static::class, [':id' => $id])[0];
        //echo $sql;

        $db = DB::instance();
        $res = $db->query('DELETE FROM ' . static::TABLE . ' WHERE id=:id',
          static::class, [':id' => $id])[0];
        var_dump($res);
    }

    public function save()
    {
        if ($this->isNew()) {
            $this->insert();
        } else {
            $this->update();
        }
    }

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

            //echo $values.'[:'.$k.'] = '.$v.'<br>';
            $columns[] = $k;
            $values[':' . $k] = $v;
        }
        echo '<br>INSERT: ';
        var_dump($this);


        $sql = 'INSERT INTO ' . static::TABLE . ' (' .
          implode(',', $columns) . ') VALUES (' .
          implode(',', array_keys($values)) . ')';
        echo 'insertSQL: ' . $sql;
        $db = DB::instance();
        $db->execute($sql, $values);
    }


    public function update()
    {
        if ($this->isNew()) {
            return;
        }

        /*
        echo 'ObjValue';
        var_dump(key($this));
        var_dump($this[key($this)]);
        foreach($this as $k){

            echo 'ObjValue kk '.$k.': '."|<br>";
        }
*/

        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k || !isSet($v)) {
                continue;
            }
            echo 'ObjValue ' . $k . ': ' . $v . "|<br>";
            $columns[] = $k;
            $values[':' . $k] = $v;

        }
        //var_dump($columns); echo "<br>"; var_dump($values); echo "<hr>";

        $sql = 'UPDATE ' . static::TABLE . ' SET ';
        $i = 0;
        foreach ($values as $k => $v) {
            //$sql .= $k.' = '.$v;
            $sql .= $columns[$i] . ' = ' . $k;
            $i++;
            if (count($values) != $i) {
                $sql .= ', ';
            }
            //echo count($values) .' != '. $i;
        }
        $sql .= ' WHERE id = ' . $this->id;

        //var_dump($sql);

        $db = DB::instance();
        $db->execute($sql, $values);
    }
}