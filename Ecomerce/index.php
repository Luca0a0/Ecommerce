<?php session_start();?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>eCommerce</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./style/index.css">
        <link rel="icon" type="image/x-icon" href="./media/favicon.ico">

        <script src="./js/jquery.min.js"></script>
        <script src="./js/script.js" defer></script>


    </head>
    <body>
	
        <!-- top -->
        <div class="header">
            <div class="flexWrapper">
				<div class="loggedFields">
					<p class="welcomeString">
					
					</p>
				</div>
				<button class="logout" style="display:none;" onclick="logoutHandler()">logout</button>
				<div class="buttonFields">
					<button class="loginButton" onclick="apriLogin()">login</button>
					<button class="registerButton" onclick="apriRegistrazione()">register</button>
				</div>
                <img src="./media/cart.svg" usemap="#cart" id="carrelloImg" >
                <map name="cart">
                    <area shape="rect" coords="0,0,200,140" onclick="apriCarrello()">
                </map>
            </div>
        </div>

        <!-- pagina generale -->
        <div class="mainPage">
            <!-- intestazione -->
            <div class="searchDiv">
                <div class="titleContainer"></div>
                <div class="searchBarContainer"></div>
            </div>
			<div class="cartDiv">
			</div>
            
            <!-- lista prodotti/login-->
            <!-- lista prodotti/login-->
            <div class="contentDiv">
                <div class="productManagement">
                    
                </div>

                <div class="userManagement">
                    <!-- registrazione -->
                    <div class="registerDiv">
                        <div class="formWrapper">
                            <div class="userFields">
                                nome
                                <input type="text" name="userName" id="userName" class="datiUtenteReg">
                            </div>

                            <div class="userFields">
                                cognome
                                <input type="text" id="userSurname" class="datiUtenteReg">
                            </div>

                            <div class="userFields">
                                email
                                <input type="text" id="userEmail" class="datiUtenteReg">
                            </div>

                            <div class="userFields">
                                tel.
                                <input type="text" id="userTel" class="datiUtenteReg">
                            </div>

                            <div class="userFields">
                                partita iva
                                <input type="text" id="userPartIVA" class="datiUtenteReg">
                            </div>

                            <div class="userFields">
                                password
                                <input type="password" id="userPw" class="datiUtenteReg">
                            </div>

                            <div class="userFields">
                                città
                                <input type="text" id="userCity" class="datiUtenteReg">
                            </div>

                            <div class="userFields">
                                cap
                                <input type="text" id="userCap" class="datiUtenteReg">
                            </div>

                            <div class="userFields">
                                ind. fatturazione
                                <input type="text" id="userInd" class="datiUtenteReg">
                            </div>

                            <div class="userFields">
                                cod. fiscale
                                <input type="text" id="userCf" class="datiUtenteReg">
                            </div>

                            <div class="userFields">
                                <!-- invio -->
                                <input type="button" value="conferma" onclick="confermaRegistrazione()" class="btn" id="submit-btn" >
                            </div>
                        </div>
                    </div>
    
                    <!-- accesso -->
                    <div class="loginDiv">
						<div class="formWrapper">
							<div class="userFields">
                                email
                                <input type="text" id="userEmailL" class="datiUtenteLog">
                            </div>
							<div class="userFields">
                                password
                                <input type="password" id="userPwL" class="datiUtenteLog">
                            </div>
							<div class="userFields">
                                <!-- invio -->
                                <input type="button" value="conferma" class="btn" id="submit-btn-login" >
                            </div>
						</div>
                    </div>
					
                </div>
            </div>
        </div>
		       
    </body>
	
</html>
<?php
	
    $myfile = fopen("test.txt", "w");
    
    
	require("./db/conn.php");
		if(!empty($_COOKIE["mailUtente"]) && !empty($_COOKIE["pswUtente"])){
			
			fwrite($myfile,"e volevi".$_COOKIE["mailUtente"]." ".$_COOKIE["pswUtente"]."\n");
			$miaquery="SELECT * FROM UTENTI WHERE email='".$_COOKIE["mailUtente"]."' and password_utente='".$_COOKIE["pswUtente"]."'";
			$result = $conn->query($miaquery);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				
				echo '<script>
					let loggedFields = document.querySelector(".loggedFields");
					let buttonFields = document.querySelector(".buttonFields");
					let userManagement = document.querySelector(".userManagement");
					let logout = document.querySelector(".logout");
					let loginDiv = document.querySelector(".loginDiv");
					
					let textParagraph = loggedFields.firstChild;
					
					statoLogin = false;
					
					buttonFields.style.display = "none";
					userManagement.style.display = "none";
					loggedFields.style.display = "flex";
					loginDiv.classList.remove("active");
					
					textParagraph.textContent = `Ciao, '.$row["nome"].' '.$row["cognome"].'`;
					logout.style.display="flex";
					</script>';
			}
		}
		else {
			consoleLog("aborto");
		}
	$conn->close();
	?>