<?php
session_start();

?>


<link rel="stylesheet" type="text/css" media="screen" href="../style/bootstrap.css">
<link rel="stylesheet" type="text/css" media="screen" href="../style/perso.css">
<h1>Bienvenue, <?= $_SESSION['username']; ?> </h1>
<br>
<a href="?action=add">Ajouter un produit</a>
<a href="?action=modifyanddelete">Modifier / Supprimer un produit</a> <br><br>

<?php

try{

    $db = new PDO('mysql:host=localhost;dbname=ecommerce', 'root','');
    $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caractères minuscules
    $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); // les erreurs lanceront des exceptions
    $db->exec('SET NAMES utf8');				
}

catch(Exception $e){

    die('Une erreur est survenue');

}

if (isset($_SESSION['username'])) { //evite de se connecter en admin via la barre d'adresse
    
    if (isset($_GET['action'])) {
        
        if ($_GET['action'] == 'add') {
            
            
            if (isset($_POST['submit'])) { //si on clique sur le bouton
                
                $title       = $_POST['title'];
                $descript = $_POST['descript'];
                $price       = $_POST['price'];

                $img      = $_FILES['img']['name']; //recup nom et extension de l'img

                $img_tmp = $_FILES['img']['tmp_name']; // lieu de stockage img

                if(!empty($img_tmp)){


                $image = explode('.',$img); //creation array avec (nomImg,extension)

                  $image_ext= end($image);       

                  if(in_array(strtolower($image_ext),array('png','jpg','jpeg'))===false){


                    echo "Seuls les formats PNG, JPG, JPEG sont acceptés.";

                  }else{

                        $image_size = getimagesize($img_tmp);  //check taille image, resize et  evite d'inserer virus avec extention d'une img

                        if($image_size['mime']== 'image/jpeg'){

                            $image_src= imagecreatefromjpeg($img_tmp);


                        }else if($image_size['mime']== 'image/png'){

                            $image_src= imagecreatefrompng($img_tmp);                     


                        }else{

                            $image_src= false;

                            echo "Veuillez rentrer une image valide.";


                        }

                        if($image_src!==false){

                            $image_width = 200;

                            if($image_size[0]==$image_width){

                                $image_finale=$image_src;

                            }else{

$new_width[0]=$image_width;

$new_height[1]= 200;

$image_finale= imagecreatetruecolor($new_width[0],$new_height[1]);

imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width[0],$new_height[1],$image_size[0],$image_size[1]);





                            }

                            imagejpeg($image_finale, 'imgs/' .$title.'.jpg'); //le nom de l'img aura le nom de l'article qui lui correspond et sera .jpg


                        }
                  }



                }else{

                    echo 'Veuillez rentrer une image';

                }




                
                if ($title && $descript && $price) {
                    
                    
                    $insert = $db->prepare("INSERT INTO products VALUES (0, '$title','$descript','$price')");
                    $insert->execute();
                    
                    
                } else {
                    
                    echo 'Veuillez remplir tous les champs';
                    
                }
                
            }
            
?>

<form action="" method="post" enctype="multipart/form-data" >
<h3>Nom du produit: </h3><input type="text" name='title'/>
<h3>Descirption du produit: </h3><textarea name='descript'/> </textarea>
<h3>Prix du produit: </h3><input type="text" name='price'/> <br>
<h3>Image: </h3><input type="file" name='img'/> <br> <br><br>
<input type="submit" name="submit"/>
</form>

<?php


        } else if ($_GET['action'] == 'modifyanddelete') {  

            $select = $db->prepare("SELECT * FROM products");
            $select->execute();

            while($s=$select->fetch(PDO::FETCH_OBJ)){

                echo $s->title;
                ?>
					<a href="?action=modify&amp;id=<?php echo $s->id; ?>">Modifier</a>
					<a href="?action=delete&amp;id=<?php echo $s->id; ?>">X</a><br/><br/>
				<?php


                
            }            
            
        } else if ($_GET['action'] == 'modify') {

        
            $id=$_GET['id'];

            $select = $db->prepare("SELECT * FROM products WHERE id=$id");
            $select->execute();

            $data = $select->fetch(PDO::FETCH_OBJ);

            ?>

<form action="" method="post">
<h3>Nom du produit: </h3><input value="<?= $data->title; ?>" name="title"/>
<h3>Descirption du produit: </h3><textarea name='descript'/> <?= $data->descript; ?> </textarea>
<h3>Prix du produit: </h3><input value="<?= $data->price; ?>"type="text" name="price"/> <br><br>
<input type="submit" name="submit" value="Modifier"/>
</form>



            <?php

if (isset($_POST['submit'])) { 
        
    $title       = $_POST['title'];
    $descript = $_POST['descript'];
    $price       = $_POST['price'];

    $update = $db->prepare("UPDATE products SET title='$title',descript='$descript',price='$price' WHERE id='$id' ");
    $update->execute();

    header('Location: admin.php?action=modifyanddelete'); //permet lors de la redirection d'afficher le nom modif
                    

}





            
        } else if ($_GET['action'] == 'delete') {


            $id=$_GET['id'];
            $delete = $db->prepare("DELETE FROM products WHERE id=$id");
            $delete->execute();


            
        } else {
            
            die('Une erreur s\'est produite');
            
        }
    } else {
        
        
        
        
        
    }
} else {
    
    header('Location: ../index.php');
    
}
?>
