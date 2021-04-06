if (isset($_POST["resultatverwaltung_schuetze"]))
						{
						$select1 = $_POST['resultatverwaltung_schuetze']; 
						echo $select1;
						echo " is your username";
						} 
						else 
						{
						$select1 = null;
						echo "no username supplied";
				}