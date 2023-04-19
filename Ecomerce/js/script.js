let campiRegistrazione;
let statoLogin;
let statoRegister = false;
if(document.cookie.split(';')[1] == undefined){
	statoLogin = false;
}
else {
	statoLogin = true;
}
//console.log(statoLogin);
//console.log(document.cookie);


function controllaDati(classi) {
	let campiJson = {};
    //verifica dei dati
    campiRegistrazione = document.querySelectorAll(classi);
    /* console.log(campiRegistrazione); */

    let controlloOK = true;
    for (let index = 0; index < campiRegistrazione.length; index++) {
        if (!campiRegistrazione[index].value) {
            //campiRegistrazione[index].value != ""
            return 'error';
            /* console.log(controlloOK); */
        }

        //accoppiamento key - value
        campiJson[campiRegistrazione[index].id] =
            campiRegistrazione[index].value;
    }

    return campiJson;
}

	
document
    .getElementById("submit-btn-login")
    .addEventListener("click", confermaLogin);


	$.ajax({
		url: "./ajaxScripts/prodotti.php",
		type: "GET",
		contentType: "charset=utf-8",
		success: function (response){
			let prodotti = document.querySelector(".productManagement");
			prodotti.innerHTML=response;
			//console.log(prodotti);
		},
		error: function () {
			alert("errore"); 
			
		},
	});


function apriRegistrazione() {
	let registerDiv = document.querySelector(".registerDiv");
	let loginDiv = document.querySelector(".loginDiv");
	//let cartDiv = document.querySelector(".cartDiv");
	let prodotti = document.querySelector(".productManagement");
	
	console.log("entrato reg");
	
	if (!statoRegister) {		
		registerDiv.classList.add("active");
		prodotti.classList.add("notActive");
		loginDiv.classList.remove("active");
		statoRegister = true;
		statoLogin = false;
	}
	else {
		registerDiv.classList.remove("active");
		prodotti.classList.remove("notActive");
		statoRegister = false;
	}
}

function apriLogin() {
	let loginDiv = document.querySelector(".loginDiv");
	let registerDiv = document.querySelector(".registerDiv");
	//let cartDiv = document.querySelector(".cartDiv");
	let prodotti = document.querySelector(".productManagement");
	
	console.log("entrato login");
	
	if (!statoLogin) {		
		loginDiv.classList.add("active");
		prodotti.classList.add("notActive");
		registerDiv.classList.remove("active");
		statoLogin = true;
		statoRegister = false;
	}
	else {
		loginDiv.classList.remove("active");
		prodotti.classList.remove("notActive");
		statoLogin = false;
	}
}

function apriCarrello(){
	let registerDiv = document.querySelector(".registerDiv");
	let loginDiv = document.querySelector(".loginDiv");
	let prodottoDiv =document.querySelector(".productManagement");
	
	if(loginDiv.classList.contains("Active")){
		loginDiv.classList.remove("active");
		if(statoLogin = true){
			statoLogin = false;
		}
    }
	else if(registerDiv.classList.contains("Active")){
		
		registerDiv.classList.remove("active");
		if(statoRegister = true){
			statoRegister = false;
		}
	}
	
	prodottoDiv.classList.remove("notActive");

	$.ajax({
		url: "./ajaxScripts/openCart.php",
		type: "post",
		contentType: "charset=utf-8",
		success: function (response){
			let prodotti = document.querySelector(".productManagement");
			prodotti.innerHTML=response;
			//console.log(prodotti);
		},
		error: function () {
			alert("errore"); 
			
		},
	});
}

function aggCart(intero){
	$.ajax({
		url: "./ajaxScripts/aggCart.php",
		type: "post",
		data: JSON.stringify(intero),
		contentType: "application/json charset=utf-8",
		success: function (response){
			let prodotti = document.querySelector(".productManagement");
			prodotti.innerHTML=response;
			//console.log(prodotti);
		},
		error: function () {
			alert("errore"); 
			
		},
	});
	
}

