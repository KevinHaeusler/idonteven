<?php

Class Schuetze{
    private $id;
	private $vorname;
	private $nachname;
    private $jahrgang;
    private $ort;

    function __construct($id = null){
		
		$this->id = $id;

		if ($this->id) {
            $sql = "SELECT * FROM schuetze WHERE id = ?;";
			$vars = array();
			$vars[] = array("i", $this->id);
            $result = _Database::query($sql, $vars);
            
            $this->vorname = $result[0]->vorname;
            $this->nachname = $result[0]->nachname;
            $this->jahrgang = $result[0]->jahrgang;
			$this->ort = $result[0]->ort;
        }

    }

    function speichern(){
		$this->vorname = $_POST['benutzerVerwaltung_vorname'];
		$this->name = $_POST['benutzerVerwaltung_nachname'];
        $this->jahrgang = $_POST['benutzerVerwaltung_jahrgang'];
        $this->ort = $_POST['benutzerVerwaltung_ort'];
        
        //evtl id zu nr und nr initialisieren 


        //Speichern neuer Schuetze
        if (!$this->id) {
            $sql = "INSERT INTO schuetze (vorname, nachname, jahrgang, ort) VALUES (?, ?, ?, ?);";
			$vars = array();
			$vars[] = array("s", $this->vorname);
			$vars[] = array("s", $this->name);
            $vars[] = array("s", $this->jahrgang);
            $vars[] = array("s", $this->ort);
			_Database::query($sql, $vars);
		} 
		else {
			$sql = "UPDATE schuetze SET vorname = ?, nachname = ?, jahrgang = ?, ort = ? WHERE id = $this->id;";
				$vars = array();
				$vars[] = array("s", $this->vorname);
				$vars[] = array("s", $this->name);
				$vars[] = array("s", $this->jahrgang);
				$vars[] = array("s", $this->ort);
				_Database::query($sql, $vars);
		}  
	}
	
	

    function get_property($property)
	{
		return $this->{$property};
    }
    
    function html_schuetzeErstellen()
	{
		$html = "<h1>Schütze erfassen</h1>"
			. "<p>&nbsp;</p>"
			. "<form method='POST'>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Jahrgang", "text", "benutzerVerwaltung_jahrgang", null, "personalien1", null, false, true)
			. _Form::input("Vorname", "text", "benutzerVerwaltung_vorname", null, "personalien2", null, true)
			. _Form::input("Nachname", "text", "benutzerVerwaltung_nachname", null, "personalien3", null, true)
			. _Form::input("Ort", "text", "benutzerVerwaltung_ort", null, "personalien4", null, true)
            . "</div>"
            .  "<div class='flex-row button-row'>
		    <a class='btn btn-default' href='?page=schuetzenverwaltung'>Abbrechen</a>"
			. _Form::button("Speichern", "schuetzeVerwaltungSpeichern", "btn-primary")
			. "</div>"
			. "</form>";
		return $html;
    }
    
    function html_schuetzeBearbeiten()
	{
		$html = "<h1>Schütze bearbeiten</h1>
		<h2>$this->vorname $this->nachname</h2>
			
			<p>&nbsp;</p>";
		
		// Formular
		$html .= "<form method='POST'>
				<div class='flex-row form-row'>"
				. _Form::input("Jahrgang", "text", "benutzerVerwaltung_jahrgang", $this->jahrgang, "personalien1", null, true)
				. _Form::input("Vorname", "text", "benutzerVerwaltung_vorname", $this->vorname, "personalien2", null, true)
				. _Form::input("Nachname", "text", "benutzerVerwaltung_nachname", $this->nachname, "personalien3", null, true)
				. _Form::input("Wohnort", "text", "benutzerVerwaltung_ort", $this->ort, "personalien4", null, true)
				. "</div>
				<p>&nbsp;</p>";
		
		// Lehrjahre
		
		// Button
		$html .= "<div class='flex-row button-row'>
				<a class='btn btn-default' href='?page=schuetzenverwaltung'>Zur&uuml;ck</a>"
				. _Form::button("Speichern", "schuetzeVerwaltungSpeichern_" . $this->id, "btn-primary")
				. _Form::button("L&ouml;schen", "schuetzeVerwaltungLoeschen_" . $this->id, "btn-danger")
				. "</div>
				</form>";
		
		return $html;
	}
}
?>