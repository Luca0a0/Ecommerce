<?php
    require("../db/conn.php");
    $a="";
    $b="";
    //$myfile = fopen("test.txt", "w");
    $datiRicevuti = file_get_contents('php://input');
    $input = json_decode($datiRicevuti, TRUE);
    
    if (isset($_COOKIE["mailUtente"])) {
        $mail= $_COOKIE["mailUtente"];
    }else$mail=null;
        
    if($conn != null) {
        if($mail!=null){
            $miaquery="SELECT * FROM carrello WHERE emailC ='".$mail."'"; 
            $query="INSERT INTO carrello(Id_prodottoC,emailC,qtaC) VALUES ('".$input."','".$mail."',1)";
        
            $a = $conn->query($query);
            $result = $conn->query($miaquery);

            $row = $result->fetch_array(MYSQLI_ASSOC);
            $row_cnt = mysqli_num_rows($row);

            //fwrite($myfile,array_keys($row). "\n");
        
            consoleLog("a");
            if ($result->num_rows > 0) {
                consoleLog($row_cnt);
                for($i=0; $i<=$row_cnt; $i++){
                
                
                    if($b!=$row['nome_f']){
                        $b=$row['nome_f'];
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
        }
    };
?>