function remCart(intero){
	$.ajax({
		url: "./ajaxScripts/remCart.php",
		type: "post",
		data: JSON.stringify(intero),
		contentType: "application/json charset=utf-8",
		success: function (response){
			let prodotti = document.querySelector(".productManagement");
			prodotti.innerHTML=response;
			//console.log(prodotti);
		},
		error: function () {
			alert("errore"); 
			
		},
	});
}

function confermaRegistrazione() {
	let dati = controllaDati(".datiUtenteReg");
    if (dati != "error") {
        console.log("dato valido");

        $.ajax({
            url: "./ajaxScripts/salvaUtente.php",
            type: "POST",
            data: JSON.stringify(dati),
            contentType: "application/json; charset=utf-8",
            success: function (response) {
                alert("utente registrato con successo");
				let prodottoDiv = document.querySelector(".productManagement");
				prodottoDiv.classList.remove("notActive");
            },
            error: function () {
                alert("errore");
				
            },
        });
    }
	else{
		alert("errore nella compilazione dei campi");
	}
}

function confermaLogin() {
	let dati = controllaDati(".datiUtenteLog");
	
	
    if (dati != "error") {
        //console.log("dato valido");
		
		$.ajax({
            url: "./ajaxScripts/loginUtente.php",
            type: "POST",
            data: JSON.stringify(dati),
            contentType: "application/json; charset=utf-8",
            success: function (response) {
                let res = JSON.parse(response);
				
				if (res.stato == "successo") {
					alert("login effettuato con successo");
					let loggedFields = document.querySelector(".loggedFields");
					let buttonFields = document.querySelector(".buttonFields");
					let userManagement = document.querySelector(".userManagement");
					let logout = document.querySelector(".logout");
					let loginDiv = document.querySelector(".loginDiv");
					let prodottoDiv =document.querySelector(".productManagement");
					let textParagraph = loggedFields.firstChild;
					statoLogin = false;
					
					buttonFields.style.display = "none";
					userManagement.style.display = "none";
					loggedFields.style.display = "flex";
					loginDiv.classList.remove("active");
					prodottoDiv.classList.remove("notActive");
					
					textParagraph.textContent = `Ciao, ${res.data.nome} ${res.data.cognome}`;
					logout.style.display="flex";
				}
				else{
					let loggedFields = document.querySelector(".loggedFields");
					let buttonFields = document.querySelector(".buttonFields");
					let userManagement = document.querySelector(".userManagement");
					let loginDiv = document.querySelector(".loginDiv");
					let prodottoDiv =document.querySelector(".productManagement");
					statoLogin = false;
					
					buttonFields.style.display = "flex";
					userManagement.style.display = "flex";
					loginDiv.classList.remove("active");
					prodottoDiv.classList.remove("notActive");

					alert(res.data);

				}
				
            },
            error: function () {
                alert("error");
            },
        });
    }
	
	else{
		alert("errore nella compilazione dei campi");
	}
}
function logoutHandler(){

    $.ajax({
        url: "./ajaxScripts/no.php",
        type: "POST",
        data: JSON.stringify({}),
        contentType: "application/json; charset=utf-8",
        success: function (response) {
            console.log("logout");
			//alert("logout effettuato con successo");
					let loggedFields = document.querySelector(".loggedFields");
					let buttonFields = document.querySelector(".buttonFields");
					let userManagement = document.querySelector(".userManagement");
					let logout = document.querySelector(".logout");
					
					let textParagraph = loggedFields.firstChild;
					
					buttonFields.style.display = "flex";
					userManagement.style.display = "flex";
					loggedFields.style.display = "none";
					
					statoLogin =false;
					textParagraph.textContent = ``;
					logout.style.display="none";
        },
        error: function () {
            alert("errore");
				
        },
     });
}
