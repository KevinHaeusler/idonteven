<?php

class _Statistik
{
	static function html_statistikAuswerten()
	{
		$value_monat = strftime("01.%m.%Y", strtotime("-1 month"));
		
		$html = "<h1>Statistik auswerten</h1>
				<p>&nbsp;</p>
				<form method='POST' class='statistik'>
				<h3>Zeitraum w&auml;hlen</h3>
				<div class='flex-row form-row form'>"
				. _Form::input("Monat von", "monthpicker", "statistik_von", $value_monat)
				. _Form::input("Monat bis", "monthpicker", "statistik_bis", $value_monat)
				. "</div>
				<h3>Lehrjahre w&auml;hlen</h3>"
				. _Form::checkbox("1. Lehrjahr", "statistik_lehrjahr[]", 1, "", true)
				. _Form::checkbox("2. Lehrjahr", "statistik_lehrjahr[]", 2, "", true)
				. _Form::checkbox("3. Lehrjahr", "statistik_lehrjahr[]", 3, "", true)
				. _Form::checkbox("4. Lehrjahr", "statistik_lehrjahr[]", 4, "", true)
				. _Form::button("<span class='glyphicon glyphicon-download-alt'></span> Statistik &ouml;ffnen", "statistikOeffnen", "btn-primary")
				. "<p>&nbsp;</p>
				<div class='flex-row'>
				<div class='kostenstellen'><h3>Mit Kostenstellen auswerten</h3>";
		
		foreach (_Lehrgang::get_kostenstellen() as $kostenstelle) {
			$html .= _Form::checkbox($kostenstelle[1], "statistik_kostenstelle[]", $kostenstelle[0]);
		}
		
		$html .= _Form::button("<span class='glyphicon glyphicon-download-alt'></span> Kostenstellen &ouml;ffnen", "statistikOeffnen_kostenstelle", "btn-primary")
			. "<p>&nbsp;</p></div>
			<div class='lehrgaenge'><h3>Mit Lehrg&auml;ngen auswerten</h3>";
		
		foreach (_Lehrgang::get_lehrgaenge() as $lehrgang) {
			$html .= _Form::checkbox($lehrgang[1], "statistik_lehrgang[]", $lehrgang[0]);
		}
		
		$html .= _Form::button("<span class='glyphicon glyphicon-download-alt'></span> Lehrg&auml;nge &ouml;ffnen", "statistikOeffnen_lehrgang", "btn-primary")
			."<p>&nbsp;</p></div>
			</div>
			</form>";
		
		return $html;
	}
	
}

?>
