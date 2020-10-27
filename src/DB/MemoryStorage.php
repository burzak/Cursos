<?php

namespace Cursos\DB;

final class MemoryStorage implements StorageInterface {

    private $db = array();


    /**
     * @param string $schema
     * @param array $data
     * @return Bool
     */
    public function save($schema, array $data) {
        if (empty($this->db[$schema])) {
            $this->db[$schema] = array();
        }
        $this->db[$schema][] = $data;
        return true;
    }

    /**
     * @param string $schema
     * @param Condition[] $condition
     * @return array
     */
    public function findOne($schema, array $conditions) {
        if (empty($this->db[$schema])) {
            return array();
        }
        foreach($this->db[$schema] as $row) {
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
        if (empty($this->db[$schema])) {
            return array();
        }
        
        $out = array();
        foreach($this->db[$schema] as $row) {
            if ($this->fitAll($row, $conditions)) {
                $out[] = $row;
            }
        }
        return $out;
    }

    public function findAll($schema) {
        if (empty($this->db[$schema])) {
            return array();
        }
        return $this->db[$schema];
    }

    public function updateOne(string $schema, array $conditions, array $data) {
        $key = null;
        foreach($this->db[$schema] as $k => $row) {
            if ($this->fitAll($row, $conditions)) {
                $key = $k;
            }
        }
        if (!is_null($key)) {
            $this->db[$schema][$key] = $data;
            return True;
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
}