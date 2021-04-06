<?php

// Variabeln
Class Resultate{
    private $id;
	private $schuetze_id;
	private $anlass_id;
	private $vmReh1;
	private $vmReh2;
	private $vmReh3;
	private $vmGams1;
	private $vmGams2;
	private $vmGams3;
	private $vmKlapphas1;
	private $vmKlapphas2;
	private $vmKlapphas3;
	private $vmRollhas1;
	private $vmRollhas2;
	private $vmRollhas3;
	private $vmTotalReh;
	private $vmTotalGams;
	private $vmTotalKlapphas;
	private $vmTotalRollhas;
	private $vmTotal;
	private $vmTiefschussReh;
	private $vmTiefschussGams;
	private $fsStich1;
	private $fsStich2;
	private $fsStich3;
	private $fsNachdoppel1;
	private $fsNachdoppel2;
	private $fsTiefschusstich1;
	private $fsTotal;
	private $smKlapphas1;
	private $smKlapphas2;
	private $smKlapphas3;
	private $smKlapphas4;
	private $smKlapphas5;
	private $smKlapphas6;
	private $smKlapphas7;
	private $smKlapphas8;
	private $smKlapphas9;
	private $smKlapphas10;
	private $smRollhas1;
	private $smRollhas2;
	private $smRollhas3;
	private $smRollhas4;
	private $smRollhas5;
	private $smRollhas6;
	private $smRollhas7;
	private $smRollhas8;
	private $smTontaube1;
	private $smTontaube2;
	private $smTontaube3;
	private $smTontaube4;
	private $smTontaube5;
	private $smKlapphasTotal;
	private $smRollhasTotal;
	private $smTotal;


// Contruct Function mit allen Values
    function __construct($id = null){
		
		$this->id = $id;

		if ($this->id) {
             $sql = "SELECT * FROM resultate WHERE id = ?;";
			$vars = array();
			$vars[] = array("i", $this->id);
            $result = _Database::query($sql, $vars);
            
            $this->vmReh1 = $result[0]->vmReh1;
			$this->vmReh2 = $result[0]->vmReh2;
            $this->vmReh3 = $result[0]->vmReh3;
            $this->vmGams1 = $result[0]->vmGams1;
            $this->vmGams2 = $result[0]->vmGams2;
            $this->vmGams3 = $result[0]->vmGams3;
            $this->vmKlapphas1 = $result[0]->vmKlapphas1;
            $this->vmKlapphas2 = $result[0]->vmKlapphas2;
            $this->vmKlapphas3 = $result[0]->vmKlapphas3;
			$this->vmRollhas1 = $result[0]->vmRollhas1;
			$this->vmRollhas2 = $result[0]->vmRollhas2;
			$this->vmRollhas3 = $result[0]->vmRollhas3;
			$this->vmTiefschussReh = $result[0]->vmTiefschussReh;
			$this->vmTiefschussGams = $result[0]->vmTiefschussGams;
			$this->vmTotalReh = $result[0]->vmTotalReh;
			$this->vmTotalGams = $result[0]->vmTotalGams;
			$this->vmTotalKlapphas = $result[0]->vmTotalKlapphas;
			$this->vmTotalRollhas = $result[0]->vmTotalRollhas;
			$this->vmTotal = $result[0]->vmTotal;
			$this->fsStich1 = $result[0]->fsStich1;
			$this->fsStich2 = $result[0]->fsStich2;
			$this->fsStich3 = $result[0]->fsStich3;
			$this->fsNachdoppel1 = $result[0]->fsNachdoppel1;
			$this->fsNachdoppel2 = $result[0]->fsNachdoppel2;
			$this->fsTiefschussstich1 = $result[0]->fsTiefschussstich1;
			$this->fsTotal = $result[0]->fsTotal;
			$this->smKlapphas1 = $result[0]->smKlapphas1;
			$this->smKlapphas2 = $result[0]->smKlapphas2;
			$this->smKlapphas3 = $result[0]->smKlapphas3;
			$this->smKlapphas4 = $result[0]->smKlapphas4;
			$this->smKlapphas5 = $result[0]->smKlapphas5;
			$this->smKlapphas6 = $result[0]->smKlapphas6;
			$this->smKlapphas7 = $result[0]->smKlapphas7;
			$this->smKlapphas8 = $result[0]->smKlapphas8;
			$this->smKlapphas9 = $result[0]->smKlapphas9;
			$this->smKlapphas10 = $result[0]->smKlapphas10;
			$this->smRollhas1 = $result[0]->smKlapphas10;
			$this->smRollhas2 = $result[0]->smRollhas2;
			$this->smRollhas3 = $result[0]->smRollhas3;
			$this->smRollhas4 = $result[0]->smRollhas4;
			$this->smRollhas5 = $result[0]->smRollhas5;
			$this->smRollhas6 = $result[0]->smRollhas6;
			$this->smRollhas7 = $result[0]->smRollhas7;
			$this->smRollhas8 = $result[0]->smRollhas8;
			$this->smTontaube1 = $result[0]->smRollhas8;
			$this->smTontaube2 = $result[0]->smTontaube2;
			$this->smTontaube3 = $result[0]->smTontaube3;
			$this->smTontaube4 = $result[0]->smTontaube4;
			$this->smTontaube5 = $result[0]->smTontaube5;
			$this->smKlapphasTotal = $result[0]->smKlapphasTotal;
			$this->smRollhasTotal = $result[0]->smRollhasTotal;
			$this->smTotal = $result[0]->smTotal;



        }

    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 

	// Speicherungsfunktion für die Vereinsmeisterschaft
    function vmspeichern(){
		$this->vmReh1 = $_POST['resultatverwaltung_reh1'];
		$this->vmReh2 = $_POST['resultatverwaltung_reh2'];
        $this->vmReh3 = $_POST['resultatverwaltung_reh3'];
        $this->vmGams1 = $_POST['resultatverwaltung_gams1'];
		$this->vmGams2 = $_POST['resultatverwaltung_gams2'];
		$this->vmGams3 = $_POST['resultatverwaltung_gams3'];
        $this->vmKlapphas1 = $_POST['resultatverwaltung_vmKlapphas1'];
        $this->vmKlapphas2 = $_POST['resultatverwaltung_vmKlapphas2'];
        $this->vmKlapphas3 = $_POST['resultatverwaltung_vmKlapphas3'];
        $this->vmRollhas1 = $_POST['resultatverwaltung_vmRollhas1'];
        $this->vmRollhas2 = $_POST['resultatverwaltung_vmRollhas2'];
        $this->vmRollhas3 = $_POST['resultatverwaltung_vmRollhas3'];
		$this->vmTiefschussReh = $_POST['resultatverwaltung_vmTiefschussReh'];
		$this->vmTiefschussGams = $_POST['resultatverwaltung_vmTiefschussGams'];
        $this->vmTotalReh = $_POST['resultatverwaltung_vmTotalReh'];
        $this->vmTotalGams = $_POST['resultatverwaltung_vmTotalGams'];
        $this->vmTotalKlapphas = $_POST['resultatverwaltung_vmTotalKlapphas'];
        $this->vmTotalRollhas = $_POST['resultatverwaltung_vmTotalRollhas'];
        $this->vmTotal = $_POST['resultatverwaltung_vmTotal'];


        if (!$this->id) {
            $sql = "INSERT INTO resultate (vmReh1, vmReh2, vmReh3, vmGams1, vmGams2, vmGams3, vmKlapphas1, vmKlapphas2, vmKlapphas3, vmRollhas1, vmRollhas2, vmRollhas3, vmTiefschussReh, vmTiefschussGams, vmTotalReh, vmTotalGams, vmTotalKlapphas, vmTotalRollhas, vmTotal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$vars = array();
			$vars[] = array("s", $this->vmReh1);
			$vars[] = array("s", $this->vmReh2);
            $vars[] = array("s", $this->vmReh3);
			$vars[] = array("s", $this->vmGams1);
            $vars[] = array("s", $this->vmGams2);
            $vars[] = array("s", $this->vmGams3);
            $vars[] = array("s", $this->vmKlapphas1);
            $vars[] = array("s", $this->vmKlapphas2);
            $vars[] = array("s", $this->vmKlapphas3);
            $vars[] = array("s", $this->vmRollhas1);
            $vars[] = array("s", $this->vmRollhas2);
            $vars[] = array("s", $this->vmRollhas3);
			$vars[] = array("s", $this->vmTiefschussReh);
            $vars[] = array("s", $this->vmTiefschussGams);
            $vars[] = array("s", $this->vmTotalReh);
            $vars[] = array("s", $this->vmTotalGams);
            $vars[] = array("s", $this->vmTotalKlapphas);
			$vars[] = array("s", $this->vmTotal);
			_Database::query($sql, $vars);
		} 
		else {
			$sql = "UPDATE resultate SET vmReh1 = ?, vmReh2 = ?, vmReh3 = ?, vmGams1 = ?, vmGams2 = ?, vmGams3 = ?, vmKlapphas1 = ?, vmKlapphas2 = ?, vmKlapphas3 = ?, vmRollhas1 = ?, vmRollhas2 = ?, vmRollhas3 = ?, vmTiefschussReh = ?, vmTiefschussGams = ?, vmTotalReh = ?, vmTotalGams = ?, vmTotalKlapphas = ?, vmTotalRollhas = ?, vmTotal = ? WHERE id = $this->id;";
				$vars = array();
				$vars[] = array("s", $this->vmReh1);
			$vars[] = array("s", $this->vmReh2);
            $vars[] = array("s", $this->vmReh3);
			$vars[] = array("s", $this->vmGams1);
            $vars[] = array("s", $this->vmGams2);
            $vars[] = array("s", $this->vmGams3);
            $vars[] = array("s", $this->vmKlapphas1);
            $vars[] = array("s", $this->vmKlapphas2);
            $vars[] = array("s", $this->vmKlapphas3);
            $vars[] = array("s", $this->vmRollhas1);
            $vars[] = array("s", $this->vmRollhas2);
            $vars[] = array("s", $this->vmRollhas3);
			$vars[] = array("s", $this->vmTiefschussReh);
            $vars[] = array("s", $this->vmTiefschussGams);
            $vars[] = array("s", $this->vmTotalReh);
            $vars[] = array("s", $this->vmTotalGams);
            $vars[] = array("s", $this->vmTotalKlapphas);
			$vars[] = array("s", $this->vmTotal);
				_Database::query($sql, $vars);
		}  
	}
	

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	// Speicherungsfunktion für den Fuchsstich
	function fsspeichern(){
		$this->fsStich1 = $_POST['resultatverwaltung_stich1'];
		$this->fsStich2 = $_POST['resultatverwaltung_stich2'];
        $this->fsStich3 = $_POST['resultatverwaltung_stich3'];
        $this->fsNachdoppel1 = $_POST['resultatverwaltung_nachdoppel1'];
		$this->fsNachdoppel2 = $_POST['resultatverwaltung_nachdoppel2'];
		$this->fsTiefschussStich1 = $_POST['resultatverwaltung_fstiefschussStich1'];
        $this->fsTotal = $_POST['resultatverwaltung_fsTotal'];
        
        if (!$this->id) {
            $sql = "INSERT INTO resultate (fsstich1, fsstich2, fsstich3, fsNachdoppel1, fsNachdoppel2, fsTiefschussStich1, fsTotal) VALUES (?, ?, ?, ?, ?, ?, ?);";
			$vars = array();
			$vars[] = array("s", $this->fsstich1);
			$vars[] = array("s", $this->fsstich2);
            $vars[] = array("s", $this->fsstich3);
            $vars[] = array("s", $this->fsNachdoppel1);
			$vars[] = array("s", $this->fsNachdoppel1);
            $vars[] = array("s", $this->fsNachdoppel2);
            $vars[] = array("s", $this->fsTiefschussStich1);
            $vars[] = array("s", $this->fsTotal);

			_Database::query($sql, $vars);
		} 
		else {
			$sql = "UPDATE resultate SET fsstich1 = ?, fsstich2 = ?, fsstich3 = ?, fsNachdoppel1 = ?, fsNachdoppel2 = ?, fsTiefschussStich1 = ?, fsTotal = ? WHERE id = $this->id;";
				$vars = array();
				$vars[] = array("s", $this->fsstich1);
				$vars[] = array("s", $this->fsstich2);
            	$vars[] = array("s", $this->fsstich3);
            	$vars[] = array("s", $this->fsNachdoppel1);
				$vars[] = array("s", $this->fsNachdoppel1);
            	$vars[] = array("s", $this->fsNachdoppel2);
            	$vars[] = array("s", $this->fsTiefschussStich1);
            	$vars[] = array("s", $this->fsTotal);
				_Database::query($sql, $vars);
		}  
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	//Speicherfunktion für die Schrotmeisterschaft
	function smspeichern(){
		$this->smKlapphas1 = $_POST['resultatverwaltung_smKlapphas1'];
		$this->smKlapphas2 = $_POST['resultatverwaltung_smKlapphas2'];
        $this->smKlapphas3 = $_POST['resultatverwaltung_smKlapphas3'];
        $this->smKlapphas4 = $_POST['resultatverwaltung_smKlapphas4'];
		$this->smKlapphas5 = $_POST['resultatverwaltung_smKlapphas5'];
		$this->smKlapphas6 = $_POST['resultatverwaltung_smKlapphas6'];
        $this->smKlapphas7 = $_POST['resultatverwaltung_smKlapphas7'];
        $this->smKlapphas8 = $_POST['resultatverwaltung_smKlapphas8'];
        $this->smKlapphas9 = $_POST['resultatverwaltung_smKlapphas9'];
        $this->smKlapphas10 = $_POST['resultatverwaltung_smKlapphas10'];
        $this->smRollhas1 = $_POST['resultatverwaltung_smRollhas1'];
        $this->smRollhas2 = $_POST['resultatverwaltung_smRollhas2'];
        $this->smRollhas3 = $_POST['resultatverwaltung_smRollhas3'];
        $this->smRollhas4 = $_POST['resultatverwaltung_smRollhas4'];
        $this->smRollhas5 = $_POST['resultatverwaltung_smRollhas5'];
        $this->smRollhas6 = $_POST['resultatverwaltung_smRollhas6'];
        $this->smRollhas7 = $_POST['resultatverwaltung_smRollhas7'];
		$this->smRollhas8 = $_POST['resultatverwaltung_smRollhas8'];
        $this->smTontaube1 = $_POST['resultatverwaltung_Tontaube1'];
        $this->smTontaube2 = $_POST['resultatverwaltung_Tontaube2'];
        $this->smTontaube3 = $_POST['resultatverwaltung_Tontaube3'];
        $this->smTontaube4 = $_POST['resultatverwaltung_Tontaube4'];
        $this->smTontaube5 = $_POST['resultatverwaltung_Tontaube5'];
        $this->smKlapphasTotal = $_POST['resultatverwaltung_smKlapphasTotal'];
        $this->smRollhasTotal = $_POST['resultatverwaltung_smRollhasTotal'];
        $this->smTotal = $_POST['resultatverwaltung_smTotal'];

        if (!$this->id) {
            $sql = "INSERT INTO resultate (smKlapphas1, smKlapphas2, smKlapphas3, smKlapphas4, smKlapphas5, smKlapphas6, smKlapphas7, smKlapphas8, smKlapphas9, smKlapphas10, smRollhas1, smRollhas2, Rollhas3, smRollhas4, smRollhas5, smRollhas6, smRollhas7, smRollhas8, smTontaube1, smTontaube2, smTontaube3, smTontaube4, smTontaube5, smKlapphasTotal, smRollhasTotal, smTotal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$vars = array();
			$vars[] = array("s", $this->smKlapphas1);
			$vars[] = array("s", $this->smKlapphas2);
            $vars[] = array("s", $this->smKlapphas3);
            $vars[] = array("s", $this->smKlapphas4);
			$vars[] = array("s", $this->smKlapphas5);
            $vars[] = array("s", $this->smKlapphas6);
            $vars[] = array("s", $this->smKlapphas7);
            $vars[] = array("s", $this->smKlapphas8);
            $vars[] = array("s", $this->smKlapphas9);
            $vars[] = array("s", $this->smKlapphas10);
            $vars[] = array("s", $this->smRollhas1);
            $vars[] = array("s", $this->smRollhas2);
            $vars[] = array("s", $this->smRollhas3);
            $vars[] = array("s", $this->smRollhas4);
            $vars[] = array("s", $this->smRollhas5);
            $vars[] = array("s", $this->smRollhas6);
            $vars[] = array("s", $this->smRollhas7);
            $vars[] = array("s", $this->smRollhas8);
            $vars[] = array("s", $this->smTontaube1);
            $vars[] = array("s", $this->smTontaube2);
            $vars[] = array("s", $this->smTontaube3);
            $vars[] = array("s", $this->smTontaube4);
            $vars[] = array("s", $this->smTontaube5);
            $vars[] = array("s", $this->smKlapphasTotal);
            $vars[] = array("s", $this->smRollhasTotal);
            $vars[] = array("s", $this->smTotal);

			_Database::query($sql, $vars);
		} 
		else {
			$sql = "UPDATE resultate SET smKlapphas1 = ?, smKlapphas2 = ?, smKlapphas3 = ?, smKlapphas4 = ?, smKlapphas5 = ?, smKlapphas6 = ?, smKlapphas7 = ?, smKlapphas8 = ?, smKlapphas9 = ?, smKlapphas10 = ?, smRollhas1 = ?, smRollhas2 = ?, Rollhas3 = ?, smRollhas4 = ?, smRollhas5 = ?, smRollhas6 = ?, smRollhas7 = ?, smRollhas8 = ?, smTontaube1 = ?, smTontaube2 = ?, smTontaube3 = ?, smTontaube4 = ?, smTontaube5 = ?, smKlapphasTotal = ?, smRollhasTotal = ?, smTotal = ?  WHERE id = $this->id;";
				$vars = array();
				$vars[] = array("s", $this->smKlapphas1);
				$vars[] = array("s", $this->smKlapphas2);
            	$vars[] = array("s", $this->smKlapphas3);
            	$vars[] = array("s", $this->smKlapphas4);
				$vars[] = array("s", $this->smKlapphas5);
            	$vars[] = array("s", $this->smKlapphas6);
            	$vars[] = array("s", $this->smKlapphas7);
            	$vars[] = array("s", $this->smKlapphas8);
           	 	$vars[] = array("s", $this->smKlapphas9);
            	$vars[] = array("s", $this->smKlapphas10);
            	$vars[] = array("s", $this->smRollhas1);
            	$vars[] = array("s", $this->smRollhas2);
            	$vars[] = array("s", $this->smRollhas3);
            	$vars[] = array("s", $this->smRollhas4);
            	$vars[] = array("s", $this->smRollhas5);
            	$vars[] = array("s", $this->smRollhas6);
            	$vars[] = array("s", $this->smRollhas7);
            	$vars[] = array("s", $this->smRollhas8);
            	$vars[] = array("s", $this->smTontaube1);
            	$vars[] = array("s", $this->smTontaube2);
            	$vars[] = array("s", $this->smTontaube3);
            	$vars[] = array("s", $this->smTontaube4);
            	$vars[] = array("s", $this->smTontaube5);
           		$vars[] = array("s", $this->smKlapphasTotal);
            	$vars[] = array("s", $this->smRollhasTotal);
            	$vars[] = array("s", $this->smTotal);
				_Database::query($sql, $vars);
		}  
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   function get_property($property)
{
		return $this->{$property};
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    

// Werte-Eingabe für die Vereinsmeisterschaft
function html_vmErstellen()
	{
		$html = "<h1>VM Resultate erfassen</h1>"
			. "<p>&nbsp;</p>"
			. "<form method='POST'>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Reh Schuss 1", "text", "resultatverwaltung_reh1", null, "personalien1", null, false, true)
			. _Form::input("Reh Schuss 2", "text", "resultatverwaltung_reh2", null, "personalien2", null, true)
			. _Form::input("Reh Schuss 3", "text", "resultatverwaltung_reh3", null, "personalien3", null, true,)
			. "</div>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Gams Schuss 1", "text", "resultatverwaltung_gams1", null, "personalien4", null, true)
			. _Form::input("Gams Schuss 2", "text", "resultatverwaltung_gams2", null, "personalien5", null, true)
			. _Form::input("Gams Schuss 3", "text", "resultatverwaltung_gams3", null, "personalien6", null, true)
			. "</div>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Klapphas Schuss 1", "text", "resultatverwaltung_vmKlapphas1", null, "personalien7", null, true)
			. _Form::input("Klapphas Schuss 2", "text", "resultatverwaltung_vmKlapphas2", null, "personalien8", null, true)
			. _Form::input("Klapphas Schuss 3", "text", "resultatverwaltung_vmKlapphas3", null, "personalien9", null, true)
			. "</div>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Rollhas Schuss 1", "text", "resultatverwaltung_vmRollhas1", null, "personalien10", null, true)
			. _Form::input("Rollhas Schuss 2", "text", "resultatverwaltung_vmRollhas2", null, "personalien11", null, true)
			. _Form::input("Rollhas Schuss 3", "text", "resultatverwaltung_vmRollhas3", null, "personalien12", null, true)
			. "</div>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Tiefschuss Reh", "text", "resultatverwaltung_vmTiefschussReh", null, "personalien13", null, true)
			. _Form::input("Tiefschuss Gams", "text", "resultatverwaltung_vmTiefschussGams", null, "personalien14", null, true)
			. "</div>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Total Punkte Reh", "text", "resultatverwaltung_vmTotalReh", null, "personalien15", null, true)
			. _Form::input("Total Punkte Gams", "text", "resultatverwaltung_vmTotalGams", null, "personalien16", null, true)
			. _Form::input("Total Punkte Klapphas", "text", "resultatverwaltung_vmTotalKlapphas", null, "personalien17", null, true)
			. _Form::input("Total Punkte Rollhas", "text", "resultatverwaltung_vmTotalRollhas", null, "personalien18", null, true)
			. _Form::input("Gesamttotal", "text", "resultatverwaltung_vmTotal", null, "personalien19", null, true)
			. "</div>"
            .  "<div class='flex-row button-row'>
		    <a class='btn btn-default' href='?page=resultatverwaltung'>Abbrechen</a>"
			. _Form::button("Speichern", "vmresultatVerwaltungSpeichern", "btn-primary")
			. "</div>"
			. "</form>";
		return $html;
    }
    
	// Bearbeitung für die Vereinsmeisterschaft 
    function html_vmBearbeiten()
	{
		$html = "<h1>VM Resultate bearbeiten</h1>
			<p>&nbsp;</p>";
		
		// Formular
		$html .= "<form method='POST'>
				<div class='flex-row form-row'>"
				. _Form::input("Reh Schuss 1", "text", "resultatverwaltung_reh1", $this->vmReh1, "personalien1", null, true)
				. _Form::input("Reh Schuss 2", "text", "resultatverwaltung_reh2", $this->vmReh2, "personalien2", null, true)
				. _Form::input("Reh Schuss 3", "text", "resultatverwaltung_reh3", $this->vmReh3, "personalien3", null, true)
				. "</div>"
				. "<div class='flex-row form-row'>"
				. _Form::input("Gams Schuss 1", "text", "resultatverwaltung_gams1", $this->vmGams1, "personalien4", null, true)
				. _Form::input("Gams Schuss 2", "text", "resultatverwaltung_gams2", $this->vmGams2, "personalien5", null, true)
				. _Form::input("Gams Schuss 3", "text", "resultatverwaltung_gams3", $this->vmGams3, "personalien6", null, true)
				. "</div>"
				. "<div class='flex-row form-row'>"
				. _Form::input("Klapphas Schuss 1", "text", "resultatverwaltung_vmKlapphas1", $this->vmKlapphas1, "personalien7", null, true)
				. _Form::input("Klapphas Schuss 2", "text", "resultatverwaltung_vmKlapphas2", $this->vmKlapphas2, "personalien8", null, true)
				. _Form::input("Klapphas Schuss 3", "text", "resultatverwaltung_vmKlapphas3", $this->vmKlapphas3, "personalien9", null, true)
				. "</div>"
				. "<div class='flex-row form-row'>"
				. _Form::input("Rollhas Schuss 1", "text", "resultatverwaltung_vmRollhas1", $this->vmRollhas1, "personalien10", null, true)
				. _Form::input("Rollhas Schuss 2", "text", "resultatverwaltung_vmRollhas2", $this->vmRollhas2, "personalien11", null, true)
				. _Form::input("Rollhas Schuss 3", "text", "resultatverwaltung_vmRollhas3", $this->vmRollhas3, "personalien12", null, true)
				. "</div>"
				. "<div class='flex-row form-row'>"
				. _Form::input("Tiefschuss Reh", "text", "resultatverwaltung_vmTiefschussReh", $this->vmTiefschussReh, "personalien13", null, true)
				. _Form::input("Tiefschuss Gams", "text", "resultatverwaltung_vmTiefschussGams", $this->vmTiefschussGams, "personalien14", null, true)
				. "</div>"
				. "<div class='flex-row form-row'>"
				. _Form::input("Total Punkte Reh", "text", "resultatverwaltung_vmTotalReh", $this->vmTotalReh, "personalien15", null, true)
				. _Form::input("Total Punkte Gams", "text", "resultatverwaltung_vmTotalGams", $this->vmTotalGams, "personalien16", null, true)
				. _Form::input("Total Punkte Klapphas", "text", "resultatverwaltung_vmTotalKlapphas", $this->vmTotalKlapphas, "personalien17", null, true)
				. _Form::input("Total Punkte Rollhas", "text", "resultatverwaltung_vmTotalRollhas", $this->vmTotalRollhas, "personalien18", null, true)
				. _Form::input("Gesamttotal", "text", "resultatverwaltung_vmTotal", $this->vmTotal, "personalien19", null, true)
				. "</div>
				<p>&nbsp;</p>";
		
		
		// Button
		$html .= "<div class='flex-row button-row'>
				<a class='btn btn-default' href='?page=resultatverwaltung'>Zur&uuml;ck</a>"
				. _Form::button("Speichern", "vmresultatverwaltungSpeichern" . $this->id, "btn-primary")
				. _Form::button("L&ouml;schen", "vmresultatVerwaltungLoeschen" . $this->id, "btn-danger")
				. "</div>
				</form>";
		
		return $html;
	}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



