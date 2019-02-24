<?php

//BUG AFFICHAGE !!!!! VOIR EPISODE 6

require_once('includes/header.php'); 

require_once('includes/sidebar.php'); 





$select = $db->prepare("SELECT * FROM products");
$select->execute();

while($s=$select->fetch(PDO::FETCH_OBJ)){

?>
<img src="admin/imgs/<?php echo $s->title ?>.jpg"/>
<h2><?php echo $s->title; ?></h2> <br> 
<h5><?php echo $s->descript; ?></h5> <br> 
<h4><?php echo $s->price; ?> €</h4> <br> 

 <br> 
 <br> 




<?php
 }


 require_once('includes/footer.php'); 



?>




