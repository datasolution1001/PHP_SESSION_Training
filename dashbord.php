<?php

require_once "securite.php";
require_once "connect.php";
$name = $_SESSION['user']['fullname'];

$search = isset($_GET['chercher'])?$_GET['chercher']:"";

$sql = "select id, civilite, fullname, email, libdept
        from enseignant e,  departement d
        where d.codedept = e.dept and
        (fullname like '%$search$' or email like '%$search%' or libdept like '%$search%')";


$conn->query("SET NAMES 'utf8'");
$res = $conn->query($sql);
$nb = $res->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include "menubar.php";
?>
<section class="content">
<form class="form-inline">
<input type="text" placeholder="mot(s) clé(s) ..." name="chercher">
&nbsp;&nbsp;&nbsp;
<input type="submit" value="Chercher" class="btn-info">
</form>

<a href="new_enseignant.php">++ Nouveau enseignant</a>
<?php if($nb==0)
echo '<div class="alert">Aucun resultat ...</div>';
else {

?>
<table>
    <tr>

    <th>#</th>
    <th>Nom et Prenom</th>
    <th>Courrier electronique</th>
    <th>Departement</th>
    <th colspan="3">Actions</th>

    </tr>
    <?php while ($rows = $res->fetch_assoc()) {?>
        <tr>
        <td><?php echo $rows['id'];?></td>
        <td><?php echo $rows['civilite'].' '.$rows['fullname'];?></td>
        <td><?php echo $rows['email'];?></td>
        <td><?php echo $rows['libdept'];?></td>
        <td><a href="">Consulter</a></td>    
        <td><a href="">Editer</a></td>        

        <td><a href="">Supprimer</a></td>        

        </tr>
    <?php } ?>
</table>

<?php } ?>

<section>
</body>
</html>