// Werte-Eingabe für den Fuchsstich

	function html_fsErstellen()
	{
		$html = "<h1>FS Resultate erfassen</h1>"
			. "<p>&nbsp;</p>"
			. "<form method='POST'>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Stich 1", "text", "benutzerVerwaltung_stich1", null, "personalien1", null, false, true)
			. _Form::input("Stich 2", "text", "benutzerVerwaltung_stich2", null, "personalien2", null, true)
			. _Form::input("Stich 3", "text", "benutzerVerwaltung_stich3", null, "personalien3", null, true)
			. _Form::input("Nachdoppel 1", "text", "benutzerVerwaltung_nachdoppel1", null, "personalien4", null, true)
			. _Form::input("Nachdoppel 2", "text", "benutzerVerwaltung_nachdoppel2", null, "personalien5", null, true)
			. _Form::input("Tiefschuss Stich 1", "text", "benutzerVerwaltung_fstiefschussStich1", null, "personalien6", null, true)
			. _Form::input("Total", "text", "benutzerVerwaltung_fsTotal", null, "personalien7", null, true)
            . "</div>"
            .  "<div class='flex-row button-row'>
		    <a class='btn btn-default' href='?page=resultatverwaltung'>Abbrechen</a>"
			. _Form::button("Speichern", "fsresultatVerwaltungSpeichern", "btn-primary")
			. "</div>"
			. "</form>";
		return $html;
    }

    // Bearbeitung für den Fuchsstich 
    function html_fsBearbeiten()
	{
		$html = "<h1>FS Resultate bearbeiten</h1>
		<h2>$this->vorname $this->nachname</h2>
			
			<p>&nbsp;</p>";
		
		// Formular
		$html .= "<form method='POST'>
				<div class='flex-row form-row'>"
				. _Form::input("Stich 1", "text", "benutzerVerwaltung_stich1", $this->stich1, "personalien1", null, false, true)
				. _Form::input("Stich 2", "text", "benutzerVerwaltung_stich2", $this->stich2, "personalien2", null, true)
				. _Form::input("Stich 3", "text", "benutzerVerwaltung_stich3", $this->stich3, "personalien3", null, true)
				. _Form::input("Nachdoppel 1", "text", "benutzerVerwaltung_nachdoppel1", $this->nachdoppel1, "personalien4", null, true)
				. _Form::input("Nachdoppel 2", "text", "benutzerVerwaltung_nachdoppel2", $this->nachdoppel2, "personalien5", null, true)
				. _Form::input("Tiefschuss Stich 1", "text", "benutzerVerwaltung_fstiefschussStich1", $this->fstiefschussStich1, "personalien6", null, true)
				. _Form::input("Total", "text", "benutzerVerwaltung_fsTotal", $this->fsTotal, "personalien7", null, true)
				. "</div>
				<p>&nbsp;</p>";
		
		
		// Button
		$html .= "<div class='flex-row button-row'>
				<a class='btn btn-default' href='?page=resultatverwaltung'>Zur&uuml;ck</a>"
				. _Form::button("Speichern", "fsresultatVerwaltungSpeichern_" . $this->id, "btn-primary")
				. _Form::button("L&ouml;schen", "fsresultatVerwaltungLoeschen_" . $this->id, "btn-danger")
				. "</div>
				</form>";
		
		return $html;
	}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	


