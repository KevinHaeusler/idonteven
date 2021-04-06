<?php

class _Database
{
	static private $db;
	static public $result_num_rows;
	
	static function create()
	{
		self::$db = new MySQLi(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		// Set charset to utf8
		self::set_charset("utf8");
	}
	
	static function set_charset($charset)
	{
		self::$db->set_charset($charset);
	}
	
	static function query($sql, $typesAndVars = null)
	{
		// Reset $result_num_rows
		self::$result_num_rows = 0;
		
		// Query ohne Parametermitgabe
		if($typesAndVars == null) {
			$resultset = self::$db->query($sql);
		}
		
		// Query mit Parameternmitgabe
		else {
			// Umwandlung von Typen zu String
			$typesString = '';
			$n = count($typesAndVars);
			for($i=0; $i<$n; $i++) {
				$typesString .= $typesAndVars[$i][0];
			}
			
			// Typenstring und zugeh�rige Variablen in 1 Array bringen
			$parameters = array();
			$parameters[] = & $typesString;
			for($i=0; $i<$n; $i++) {
				$parameters[] = & $typesAndVars[$i][1];
			}
			
			// prepare
			$query = self::$db->prepare($sql);
			if ($query === false) {
				return false;
			}
			
			// bind_param
			
			call_user_func_array(array($query, 'bind_param'), $parameters);


			// execute
			$query->execute();
			
			// get_result
			$resultset = $query->get_result();
			
			// close mysqli::prepare Statement
			$query->close();
		}
		
		// Return bei INSERT, UPDATE, DELETE
		// Query ohne Parameter: mysqli_stmt::get_result gibt FALSE und mysqli::$errno 0 zur�ck
		// Query mit Parametern: mysqli::query gibt TRUE zur�ck
		if ($resultset === false && !self::$db->errno || $resultset === true) {
			return true;
		}
		
		// Return bei SELECT: Array von Ergebnis-Objekten
		else if ($resultset) {
			self::$result_num_rows = $resultset->num_rows;
			$result = array();
			
			while ($row = $resultset->fetch_object()) {
				array_push($result, $row);
			}
			return $result;
		}
		
		// Return bei Fehler
		else {
			return false;
		}
	}
	
	static function get_insert_id()
	{
		return self::$db->insert_id;
	}
	
	static function close()
	{
		self::$db->close();
	}
	
}

?>