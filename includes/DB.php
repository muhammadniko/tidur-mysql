<?php

class DB {

	function __construct() {
		$this->mysqli=new mysqli (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
			or die (mysqli_error()
		);
	}

	function insert($table, $data) {

		$arr_field = array();
		$arr_value = array();

		// pecah array $data kedalam array $arr_field dan $arr_value
		// untuk memisahkan field table dan value-nya
		foreach ($data as $field => $value) {
			$arr_field[] = $field;
			$arr_value[] = "'".$value."'";
		}

		// Gabungan untuk masing-masing array, 
		// setiap item dipisahkan dengan koma (--, --, ..)
		$fields = implode(',', $arr_field);
		$values = implode(',',$arr_value);
		
		$SQL = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";	
		
		$this->mysqli->query($SQL);

		return true;
	}

	function delete($table, $where) {
		
		foreach ($where as $fields => $values) {
			$field = $fields;
			$value = $values;
		}

		$SQL = "DELETE FROM ".$table." WHERE ".$field."='".$value."'";
		$execute = $this->mysqli->query($SQL);
		
		if ($execute) {
			return true;
		} else {
			echo mysqli_error($this->mysqli);
		}
	}

	function update($table, $where, $data) {
		
		foreach ($data as $field => $value) {
			$arr_new[] = $field."='".$value."'";
		}

		foreach ($where as $fields => $values) {
			$where_field = $fields;
			$where_value = $values;
		}

		$new_data = implode(',', $arr_new);
		$SQL = "UPDATE ".$table." SET ".$new_data." WHERE ".$where_field."='".$where_value."'";
		$execute = $this->mysqli->query($SQL);
		
		if ($execute) {
			return true;
		} else {
			echo mysqli_error($this->mysqli);
		}
	}


	function read($table, $field, $where=array()) {
				
		$SQL = "SELECT ".$field." FROM ".$table;
		
		if ($where!=NULL) {
			foreach ($where as $field => $value) {
				$where_field = $field;
				$where_value = $value;
			}
			$SQL.=" WHERE ".$where_field."='".$where_value."'";
		}

		$execute = $this->mysqli->query($SQL);
		
		while ($row = mysqli_fetch_assoc($execute)) {
			$arr_data[] = $row;
		}

		return $arr_data;
	}
}

?>