// Werte-Eingabe für die Schrotmeisterschaft

	function html_smErstellen()
	{
		$html = "<h1>SM Resultate erfassen</h1>"
			. "<p>&nbsp;</p>"
			. "<form method='POST'>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Klapphas Schuss 1", "text", "benutzerVerwaltung_smKlapphas1", null, "personalien1", null, false, true)
			. _Form::input("Klapphas Schuss 2", "text", "benutzerVerwaltung_smKlapphas2", null, "personalien2", null, true)
			. _Form::input("Klapphas Schuss 3", "text", "benutzerVerwaltung_smKlapphas3", null, "personalien3", null, true)
			. _Form::input("Klapphas Schuss 4", "text", "benutzerVerwaltung_smKlapphas4", null, "personalien4", null, true)
			. _Form::input("Klapphas Schuss 5", "text", "benutzerVerwaltung_smKlapphas5", null, "personalien5", null, true)
			. _Form::input("Klapphas Schuss 6", "text", "benutzerVerwaltung_smKlapphas6", null, "personalien6", null, true)
			. _Form::input("Klapphas Schuss 7", "text", "benutzerVerwaltung_smKlapphas7", null, "personalien7", null, true)
			. _Form::input("Klapphas Schuss 8", "text", "benutzerVerwaltung_smKlapphas8", null, "personalien8", null, true)
			. _Form::input("Klapphas Schuss 9", "text", "benutzerVerwaltung_smKlapphas9", null, "personalien9", null, true)
			. _Form::input("Klapphas Schuss 10", "text", "benutzerVerwaltung_smKlapphas10", null, "personalien10", null, true)
			. _Form::input("Rollhas Schuss 1", "text", "benutzerVerwaltung_smRollhas1", null, "personalien11", null, true)
			. _Form::input("Rollhas Schuss 2", "text", "benutzerVerwaltung_smRollhas2", null, "personalien12", null, true)
			. _Form::input("Rollhas Schuss 3", "text", "benutzerVerwaltung_smRollhas3", null, "personalien13", null, true)
			. _Form::input("Rollhas Schuss 4", "text", "benutzerVerwaltung_smRollhas4", null, "personalien14", null, true)
			. _Form::input("Rollhas Schuss 5", "text", "benutzerVerwaltung_smRollhas5", null, "personalien15", null, true)
			. _Form::input("Rollhas Schuss 6", "text", "benutzerVerwaltung_smRollhas6", null, "personalien16", null, true)
			. _Form::input("Rollhas Schuss 7", "text", "benutzerVerwaltung_smRollhas7", null, "personalien17", null, true)
			. _Form::input("Rollhas Schuss 8", "text", "benutzerVerwaltung_smRollhas8", null, "personalien18", null, true)
			. _Form::input("Tontaube Schuss 1", "text", "benutzerVerwaltung_smTontaube1", null, "personalien19", null, true)
			. _Form::input("Tontaube Schuss 2", "text", "benutzerVerwaltung_smTontaube2", null, "personalien20", null, true)
			. _Form::input("Tontaube Schuss 3", "text", "benutzerVerwaltung_smTontaube3", null, "personalien21", null, true)
			. _Form::input("Tontaube Schuss 4", "text", "benutzerVerwaltung_smTontaube4", null, "personalien22", null, true)
			. _Form::input("Tontaube Schuss 5", "text", "benutzerVerwaltung_smTontaube5", null, "personalien23", null, true)
			. _Form::input("Punkte Klapphas Total", "text", "benutzerVerwaltung_smKlapphasTotal", null, "personalien24", null, true)
			. _Form::input("Punkte Rollhas Total", "text", "benutzerVerwaltung_smRollhasTotal", null, "personalien25", null, true)
			. _Form::input("Gesamttotal", "text", "benutzerVerwaltung_smTotal", null, "personalien26", null, true)

			. "</div>"
            .  "<div class='flex-row button-row'>
		    <a class='btn btn-default' href='?page=resultatverwaltung'>Abbrechen</a>"
			. _Form::button("Speichern", "smschuetzeVerwaltungSpeichern", "btn-primary")
			. "</div>"
			. "</form>";
		return $html;
    }
    
	// Bearbeitung für die Schrotmeisterschaft 
    function html_smBearbeiten()
	{
		$html = "<h1>SM Resultate bearbeiten</h1>
	
			
			<p>&nbsp;</p>";
		
		// Formular
		$html .= "<form method='POST'>
				<div class='flex-row form-row'>"
				. _Form::input("Klapphas Schuss 1", "text", "benutzerVerwaltung_smKlapphas1", $this->smKlapphas1, "personalien1", null, false, true)
				. _Form::input("Klapphas Schuss 2", "text", "benutzerVerwaltung_smKlapphas2", $this->smKlapphas2, "personalien2", null, true)
				. _Form::input("Klapphas Schuss 3", "text", "benutzerVerwaltung_smKlapphas3", $this->smKlapphas3, "personalien3", null, true)
				. _Form::input("Klapphas Schuss 4", "text", "benutzerVerwaltung_smKlapphas4", $this->smKlapphas4, "personalien4", null, true)
				. _Form::input("Klapphas Schuss 5", "text", "benutzerVerwaltung_smKlapphas5", $this->smKlapphas5, "personalien5", null, true)
				. _Form::input("Klapphas Schuss 6", "text", "benutzerVerwaltung_smKlapphas6", $this->smKlapphas6, "personalien6", null, true)
				. _Form::input("Klapphas Schuss 7", "text", "benutzerVerwaltung_smKlapphas7", $this->smKlapphas7, "personalien7", null, true)
				. _Form::input("Klapphas Schuss 8", "text", "benutzerVerwaltung_smKlapphas8", $this->smKlapphas8, "personalien8", null, true)
				. _Form::input("Klapphas Schuss 9", "text", "benutzerVerwaltung_smKlapphas9", $this->smKlapphas9, "personalien9", null, true)
				. _Form::input("Klapphas Schuss 10", "text", "benutzerVerwaltung_smKlapphas10", $this->smKlapphas10, "personalien10", null, true)
				. _Form::input("Rollhas Schuss 1", "text", "benutzerVerwaltung_smRollhas1", $this->smRollhas1, "personalien11", null, true)
				. _Form::input("Rollhas Schuss 2", "text", "benutzerVerwaltung_smRollhas2", $this->smRollhas2, "personalien12", null, true)
				. _Form::input("Rollhas Schuss 3", "text", "benutzerVerwaltung_smRollhas3", $this->smRollhas3, "personalien13", null, true)
				. _Form::input("Rollhas Schuss 4", "text", "benutzerVerwaltung_smRollhas4", $this->smRollhas4, "personalien14", null, true)
				. _Form::input("Rollhas Schuss 5", "text", "benutzerVerwaltung_smRollhas5", $this->smRollhas5, "personalien15", null, true)
				. _Form::input("Rollhas Schuss 6", "text", "benutzerVerwaltung_smRollhas6", $this->smRollhas6, "personalien16", null, true)
				. _Form::input("Rollhas Schuss 7", "text", "benutzerVerwaltung_smRollhas7", $this->smRollhas7, "personalien17", null, true)
				. _Form::input("Rollhas Schuss 8", "text", "benutzerVerwaltung_smRollhas8", $this->smRollhas8, "personalien18", null, true)
				. _Form::input("Tontaube Schuss 1", "text", "benutzerVerwaltung_smTontaube1", $this->smTontaube1, "personalien19", null, true)
				. _Form::input("Tontaube Schuss 2", "text", "benutzerVerwaltung_smTontaube2", $this->smTontaube2, "personalien20", null, true)
				. _Form::input("Tontaube Schuss 3", "text", "benutzerVerwaltung_smTontaube3", $this->smTontaube3, "personalien21", null, true)
				. _Form::input("Tontaube Schuss 4", "text", "benutzerVerwaltung_smTontaube4", $this->smTontaube4, "personalien22", null, true)
				. _Form::input("Tontaube Schuss 5", "text", "benutzerVerwaltung_smTontaube5", $this->smTontaube5, "personalien23", null, true)
				. _Form::input("Punkte Klapphas Total", "text", "benutzerVerwaltung_smKlapphasTotal", $this->smKlapphasTotal, "personalien24", null, true)
				. _Form::input("Punkte Rollhas Total", "text", "benutzerVerwaltung_smRollhasTotal", $this->smRollhasTotal, "personalien25", null, true)
				. _Form::input("Gesamttotal", "text", "benutzerVerwaltung_smTotal", $this->smTotal, "personalien26", null, true)
				. "</div>
				<p>&nbsp;</p>";

		
		// Button
		$html .= "<div class='flex-row button-row'>
				<a class='btn btn-default' href='?page=resultatverwaltung'>Zur&uuml;ck</a>"
				. _Form::button("Speichern", "resultatVerwaltungSpeichern_" . $this->id, "btn-primary")
				. _Form::button("L&ouml;schen", "smresultatVerwaltungLoeschen_" . $this->id, "btn-danger")
				. "</div>
				</form>";
		
		return $html;
	}

}
?>