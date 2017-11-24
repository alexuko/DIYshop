<?php
session_start();
try{
    include('connection.php');
    $items=$_SESSION['itemsorder'];
    $user_id=$_SESSION['id'];
    $cl_add= $_SESSION['address'];
    
    $q =$conn->prepare("INSERT INTO `order` (user_id, item, client_address) VALUES (:user, :items, :address)");
    $q->bindValue(':user', $user_id);
    $q->bindValue(':items', $items);
    $q->bindValue(':address', $cl_add);
    $q->execute();
    echo "done";
     header('Location: customer.php#page3');
    }catch(PDOException $e){echo $e;}
    $_SESSION['cart']="";
    echo $_SESSION['itemsorder'];
?>

