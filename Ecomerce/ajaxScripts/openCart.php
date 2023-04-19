<?php
    require("../db/conn.php");
    $a="";
    $myfile = fopen("test.txt", "w");
    if (isset($_COOKIE["mailUtente"])) {
    $mail= $_COOKIE["mailUtente"];
    }else$mail=null;

    if($mail!=null){
        if($conn != null){
            $miaquery="SELECT * FROM carrello where emailC ='".$mail."'"; 

            $result = $conn->query($miaquery);

            $row = $result->fetch_array(MYSQLI_ASSOC);
            $row_cnt = mysqli_num_rows($result);
            if ($result->num_rows > 0) {
                
                for($i=0; $i<=$row_cnt; $i++){
                    consoleLog($row_cnt);
                    
                    if($a!=$row['nome_f']){
                        $a=$row['nome_f'];
                ?>
                    <div class="prodotto">
                        <img src="./media/<?php  echo $row['nome_f'];?>" id="pro1" onclick="apriProdotto(this)">
                        <p class="n_prodotto"><?php echo $row["descrizione"]?></p>
                        <p class="prezzo"><?php echo $row["prezzo_U"]?> €</p>
                        <input type="button" value="rimuovi dal carrello" onclick="remCart()"></input>
                    </div>
                <?php
                    }
                }
            }
            else {?>
                <h1>carrello vuoto aggiungi un prodotto</h1>
                <br>
                <h3>Ricarica la pagina per favore</h3>   
            <?php
            }
        };
    }
    else {?>
        <h1>effettuare il login per accedere a questa opzione</h1>
        <br>
        <h3>Ricarica la pagina per favore</h3>            
    <?php
    }
?>