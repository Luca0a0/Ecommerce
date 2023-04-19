<?php
    require("../db/conn.php");
    $a="";
    $myfile = fopen("test.txt", "w");
    $datiRicevuti = file_get_contents('php://input');
    $input = json_decode($datiRicevuti, TRUE);
    
    if (isset($_COOKIE["mailUtente"])) {
        $mail= $_COOKIE["mailUtente"];
    }else$mail=null;
        
    if($conn != null) {
        if($mail!=null){
            $miaquery="DELETE * FROM carrello WHERE id_prodotto='".$input."'"; 
            $query="SELECT * FROM carrello";
        
            $a = $conn->query($miaquery);
            $result = $conn->query($miaquery);

            $row = $result->fetch_array(MYSQLI_ASSOC);
            $row_cnt = mysqli_num_rows($result);

            //fwrite($myfile,array_keys($row). "\n");
        
            if ($result->num_rows > 0) {
            
                for($i=0; $i<=$row_cnt; $i++){
                consoleLog($row_cnt);
                
                    if($a!=$row['nome_f']){
                        $a=$row['nome_f'];
                ?>
                    <div class="prodotto">
                        <img src="./media/<?php  echo $row['nome_f'];?>" id="pro1">
                        <p class="n_prodotto"><?php echo $row["descrizione"]?></p>
                        <p class="prezzo"><?php echo $row["prezzo_U"]?> €</p>
                        <input type="button" value="rimuovi dal carrello" onclick="remCart(<?php echo($row['Id_prodotto']); ?>)"></input>
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
        }
    };
?>