<?php
    //importo il file di connessione al db
  	require("../db/conn.php");
	$myfile = fopen("testLog.txt", "w");
    $datiRicevuti = file_get_contents('php://input');
    $input = json_decode($datiRicevuti, TRUE);
	session_start();

    //verifico la connessione
    if($conn != null) {
	   fwrite($myfile, "connesso DB\n");
	   $mailLogin=$input["userEmailL"];
	   $password_arrivata=$input["userPwL"];
	   $miaquery="SELECT * FROM UTENTI WHERE email='".$mailLogin."' and password_utente='".$password_arrivata."'";
	   fwrite($myfile,$miaquery."\n");
	   
	   $result = $conn->query($miaquery);
	   if ($result->num_rows > 0) {
		    $row = $result->fetch_assoc();
		    fwrite($myfile,$row["nome"]. "\n");
			
			setcookie("mailUtente", $mailLogin, time() + (86400 * 30), "/"); 
			setcookie("pswUtente", $password_arrivata, time() + (86400 * 30), "/");

			//$_SESSION["mailUtente"] =  $mailLogin;
			//$_SESSION["pswUtente"] = $password_arrivata;
			
			$risultatoData = [
				"stato" => "successo",
				"data" => $row
			];
			
			//fwrite($myfile,$risultatoData);
			
			echo(json_encode($risultatoData));
	   }
	   else{
		$risultatoData = [
			"stato" => "errore",
			"data" => "Errore utente non registrato"
		];
		echo (json_encode($risultatoData));
	   }
	   
    //printf("%s (%s)\n", $row[0], $row[1]);	   
    //$miaPwd=$result->fetch_assoc()); $row = $result->fetch_assoc();
	//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		//fwrite($myfile,$_SESSION["mailUtente"]." ".$_SESSION["pswUtente"]."/".$_COOKIE[$mailLogin]."\n");
	} 
    $conn->close();
?>