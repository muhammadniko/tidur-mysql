<?php

require_once ('config.php');
require_once ('connection.php');

class Query {

	function insert($table, $data) {
		
		global $mysqli;

		$arr_field = array();
		$arr_value = array();

		foreach ($data as $field => $value) {
			$arr_field[] = $field;
			$arr_value[] = "'".$value."'";
		}

		$fields = implode(',', $arr_field);
		$values = implode(',',$arr_value);
		
		$SQL = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";	
		
		$mysqli->query($SQL);

		return true;
	}

	function delete($table, $where) {
		
		global $mysqli;
		
		foreach ($where as $fields => $values) {
			$field = $fields;
			$value = $values;
		}

		$SQL = "DELETE FROM ".$table." WHERE ".$field."='".$value."'";
		$execute = $mysqli->query($SQL);
		
		if ($execute) {
			return true;
		} else {
			echo mysqli_error($mysqli);
		}
	}

	function update($table, $where, $data) {

		global $mysqli;
		
		foreach ($data as $field => $value) {
			$arr_new[] = $field."='".$value."'";
		}

		foreach ($where as $fields => $values) {
			$where_field = $fields;
			$where_value = $values;
		}

		$new_data = implode(',', $arr_new);
		$SQL = "UPDATE ".$table." SET ".$new_data." WHERE ".$where_field."='".$where_value."'";
		$execute = $mysqli->query($SQL);
		
		if ($execute) {
			return true;
		} else {
			echo mysqli_error($mysqli);
		}
	}


	function read($table, $field, $where=array()) {
		
		global $mysqli;
		
		$SQL = "SELECT ".$field." FROM ".$table;
		
		if ($where!=NULL) {
			foreach ($where as $field => $value) {
				$where_field = $field;
				$where_value = $value;
			}
			$SQL.=" WHERE ".$where_field."='".$where_value."'";
		}

		$execute = $mysqli->query($SQL);
		
		while ($row = mysqli_fetch_array($execute)) {
			$arr_data[] = $row;
		}

		return $arr_data;
	}
}

$db = new Query();

?>