<?php

class _Form
{
	/**
	 * 
	 */
	static function execute()
	{
		if (isset($_POST['button'])) {
			
			switch ($_POST['button'][0]) {
				
				case "taetigkeitSpeichern" :
				case "absenzSpeichern" :
				case "kommentarSpeichern" :
				case "kommentarLoeschen" :
					$monat = new Monat($_SESSION['page'][2], $_SESSION['page'][1]);
					try {
						$monat->speichern();
					} catch (Exception $e) {
						_Meldung::set_hinweis($e->getMessage());
						break;
					}
					_Meldung::$feedback = 1;
					break;
					
				case "absenzSignieren" :
				case "absenzAblehnen" :
					Absenz::bearbeiten();
					break;
					
				case "rapportSignieren" :
					$rapport = new Rapport($_SESSION['page'][2], $_SESSION['page'][1], $_POST['button'][1]);
					try {
						$rapport->signieren();
					} catch (Exception $e) {
						_Meldung::set_fehler($e->getMessage());
					}
					break;
					
				case "rapportAblehnen" :
					$rapport = new Rapport($_SESSION['page'][2], $_SESSION['page'][1], $_POST['button'][1]);
					$rapport->ablehnen();
					break;
					
				case "rapportBearbeiten" :
					$rapport = new Rapport($_SESSION['page'][2], $_SESSION['page'][1], $_POST['button'][1]);
					$rapport->bearbeiten();
					break;
					
				case "rapportSperren" :
					Rapport::sperren();
					break;
					
				case "rapportExcelOeffnen" :
					$rapport = new Rapport($_POST['button'][1], $_POST['button'][2], $_POST['button'][3]);
					try {
						$rapport->rechnungsdatenSpeichern();
					} catch (Exception $e) {
						_Meldung::set_fehler($e->getMessage());
					}
					$filter = array($_POST['button'][1], $_POST['button'][2], $_POST['button'][3]);
					$datei = new Datei("verbundfirmen", $filter);
					$datei->open();
					break;
					
				case "lehrlingVerwaltungSpeichern" :
					// Lehrling erstellen
					$id = null;
					
					// Lehrling bearbeiten
					if (isset($_POST['button'][1])) $id = $_POST['button'][1];
					
					$lehrling = new Lehrling($id);
					try {
						$lehrling->speichern();
					} catch (Exception $e) {
						_Meldung::set_fehler($e->getMessage());
						$_SESSION['page'] = array("lehrlingverwaltung", "neu");
						if ($id) $_SESSION['page'] = array("lehrlingverwaltung", "bearbeiten", $id);
						break;
					}
					_Meldung::$feedback = 1;
					if ($id) $_SESSION['page'] = array("lehrlingverwaltung", "bearbeiten", $id);
					
			


					if ($id == null) $_SESSION['page'] = array("lehrlingverwaltung", "bearbeiten", $lehrling->get_property("id"));
					
					break;


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


				// Schützenverwaltung

				case "schuetzeVerwaltungSpeichern" :
					$id = null;
						
					if (isset($_POST['button'][1])) $id = $_POST['button'][1];
						
					$schuetze = new Schuetze($id);
					try {
						$schuetze->speichern();
					} catch (Exception $e) {
						_Meldung::set_fehler($e->getMessage());
						$_SESSION['page'] = array("schuetzenverwaltung");
						if ($id) $_SESSION['page'] = array("schuetzenverwaltung", $id);
						break;
					}
					_Meldung::$feedback = 1;
					if ($id) $_SESSION['page'] = array("schuetzenverwaltung", $id);
					if ($id == null) $_SESSION['page'] = array("schuetzenverwaltung", $schuetze->get_property("id"));
						
					break;

				case "schuetzeVerwaltungLoeschen" :
						_Schuetze::loeschen();
						_Meldung::$feedback = 1;
						$_SESSION['page'] = array("schuetzenverwaltung");
						break;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


				// Anlassverwaltung
				case "anlassverwaltungSpeichern" :
						$id = null;
							
						if (isset($_POST['button'][1])) $id = $_POST['button'][1];
							
						$anlass = new Anlass($id);
						try {
							$anlass->speichern();
						} catch (Exception $e) {
							_Meldung::set_fehler($e->getMessage());
							$_SESSION['page'] = array("anlassverwaltung");
							if ($id) $_SESSION['page'] = array("anlassverwaltung", $id);
							break;
						}
						_Meldung::$feedback = 1;
						if ($id) $_SESSION['page'] = array("anlassverwaltung", $id);
						if ($id == null) $_SESSION['page'] = array("anlassverwaltung", $anlass->get_property("id"));
							
						break;	

				case "anlassVerwaltungLoeschen" :
						_Anlass::loeschen();
						_Meldung::$feedback = 1;
						$_SESSION['page'] = array("anlassverwaltung");
						break;			
			

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


				// Resultatverwaltung


				// Vereinsmeisterschaft Verwaltung
				case "vmresultatverwaltungSpeichern" :
						$id = null;
							
						if (isset($_POST['button'][1])) $id = $_POST['button'][1];
							
						$anlass = new Resultat($id);
						try {
							$anlass->vmspeichern();
						} catch (Exception $e) {
							 // _Meldung::set_fehler($e->getMessage());
							$_SESSION['page'] = array("resultatverwaltung");
							if ($id) $_SESSION['page'] = array("resultatverwaltung", $id);
							break;
						}
						_Meldung::$feedback = 1;
						if ($id) $_SESSION['page'] = array("resultatverwaltung", $id);
						if ($id == null) $_SESSION['page'] = array("resultatverwaltung", $resultate->get_property("id"));
							
						break;	

				case "vmresultatVerwaltungLoeschen" :
						_Anlass::loeschen();
						_Meldung::$feedback = 1;
						$_SESSION['page'] = array("resultatverwaltung");
						break;


				// Fuchsstich Verwaltung
				case "fsresultatverwaltungSpeichern" :
						$id = null;
							
						if (isset($_POST['button'][1])) $id = $_POST['button'][1];
							
						$anlass = new Resultat($id);
						try {
							$anlass->fsspeichern();
						} catch (Exception $e) {
							_Meldung::set_fehler($e->getMessage());
							$_SESSION['page'] = array("resultatverwaltung");
							if ($id) $_SESSION['page'] = array("resultatverwaltung", $id);
							break;
						}
						_Meldung::$feedback = 1;
						if ($id) $_SESSION['page'] = array("resultatverwaltung", $id);
						if ($id == null) $_SESSION['page'] = array("resultatverwaltung", $resultate->get_property("id"));
							
						break;	

				case "fsresultatVerwaltungLoeschen" :
						_Anlass::loeschen();
						_Meldung::$feedback = 1;
						$_SESSION['page'] = array("anlassverwaltung");
						break;




				// Schrotmeisterschaft Verwaltung
				case "smresultatverwaltungSpeichern" :
						$id = null;
							
						if (isset($_POST['button'][1])) $id = $_POST['button'][1];
							
						$anlass = new Resultat($id);
						try {
							$anlass->smspeichern();
						} catch (Exception $e) {
							_Meldung::set_fehler($e->getMessage());
							$_SESSION['page'] = array("resultatverwaltung");
							if ($id) $_SESSION['page'] = array("resultatverwaltung", $id);
							break;
						}
						_Meldung::$feedback = 1;
						if ($id) $_SESSION['page'] = array("resultatverwaltung", $id);
						if ($id == null) $_SESSION['page'] = array("resultatverwaltung", $resultate->get_property("id"));
							
						break;	

				case "smresultatVerwaltungLoeschen" :
						_Anlass::loeschen();
						_Meldung::$feedback = 1;
						$_SESSION['page'] = array("anlassverwaltung");
						break;


				// Resultat Verwaltung Suchen
				case "resultatVerwaltungSuchen" :
						 _Resultate::suchen();
						 _Meldung::$feedback = 1;
						 break;

						


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

						
				case "praxisbildnerVerwaltungSpeichern" :
					$id = null;
					
					if (isset($_POST['button'][1])) $id = $_POST['button'][1];
					
					$praxisbildner = new Praxisbildner($id);
					try {
						$praxisbildner->speichern();
					} catch (Exception $e) {
						_Meldung::set_fehler($e->getMessage());
						$_SESSION['page'] = array("praxisbildnerverwaltung", "neu");
						if ($id) $_SESSION['page'] = array("praxisbildnerverwaltung", "bearbeiten", $id);
						break;
					}
					_Meldung::$feedback = 1;
					if ($id) $_SESSION['page'] = array("praxisbildnerverwaltung", "bearbeiten", $id);
					else $_SESSION['page'] = array("praxisbildnerverwaltung", "bearbeiten", $praxisbildner->get_property("id"));
					
					break;
				
				case "praxisbetriebSpeichern" :
					
					$praxisbildner = new Praxisbildner($_POST['button'][1]);
					$praxisbildner->praxisbetriebSpeichern();
					$_SESSION['page'] = array("praxisbildnerverwaltung", "bearbeiten", $_POST['button'][1]);
					break;
					
				case "praxiseinsatzSpeichern" :
					try {
						_Praxiseinsatz::speichern();
					} catch (Exception $e) {
						_Meldung::set_fehler($e->getMessage());
						$_SESSION['page'] = array("lehrlingverwaltung", "praxisbildner", $_SESSION['page'][2], "neu");
						break;
					}
					_Meldung::$feedback = 1;
					$_SESSION['page'] = array("lehrlingverwaltung", "praxisbildner", $_SESSION['page'][2]);
					break;
				
				case "praxiseinsatzUpdaten" :
					try {
						_Praxiseinsatz::updaten();
					} catch (Exception $e) {
						_Meldung::set_fehler($e->getMessage());
						break;
					}
					_Meldung::$feedback = 1;
					$_SESSION['page'] = array("lehrlingverwaltung", "praxisbildner", $_SESSION['page'][2]);
					break;
					
				case "praxiseinsatzLoeschen" :
					_Praxiseinsatz::loeschen();
					$_SESSION['page'] = array("lehrlingverwaltung", "praxisbildner", $_SESSION['page'][2]);
					break;
					
				case "praxisbetriebVerwaltungSpeichern" :
					try {
						_Praxisbetrieb::speichern();
					} catch (Exception $e) {
						_Meldung::set_fehler($e->getMessage());
						break;
					}
					_Meldung::$feedback = 1;
					$_SESSION['page'] = array("praxisbetriebe");
					break;
					
				case "schulferienSpeichern" :
					try {
						_Schulferien::speichern();
					} catch (Exception $e) {
						_Meldung::set_fehler($e->getMessage());
						break;
					}
					_Meldung::$feedback = 1;
					$_SESSION['page'] = array("schulferien");
					break;
					
				case "schulferienAendern" :
					_Schulferien::aendern();
					_Meldung::$feedback = 1;
					$_SESSION['page'] = array("schulferien");
					break;
					
				case "schulferienLoeschen" :
					_Schulferien::loeschen();
					$_SESSION['page'] = array("schulferien");
					break;
					
				case "statistikOeffnen" :
					
					$zeitraum = array(_Form::datepickerToIso($_POST['statistik_von']), _Form::datepickerToIso($_POST['statistik_bis']));
					$kostenstelle = null;
					if (isset($_POST['button'][1]) && $_POST['button'][1] == "kostenstelle") $kostenstelle = $_POST['statistik_kostenstelle'];
					$lehrgang = null;
					if (isset($_POST['button'][1]) && $_POST['button'][1] == "lehrgang") $lehrgang = $_POST['statistik_lehrgang'];
					
					$filter = array($zeitraum, $_POST['statistik_lehrjahr'], $kostenstelle, $lehrgang);
					
					$datei = new Datei("buchhaltung", $filter);
					$datei->open();
					break;
				
			}
		}
	}
	
