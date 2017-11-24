<?php
session_start();
include('connection.php');
$_SESSION['type'] = 'Staff';
$p_id = '';

if (isset($_SESSION['type'])){
    $userType = $_SESSION['type'];
        if($userType != 'Staff'){
          header('location: welcome.php');
        }else{
            
            if($_POST){
                
                            $p_id     = $_POST['pid'];
                            $p_name   = $_POST['pname'];
                            $p_desc   = $_POST['pdescr'];
                            $p_price = $_POST['price'];
                            $p_img    = $_POST['pimg'];
                        
                    $q= $conn->prepare("UPDATE product SET p_id=:id, p_name=:name, p_description=:description, p_price=:price, p_img=:img  WHERE p_id=:id ");

                            $q->bindValue(':id',$p_id);        
                            $q->bindValue(':name',$p_name);        
                            $q->bindValue(':description',$p_desc);        
                            $q->bindValue(':price',$p_price);        
                            $q->bindValue(':img',$p_img);        
                                    
                            $q->execute();

                        echo "UPDATED";
                        header('location:staff.php');

                    }else{echo "**********Error************";}
                        
        }
}else{
    
    header('location: welcome.php');
}
?>