<?php
    require("../db/conn.php");
    $a="";
    $myfile = fopen("test.txt", "w");
    
    if($conn != null) {
        $miaquery="SELECT * FROM prodotti"; 
        
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
                    <input type="button" value="aggiungi al carrello" onclick="aggCart(<?php echo($row['Id_prodotto']); ?>)"></input>
                </div>
            <?php
                }
            }
        }
    };
?>