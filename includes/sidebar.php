<div class="sidebar">
<h4>Nouveaux Articles</h4>

<?php

$select = $db->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 0,3"); // affiche les 3 derniers articles ajoutés à la BDD
$select->execute();

while($s=$select->fetch(PDO::FETCH_OBJ)){

?>

<div style="text-align:center">
<h2 style= "color:white"><?php echo $s->title; ?></h2> <br> 
<h5 style= "color:white"><?php echo $s->descript; ?></h5> <br> 
<h4 style= "color:white"><?php echo $s->price; ?> €</h4> <br> 
</div>

 <br> 
 <br> 




<?php

}
?>



</div>