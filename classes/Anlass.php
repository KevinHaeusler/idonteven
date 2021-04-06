<?php

Class Anlass{
    private $id;
	private $anlassname;
	private $datum;
    

    function __construct($id = null){
		
		$this->id = $id;

		if ($this->id) {
            $sql = "SELECT * FROM anlass WHERE id = ?;";
			$vars = array();
			$vars[] = array("i", $this->id);
            $result = _Database::query($sql, $vars);
            
            $this->anlassname = $result[0]->anlassname;
            $this->datum = $result[0]->datum;
            
        }

    }

    function speichern(){
		$this->anlassname = $_POST['anlassverwaltung_name'];
		$this->datum = $_POST['anlassverwaltung_datum'];
        

        //Speichern neuer Schuetze
        if (!$this->id) {
            $sql = "INSERT INTO anlass (anlassname, datum) VALUES (?, ?);";
			$vars = array();
			$vars[] = array("s", $this->anlassname);
			$vars[] = array("s", $this->datum);
			_Database::query($sql, $vars);

		} 
		else {
			$sql = "UPDATE anlass SET anlassname = ?, datum = ? WHERE id = $this->id;";
				$vars = array();
				$vars[] = array("s", $this->anlassname);
				$vars[] = array("s", $this->datum);
				_Database::query($sql, $vars);
		}  
	}
	
	

    function get_property($property)
	{
		return $this->{$property};
    }
    
    function html_anlaesseErstellen()
    {
        $html = "<h1>Anlass erfassen</h1>"
            . "<p>&nbsp;</p>"
            . "<form method='POST'>"
            . "<div class='flex-row form-row'>"
            . _Form::input("Name des Anlasses", "text", "anlassverwaltung_name", null, "personalien1", null, false, true)
            . _Form::input("Datum", "text", "anlassverwaltung_datum", null, "personalien2", null, true)
            . "</div>"
            .  "<div class='flex-row button-row'>
            <a class='btn btn-default' href='?page=anlassverwaltung'>Zurück</a>"
            . _Form::button("Speichern", "anlassverwaltungSpeichern", "btn-primary")
            . "</div>"
            . "</form>";
        return $html;
    }
    
    function html_anlaesseBearbeiten()
	{
		$html = "<h1>Anlass bearbeiten</h1>
		<h2>$this->anlassname $this->datum</h2>
			<p>&nbsp;</p>";
		
		// Formular
		$html .= "<form method='POST'>
				<div class='flex-row form-row'>"
				. _Form::input("Name des Anlasses", "text", "anlassverwaltung_name", $this->anlassname, "personalien1", null, true)
				. _Form::input("Datum", "text", "anlassverwaltung_datum", $this->datum, "personalien2", null, true)

				. "</div>
				<p>&nbsp;</p>";
		
		// Lehrjahre
		
		// Button
		$html .= "<div class='flex-row button-row'>
				<a class='btn btn-default' href='?page=anlassverwaltung'>Zur&uuml;ck</a>"
				. _Form::button("Speichern", "anlassverwaltungSpeichern_" . $this->id, "btn-primary")
				. _Form::button("L&ouml;schen", "anlassVerwaltungLoeschen_" . $this->id, "btn-danger")
				. "</div>
				</form>";
		
		return $html;
	}
}
?>