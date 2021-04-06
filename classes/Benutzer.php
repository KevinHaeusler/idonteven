<?php

class Benutzer
{
	protected $id;
	protected $vorname;
	protected $name;
	protected $email;
	protected $password;
	protected $password_hash;
	protected $rollen = array();
	protected $berechtigungen = array();
	private $startrolle;
	
	function __construct($id = null)
	{
		$this->id = $id;
		
		// Benutzer existiert bereits: Properties holen
		if ($this->id) {
			
			// Tabelle benutzer
			$sql = "SELECT id, vorname, name, email FROM benutzer WHERE id = $this->id;";
			$result = _Database::query($sql);
			
			$this->vorname = $result[0]->vorname;
			$this->name = $result[0]->name;
			$this->email = $result[0]->email;
			
			// Rollen holen
			$sql = "SELECT id FROM lehrling WHERE id = $this->id;";
			_Database::query($sql);
			if (_Database::$result_num_rows) {
				$this->rollen[] = "lehrling";
			}
			
			$sql = "SELECT id FROM praxisbildner WHERE id = $this->id;";
			_Database::query($sql);
			if (_Database::$result_num_rows) {
				$this->rollen[] = "praxisbildner";
			}
			
			$sql = "SELECT id FROM berufsbildner WHERE id = $this->id;";
			_Database::query($sql);
			if (_Database::$result_num_rows) {
				$this->rollen[] = "berufsbildner";
			}
					
			// Berechtigungen holen
			$sql = "SELECT berechtigung FROM berechtigung WHERE benutzer = $this->id;";
			$result = _Database::query($sql);
			if (_Database::$result_num_rows) {
				$this->rollen[] = "verwaltung";
			}
			foreach ($result as $result) {
				$this->berechtigungen[] = $result->berechtigung;
			}
			
			// Einstellungen holen
			$sql = "SELECT * FROM benutzer_einstellungen WHERE benutzer = $this->id;";
			$result = _Database::query($sql);
			if (_Database::$result_num_rows) {
				if (in_array($result[0]->startrolle, $this->rollen))
					$this->startrolle = $result[0]->startrolle;
			}
		}
	}
	
	protected function passwortGenerieren()
	{
		$this->password = "bildxzug:1998";
		$this->password_hash = password_hash($this->password, PASSWORD_BCRYPT);
	}
	
	function get_property($property)
	{
		return $this->{$property};
	}
	
}

?>