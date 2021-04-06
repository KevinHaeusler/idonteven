<?php

class _Authentication
{
	static function authenticate()
	{	
		// Login
		if (isset($_POST['button'])) {
			if ($_POST['button'][0] == "login") self::login();
		
		}
		
		// Logout
		else if ($_SESSION['page'][0] == "logout") {
			self::logout();		}
		
		// Falls nicht eingeloggt : Login-Formular
		if (!isset($_SESSION['id'])) {
			
			$head = _Content::html_head(WEB_SEITENTITEL, "signin.css");
			$login = _Form::html_login();
			
			echo "<!DOCTYPE html>
				<html lang='de'>
					$head
					<body>
						$login
						<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
						<script src='software/bootstrap-3.3.7-dist/js/bootstrap.min.js'></script>
					</body>
				</html>";
			exit();
		}
	}
	
	static function login()
	{
		// Benutzer-id der E-Mail herauslesen
		if (isset($_POST['authentication_email']) && isset($_POST['authentication_password'])) {
			$sql = "SELECT id FROM benutzer WHERE email = ?;";
			$vars = array();
			$vars[] = array("s", $_POST['authentication_email']);
			$result = _Database::query($sql, $vars);
			
			// Falls Benutzer existiert password_hash herauslesen
			if (_Database::$result_num_rows) {
				$id = $result[0]->id;
				$sql = "SELECT password_hash FROM benutzer WHERE id = $id;";
				$result = _Database::query($sql);
				
				// Falls Passwort dem password_hash entspricht -> $_SESSION['id'] schreiben
				$password_hash = $result[0]->password_hash;
				if (password_verify($_POST['authentication_password'], $password_hash)) {
					$_SESSION['id'] = $id;
				}
			}
		}
	}

	static function logout()
	{
		session_unset();
		session_destroy();
		setcookie(session_name(), "cookie loeschen", 0, "/");
	}
	
}

?>