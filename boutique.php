<?php


require_once('includes/header.php'); 

require_once('includes/sidebar.php'); 


$select = $db->query("SELECT * FROM category");
while($s = $select->fetch(PDO::FETCH_OBJ)){

    ?>

    <a href="?category=<?php echo $s->name;?>"><h3><?php echo $s->name ?></h3></a>

    <?php  

}

require_once('includes/footer.php'); 



?>
