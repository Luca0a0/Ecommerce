<?php
    include_once("../db/conn.php");     //importo il file di connessione al db
	
	session_start();
	
    $datiRicevuti = file_get_contents('php://input');
    $input = json_decode($datiRicevuti, TRUE);
	if($input['userEmail']!= NULL){
		if($conn != null) {    //verifico la connessione
			$myfile = fopen("testReg.txt", "w");
			consoleLog("Db connesso");
			$query = "INSERT INTO utenti (email, cognome, nome, tel, partita_iva, password_utente, citta, cf, cap, ind_fatturazione)";
			$query =  $query . " VALUES (
				\"{$input['userEmail']}\", 
				\"{$input['userSurname']}\",
				\"{$input['userName']}\",
				\"{$input['userTel']}\",
				\"{$input['userPartIVA']}\",
				\"{$input['userPw']}\",
				\"{$input['userCity']}\",
				\"{$input['userCf']}\",
				\"{$input['userCap']}\",
				\"{$input['userInd']}\"
			);"; 
			if (mysqli_query($conn, $query)) {
			} else {
				$_SESSION["SError"]="Error";
				//echo "Error: " . "<br>" . mysqli_error($conn);
			}
		}
	}
	else {
		$_SESSION["SError"]="Error";
		//echo "Error: " . "<br>" . mysqli_error($conn);
	}


?>