

function addScripts()
{
	addTagAuswaehlen();
	addWocheAuswaehlen();
	
	// bei Scrollen
	window.addEventListener("scroll", function(){
		fixButtons();
	});
}

function addTagAuswaehlen()
{
	var buttons = document.querySelectorAll('.tag .tag1.editable');
	for (var i=0; i<buttons.length; i++) { tagAuswaehlen(buttons[i]); }
}

function addWocheAuswaehlen()
{
	var buttons = document.querySelectorAll('.tag .tag0.editable');
	for (var i=0; i<buttons.length; i++) { wocheAuswaehlen(buttons[i]); }
}

function fixButtons()
{
	var buttons = document.querySelector('.fixedbuttons');
	if (buttons) {
		if (buttons.nextElementSibling.getBoundingClientRect().top < 140) {
			buttons.classList.add("fixedbuttonsActive");
		}
		else {
			buttons.classList.remove("fixedbuttonsActive");
		}
	}
}

function tagAuswaehlen(button)
{
	button.style.cursor = "pointer";
	
	var day;
	
	for (var i=0; i<button.classList.length; i++) {
		if (button.classList[i].substring(0,3) == "day") day = button.classList[i];
	}
	
	var checkable = document.querySelectorAll('.' + day + ' input');
	
	button.onclick = function() { 
		
		var allIsChecked = true;
		
		for (var i=0; i<checkable.length; i++) {
			if (!checkable[i].checked) { allIsChecked = false; break; }
		}
		
		if (allIsChecked)
			for (var i=0; i<checkable.length; i++) { checkboxNichtAuswaehlen(checkable[i]); }
		else
			for (var i=0; i<checkable.length; i++) { checkboxAuswaehlen(checkable[i]); }
	};
}

function wocheAuswaehlen(button)
{
	button.style.cursor = "pointer";
	
	var week;
	
	for (var i=0; i<button.classList.length; i++) {
		if (button.classList[i].substring(0,4) == "week") week = button.classList[i];
	}
	
	var checkable = document.querySelectorAll('.' + week + '.nichtwochenende input');
	
	button.onclick = function() { 
		
		var allIsChecked = true;
		
		for (var i=0; i<checkable.length; i++) {
			if (!checkable[i].checked) { allIsChecked = false; break; }
		}
		
		if (allIsChecked)
			for (var i=0; i<checkable.length; i++) { checkboxNichtAuswaehlen(checkable[i]); }
		else
			for (var i=0; i<checkable.length; i++) { checkboxAuswaehlen(checkable[i]); }
	};
}

function checkboxAuswaehlen(checkbox)
{
	checkbox.checked = true;
}

function checkboxNichtAuswaehlen(checkbox)
{
	checkbox.checked = false;
}

function showConfirmation(id)
{
	var confirmation = document.getElementById(id);
	confirmation.style.display = "inline";
}

function hideConfirmation(id)
{
	var confirmation = document.getElementById(id);
	confirmation.style.display = "none";
}

function closeFehler()
{
	var fehler = document.querySelector('div.meldung-fehler');
	fehler.style.display = "none";
}

function closeHinweis()
{
	var hinweis = document.querySelector('div.meldung-hinweis');
	hinweis.style.display = "none";
}