	static function splitButtonValues()
	{
		if (isset($_POST['button'])) {
			
			$value = $_POST['button'];
			
			$_POST['button'] = array();
			
			if (strpos($value, "_") !== false) $_POST['button'] = explode("_", $value);
			else $_POST['button'][] = $value;
		}
	}
	
	static function datepickerToIso($date)
	{
		$date = explode(".", $date);
		if (count($date) == 3) return "$date[2]-$date[1]-$date[0]";
		return false;
	}
	
	static function input($label, $type, $name, $value = null, $class = "", $placeholder = null, $required = false, $autofocus = false)
	{
		$html = "<div class='form-group $class' >";
		if ($label != null) {
			$html .= "<label for='$name' >$label</label>";
		}
		if ($type == "static") {
			$html .= "<p class='form-control-static'>$value</p>";
		}
		else {
			if ($type == "datepicker") {
				$html .= "<input class='form-control datepicker' type='text' id='$name' name='$name' ";
			}
			elseif ($type == "monthpicker") {
				$html .= "<input class='form-control datepicker' data-date-min-view-mode='months' type='text' id='$name' name='$name' ";
			}
			else {
				$html .= "<input class='form-control' type='$type' id='$name' name='$name' ";
			}
			
			if ($value != null) {
				$html .= "value='$value' ";
			}
			if ($type == "text") {
				$html .= "maxlength='100' ";
			}
			if ($placeholder != null) {
				$html .= "placeholder='$placeholder' ";
			}
			if ($type == "datepicker" || $type == "monthpicker") {
				$html .= "readonly ";
			}
			if ($required) {
				$html .= "required ";
			}
			if ($autofocus) {
				$html .= "autofocus ";
			}
			$html .= ">";
		}
		$html .= "</div>";
		return $html;
	}
	
