<?php
include("config.php");
include("firebaseRDB.php");
include("jwt.php");

$token = new BaoKimAPI();

// var_dump($token->getToken());die();

if(!isset($_SESSION['user'])){
    header('location: login.php');
}

$db = new firebaseRDB($databaseURL);
?>
<a href="add.php"><button>Add data</button></a>
<table border="1" width="700">
    <tr>
        <td>Thumbnail</td>
        <td>Title</td>
        <td>Year</td>
        <td>Rating</td>
    </tr>
    <?php
        $data = $db->retrieve('film');
        $data = json_decode($data, 1);
        if(is_array($data)){
            foreach($data as $id => $film){
               echo "<tr>
               <td><img src='{$film['thumbnail']}'></td>
               <td>{$film['title']}</td>
               <td>{$film['year']}</td>
               <td>{$film['rating']}</td>
               <td><a href='edit.php?id=$id'>EDIT</a></td>
               <td><a href='delete.php?id=$id'>DELETE</a></td>
            </tr>";
            }
         }
    ?>
</table>
<br>
<a href="logout.php">Logout</a>
<br>
<?php echo '<pre>'.print_r($token->getToken(), true).'</pre>';

?>
<br>
