<?php
session_start();
include('connection.php');
$_SESSION['type'] = 'Admin';
$_SESSION['username']="admin";
$id = '';
if (isset($_SESSION['type'])){
    $userType = $_SESSION['type'];
        if($userType != 'Admin'){
          
        }else{
            
            
            if($_POST){
                     
                    if($_POST['type']!='' && $_POST['password']!=''){
                    
                        $id       = $_POST['id'];
                        $u_type   = $_POST['type'];
                        $password = $_POST['password'];
                        $salt     = '0123';
                        $hashed   = md5($password,$salt);
                       
                        $q= $conn->prepare("UPDATE users SET upassword=:password, type=:type WHERE id=:id ");
                            
                            $q->bindValue(':password',$hashed);
                            $q->bindValue(':type',$u_type);
                            $q->bindValue(':id',$id);
                            $q->execute();
                        echo "UPDATED";
                        header('location:administrator.php');
                    
                    
                    }
                
                    elseif($_POST['password']!=''){
                        
                        $id       = $_POST['id'];
                        $password = $_POST['password'];
                        $salt     = '0123';
                        $hashed   = md5($password,$salt);

                        $q= $conn->prepare("UPDATE users SET upassword=:password WHERE id=:id ");

                            $q->bindValue(':password',$hashed);        
                            $q->bindValue(':id',$id);
                            $q->execute();
                       
                        echo "UPDATED";
                        header('location:administrator.php');
                      }
                
                 elseif($_POST['type']){
                        
                        $id       = $_POST['id'];
                        $u_type   = $_POST['type'];
                       
                        $q= $conn->prepare("UPDATE users SET type=:type WHERE id=:id ");

                            $q->bindValue(':type',$u_type);
                            $q->bindValue(':id',$id);
                            $q->execute();
                        echo "UPDATED";
                        header('location:administrator.php');
                       }
                
               
                
                else{
                    header('location: welcome.php');
                }
                
                        echo "UPDATED";
                        header('location:administrator.php');

                    }else{
                
                echo "**********Error************";
                
            }
                        
        }
}else{
    
    header('location: welcome.php');
}
?>