<?php
    $datiRicevuti = file_get_contents('php://input');
    $input = json_decode($datiRicevuti, TRUE);
	session_start();
	session_destroy();
	setcookie('mailUtente', null, -1, '/'); 
	setcookie('pswUtente', null, -1, '/'); 
	
?>