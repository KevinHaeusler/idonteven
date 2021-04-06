<?php

class Lehrjahr
{
	private $lehrling;
	private $vertragsjahr;
	private $jahr;
	private $schuljahr;
	private $lehrgang;
	private $ferientage;
	
	private $beginn;
	private $ende;
	
	
	function __construct($lehrling, $vertragsjahr)
	{
		$this->lehrling = $lehrling;
		$this->vertragsjahr = $vertragsjahr;
		
		// Lehrbeginn/Lehrende auslesen
		$sql = "SELECT lehrbeginn, lehrbeginn_ganzesjahr, lehrende, lehrgang FROM lehrling WHERE id = $this->lehrling;";
		$result = _Database::query($sql);
		
		$lehrbeginn = $result[0]->lehrbeginn;
		$lehrbeginn_ganzesjahr = $result[0]->lehrbeginn_ganzesjahr;
		$lehrende = $result[0]->lehrende;
		$lehrgang = $result[0]->lehrgang;
		
		// Beginn/Ende setzen
		$this->set_beginnUndEnde($lehrbeginn, $lehrbeginn_ganzesjahr, $lehrende);
		
		// Lehrjahr auslesen
		$sql = "SELECT * FROM lehrjahr WHERE lehrling = $this->lehrling AND vertragsjahr = $this->vertragsjahr;";
		$result = _Database::query($sql);
		
		if (_Database::$result_num_rows) {
			$this->jahr = $result[0]->jahr;
			$this->schuljahr = $result[0]->schuljahr;
			$this->lehrgang = $result[0]->lehrgang;
			$this->ferientage = $result[0]->ferientage;
		}
		
		// Lehrjahr berechnen
		else {
			// "Normale" Lehre
			if (strtotime($lehrbeginn) == strtotime($lehrbeginn_ganzesjahr)) {
				$this->jahr = strftime("%Y", strtotime($lehrbeginn)) + ($this->vertragsjahr - 1);
				$this->schuljahr = $this->vertragsjahr;
				$this->lehrgang = $lehrgang;
				$this->ferientage = 25.0;
			}
			
			// Lehrübernahme
			else {
				$this->jahr = strftime("%Y", strtotime($lehrbeginn_ganzesjahr)) + ($this->vertragsjahr - 2);
				$this->schuljahr = $this->vertragsjahr;
				$this->lehrgang = $lehrgang;
				$this->ferientage = 25.0;
			}
		}
	}
	
	function einlesen()
	{
		$this->schuljahr = $_POST['lehrlingVerwaltung_' . $this->vertragsjahr . '_schuljahr'];
		$this->lehrgang = $_POST['lehrlingVerwaltung_' . $this->vertragsjahr . '_lehrgang'];
		$this->ferientage = round(floatval($_POST['lehrlingVerwaltung_' . $this->vertragsjahr . '_ferientage']) * 2) / 2;
	}
	
	function speichern()
	{
		$sql = "INSERT INTO lehrjahr (lehrling, vertragsjahr, jahr, schuljahr, lehrgang, ferientage) 
				VALUES ($this->lehrling, $this->vertragsjahr, $this->jahr, ?, ?, ?);";
		$vars = array();
		$vars[] = array("i", $this->schuljahr);
		$vars[] = array("s", $this->lehrgang);
		$vars[] = array("d", $this->ferientage);
		_Database::query($sql, $vars);
	}
	
	function set_beginnUndEnde($lehrbeginn, $lehrbeginn_ganzesjahr, $lehrende)
	{
		// "Normale" Lehre
		if (strtotime($lehrbeginn) == strtotime($lehrbeginn_ganzesjahr)) {
			$this->beginn = strftime("%Y-%m-%d", strtotime("$lehrbeginn +" . ($this->vertragsjahr - 1) . " year"));
			$this->ende = strftime("%Y-%m-%d", strtotime("$lehrbeginn +$this->vertragsjahr year -1 day"));
			if (strtotime($this->ende) > strtotime($lehrende)) $this->ende = $lehrende;
		}
		
		// Lehrübernahme
		else {
			$this->beginn = strftime("%Y-%m-%d", strtotime("$lehrbeginn_ganzesjahr +" . ($this->vertragsjahr - 2) . " year"));
			if (strtotime($this->beginn) < strtotime($lehrbeginn)) $this->beginn = $lehrbeginn;
			$this->ende = strftime("%Y-%m-%d", strtotime("$lehrbeginn_ganzesjahr +" . ($this->vertragsjahr - 1) . " year -1 day"));
			if (strtotime($this->ende) > strtotime($lehrende)) $this->ende = $lehrende;
		}
		
	}
	
	function get_property($property)
	{
		return $this->{$property};
	}
	
}

?>