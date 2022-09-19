<?php

namespace App\Model\Data {

    use PDOException;

    class QueryBuilder extends ConfigDB {
        private string $_table;

        public function __construct(string $table) {
            $this->_table = $table;
            $this->SetConnection();
        }

        public function Execute(string $query, array $params = []) {
            try {
                $statement = $this->_connection->prepare($query);
                $statement->execute($params);

                return $statement;
            }
            catch (PDOException $ex) {
                die("ERROR: ".$ex->getMessage());
            }
        }

        public function Insert(array $values) {
            $fields = array_keys($values);
            $binds  = array_pad([], count($fields), "?");

            $query = "INSERT INTO ". $this->_table ." (". implode(",", $fields) .") VALUES (". implode(",", $binds) .")";

            $this->Execute($query, array_values($values));

            return $this->_connection->lastInsertId();
        }

        public function Select(string $where = "", string $order = "", string $limit = "", string  $fields = "*") {
            $where = strlen($where) ? "WHERE " .$where : "";
            $order = strlen($order) ? "ORDER BY " .$order : "";
            $limit = strlen($limit) ? "LIMIT  " .$limit : "";

            $query = "SELECT ". $fields ." FROM ". $this->_table." ". $where ." ". $order ." ". $limit;

            return $this->Execute($query);
        }

        public function Update(string $where, array $values) {
            $fields = array_keys($values);

            $query = "UPDATE ". $this->_table ." SET ". implode("=?,", $fields) ."=? WHERE ". $where;

            $this->Execute($query, array_values($values));

            return true;
        }

        public function Delete(string $where) {
            $query = "DELETE FROM ".$this->_table." WHERE ".$where;
        
            $this->Execute($query);

            return true;
        }
    }
}