<?php
session_start();
include('connection.php');
$_SESSION['type'] = 'D_staff';
$_SESSION['username']="D_staff";
$id = '';
if (isset($_SESSION['type'])){
    $userType = $_SESSION['type'];
        if($userType != 'D_staff'){
          
        }else{
            
            
            if($_POST){
                     
                    if($_POST['deliv_status']!='' && $_POST['o_id']!=''){
                    
                        $ord_id   = $_POST['o_id'];
                        
                       
                        $q= $conn->prepare("UPDATE tool.order SET status='delivered' WHERE id_order=:id");
                            
                            $q->bindValue(':id',$ord_id);
                            $q->execute();
                        
                        echo "UPDATED";
                        header('location:delivery_staff.php');
                    
                    
                    }
                
                    }else{
                
                echo "**********Error************";
                header('location: delivery_staff.php');
                
            }
                        
        }
}else{
    
    header('location: welcome.php');
}
?>