	static function checkbox($label, $name, $value, $class = "", $checked = false)
	{
		$html = "<div class='form-group $class' >";
		$html .= "<div class='checkbox flex-column'><label class='flex-row'><div class='flex-row center center2'><input class='checkbox' type='checkbox' id='' name='$name' value='$value' ";
		if ($checked) {
			$html .= "checked ";
		}
		$html .= "></div>";
		$html .= $label;
		$html .= "</label></div>";
		$html .= "</div>";
		return $html;
	}
	
	static function select($label, $name, $options, $value = null, $class = "")
	{
		$html = "<div class='form-group $class' >";
		if ($label != null) $html .= "<label for='$name' >$label</label>";
		$html .= "<select class='form-control' id='$name' name='$name' >";
		$group = "";
		foreach ($options as $option) {
			if (isset($option[2])) {
				if ($option[2] != $group) {
					if ($group != "") $html .= "</optgroup>";
					$html .= "<optgroup label='$option[2]'>";
				}
				$group = $option[2];
			}
			$html .= "<option value='$option[0]' ";
			if ($value != null && $option[0] == $value) $html .= "selected ";
			$html .= ">$option[1]</option>";
		}
		if ($group != "") $html .= "</optgroup>";
		$html .= "</select>";
		$html .= "</div>";
		return $html;
	}
	
	static function button($title, $value, $class = "", $disabled = false)
	{
		$html = "<div><button class='btn $class' name='button' type='submit' ";
		if (!$disabled) {
			$html .= "value='$value'";
		}
		else {
			$html .= "disabled='disabled'";
		}
		$html .= ">$title</button></div>";
		return $html;
	}
	
	static function html_login()
	{
		$html = "<div class='container'>"
			. "<form class='form-signin' method='POST' >"
			. "<img src='styles/images/logo.jpg'>"
			. _Form::input(null, "text", "authentication_email", null, "", "Benutzername", true, true)
			. _Form::input(null, "password", "authentication_password", null, "", "Passwort", true)
			. _Form::button("Anmelden", "login", "btn-primary btn-block", false)
			. "</form>"
			. "</div>";
		return $html;
	}
	
}

?>