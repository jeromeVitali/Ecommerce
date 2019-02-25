<?php

require_once 'includes/header.php';

require_once 'includes/sidebar.php';

if (isset($_GET['show'])){

    $product = $_GET['show'];

    $select = $db->prepare("SELECT * FROM products WHERE title='$product' ");
    $select->execute();

    $s = $select->fetch(PDO::FETCH_OBJ);

    ?>
<br>
<br>
<div style="text-align:center;">
<img src="admin/imgs/<?php echo $s->title; ?>.jpg"/>
<h1> <?php echo $s->title; ?> </h1>
<h5><?php echo $s->descript; ?></h5>
<h4><?php echo $s->price; ?> €</h4>
</div>


<?php

} else {

    if (isset($_GET['category'])) {

        $category = $_GET['category'];
        $select = $db->prepare("SELECT * FROM products WHERE category='$category' ");
        $select->execute();

        while ($s=$select->fetch(PDO::FETCH_OBJ)) {


            ?>
<a href="?show=<?php echo $s->title; ?>"> <img src="admin/imgs/<?php echo $s->title; ?>.jpg"/></a>
<a href="?show=<?php echo $s->title; ?>"> <h2><?php echo $s->title; ?> </h2> </a>
<h5><?php echo $s->descript; ?> </h5>
<h4><?php echo $s->price; ?> €</h4>
<br><br>

<?php

        }

    } else {

        $select = $db->query("SELECT * FROM category");

        while ($s = $select->fetch(PDO::FETCH_OBJ)) {

            ?>

<a href="?category=<?php echo $s->name; ?>">  <h3> <?php echo $s->name; ?> </h3> </a>

<?php

        }

    }

}

require_once 'includes/footer.php';

?>