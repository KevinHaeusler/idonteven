<?php

class _Meldung
{

	static private $confirmation = array();
	static public $fehler = array();
	static public $hinweis = array();
	static public $feedback = 0;
	
	
	static function set_confirmation($string)
	{
		self::$confirmation[] = $string;
	}
	
	 static function set_fehler($message)
	 {
		self::$fehler[] = $message;
	}
	
	 static function set_hinweis($message)
	 {
		self::$hinweis[] = $message;
	 }
	
	static function get_confirmations()
	{
		$html = "";
		foreach (self::$confirmation as $confirmation){
			$html .= $confirmation;
		}
		
		return $html;
	}
	
	static function get_messages()
	{
		$html = "";
		
		// Fehlermeldungen
		if (!empty(self::$fehler)) {
			
			$html .= "<div class='meldung-fehler'><div class='title'><h3>Achtung</h3></div><ul class='list-unstyled'>";
				
			foreach (self::$fehler as $message) {
				$html .= "<li>$message</li>";
			}
			$html .= "</ul>
					<div class='flex-row flex-end button-row'><button class='btn btn-default' onclick='closeFehler()'>OK</button></div>
					</div>";
		}
		
		// Hinweise
		if (!empty(self::$hinweis)) {
			
			$html .= "<div class='meldung-hinweis'><div class='title'><h3>Hinweis</h3></div><ul class='list-unstyled'>";
				
			foreach (self::$hinweis as $message) {
				$html .= "<li>$message</li>";
			}
			$html .= "</ul>
					<div class='flex-row flex-end button-row'><button class='btn btn-default' onclick='closeHinweis()'>OK</button></div>
					</div>";
		}
		
		return $html;
	}
	
}

?>