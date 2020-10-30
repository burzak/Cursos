<?php

namespace Cursos\DB;

final class FileStorage implements StorageInterface {

    private $db = array();
    private $path;

    public function __construct(string $dbPath) {
        $this->path = $dbPath;
    }

    private function getData() {
        if (!\file_exists($this->path)) {
            return array();
        }
        return unserialize(\file_get_contents($this->path));
    }

    /**
     * @return Bool
     */
    private function saveData(array $db) {
        $status = \file_put_contents($this->path, serialize($db));
        return $status !== False;
    }

    /**
     * @param string $schema
     * @param array $data
     * @return Bool
     */
    public function save($schema, array $data) {
        $db = $this->getData();

        if (empty($db[$schema])) {
            $db[$schema] = array();
        }
        $db[$schema][] = $data;

        return $this->saveData($db);
    }

    /**
     * @param string $schema
     * @param Condition[] $condition
     * @return array
     */
    public function findOne($schema, array $conditions) {
        $db = $this->getData();
        if (empty($db[$schema])) {
            return array();
        }
        foreach($db[$schema] as $row) {
            if ($this->fitAll($row, $conditions)) {
                return $row;
            }
        }
        return array();
    }

    /**
     * @param $schema Condition[] $conditions
     * @return array
     */
    public function find($schema, array $conditions) {
        $db = $this->getData();
        if (empty($db[$schema])) {
            return array();
        }
        
        $out = array();
        foreach($db[$schema] as $row) {
            if ($this->fitAll($row, $conditions)) {
                $out[] = $row;
            }
        }
        return $out;
    }

    public function findAll($schema) {
        $db = $this->getData();
        if (empty($db[$schema])) {
            return array();
        }
        return $db[$schema];
    }

    public function updateOne(string $schema, array $conditions, array $data) {
        $db = $this->getData();

        $key = null;
        if(empty($db[$schema])){
            return False;
        }
        foreach($db[$schema] as $k => $row) {
            if ($this->fitAll($row, $conditions)) {
                $key = $k;
            }
        }
        if (!is_null($key)) {
            $db[$schema][$key] = $data;
            return $this->saveData($db);
        }
        return False;
    }

    /**
     * @param array $row
     * @param Condition[] $conditions
     * @return Bool
     */
    private function fitAll(array $row, array $conditions) {
        foreach ($conditions as $condition) {
            if (!$this->fit($row, $condition)) {
                return false;
            }
        }
        return true;
    }


    /**
     * @param array $row
     * @param Condition $condition
     * @return Bool
     */
    private function fit(array $row, Condition $condition) {
        if (empty($row[$condition->getField()])) {
            return false;
        }
        $data = $row[$condition->getField()];
        $value = $condition->getValue();
        switch ($condition->getOperation()) {
            case '=':
                if ($data == $value) {
                    return true;
                }
            break;
            case '<':
                if ($data < $value) {
                    return true;
                }
            break;
            case '>':
                if ($data > $value) {
                    return true;
                }
            break;
        }
        return false;
    }

    /**
     * @return Bool
     */
    public function dropDB() {
        return $this->saveData(array());
    }
}