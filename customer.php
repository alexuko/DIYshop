<?php
session_start();
include('connection.php');
if (isset($_SESSION['type'])){
    $userType = $_SESSION['type'];
        if($userType != 'Customer'){


            header('location:welcome.php');
        }
}else{
    
    header('location:welcome.php');
}
?>

<!DOCTYPE html>
<html>
     <head>
        <title>Customer Interface</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <script type="text/javascript" src="js/validation.js"></script>
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     </head>
 
<body>
    <!------------------------------------PAGE 1-------------------------------------> 
    <div id="page1" data-role="page" data-theme="b">
        <div data-role="header" data-position="fixed"><h1><?php echo 'Welcome <br>'.$_SESSION['username'];?></h1>
        <a href="#logoutDialog" data-rel="popup" data-position-to="origin" data-role="button" data-inline="true" data-transition="pop" aria-haspopup="true" aria-owns="popupDialog" aria-expanded="true" class="ui-link ui-btn ui-btn-right ui-shadow ui-corner-all" role="button">Logout</a>
            
    <!------------------------------------Logout Dialog------------------------------------->        
     <div data-role="popup" id="logoutDialog" data-overlay-theme="a">
        <div data-role="header"><h1>Logout !</h1></div>
            <h3 class="ui-title">Are you sure, you want to Logout ?</h3>
                <a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="a" class="ui-link ui-btn ui-btn-a ui-btn-inline ui-shadow ui-corner-all" role="button">No</a>
                <a href="logout.php" data-role="button" data-inline="true" data-rel="delete" data-transition="flow" data-theme="b" class="ui-link ui-btn ui-btn-b ui-btn-inline ui-shadow ui-corner-all" role="button">Yes, I want to logout</a>
    </div>          
           
   <!-----------------------------------Page 1 Content------------------------------------------------>
        </div> 
                
          <a href="#page2" class="ui-btn" data-transition="slide" data-ajax="false" >Products</a>
          <a href="#page3" class="ui-btn" data-transition="slide" data-ajax="false" >Current Orders</a>
          <a href="#page4" class="ui-btn" data-transition="slide" data-ajax="false" >Account Details</a>
          
          
           
        <div data-role="footer" data-position="fixed"><h1>Copyright 2016</h1></div>
           
          
    </div>
    
    <!------------------------------------PAGE 2------------------------------------->
    <div id="page2" data-role="page" data-theme="b">
       <div data-role="header" data-position="fixed"><h1>Products</h1><br></div>
        <div data-role="navbar" data-iconpos="bottom">
            <ul>
             <li><a href="#page1" data-icon="arrow-l"></a></li>
            </ul>
          </div>
        
            <div data-role="content" class="page1_customer">
<!--------------------------------------------------------------------------------------------->
<?php 
                
                    $q = $conn->prepare("SELECT * FROM product");
                    $q->execute();
                
                if ($q->rowCount() > 0) {
                    echo "<div data-role='main' class='ui-content'>
                            <div data-role='collapsibleset'>";

                    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                             $pid   = $row['p_id'];
                             $pname = $row['p_name'];
                             $descr = $row['p_description'];
                             $price = $row['p_price'];
                             $img   = $row['p_img'];
                    
                    echo "<div data-role='collapsible'>
                            <h3>ID:".$pid." ".$pname." &euro; ".$price."</h3>
                                <center><p class='collapsible_cont'>".$descr."</p><br>
                                <img src=".$img." class='collapsible_cont'/><br>
                                <p class='collapsible_cont'>&euro;".$price."</p><br>
                                    
                            <div data-role='footer' class='ui-bar'>
                                <a href='?id=".$pid."#page2' data-role='button' data-icon='plus' data-ajax='false'>Add to Cart!</a>
                            </div>
                          </div>";
                        
                    
                    }
                    echo   "</div>
                    
                           </div>";$_SESSION['itemsorder']=null;   
                    
echo "<h4>LIST ITEMS IN YOUR CART</h4>";       
if($_GET){
    $a = $_SESSION['cart'];
    $b = $_GET['id']."/" ;
    $_SESSION['cart'] = $a.$b;
} 
function getItemInfo($item){
    
    include('connection.php');  
        $id = $item;
        $q = $conn->prepare("SELECT * FROM product WHERE p_id =:id");
        $q->bindValue(':id', $id);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);

        $itemsorder = "Item ".$result['p_id']." ".$result['p_name']." £ ".$result['p_price']."<br>";

    echo $itemsorder;
         $_SESSION['itemsorder'] .= $itemsorder;
}      
        $items=$_SESSION['cart'];
        $tok=explode("/",$items);
            foreach($tok as $item){
            if($item!=""){
                getItemInfo($item);
              }
    }
      echo "<a href='plc_ord.php' data-role='button' data-icon='plus' data-mini='true' data-ajax='false' >Place your Order!</a>";
                    
                                 
                }else {echo "No Results Found";}   
?>
                
     

          
<!--------------------------------------------------------------------------------------------->                
        </div>
        <div data-role="footer" data-position="fixed"><h1><?php echo $_SESSION['username'].' This is our current list of products '; ?></h1></div>
       
</div>


<!------------------------------------PAGE 3------------------------------------->
    <div id="page3" data-role="page" data-theme="b">
       <div data-role="header" data-position="fixed"><h1>Current Orders</h1></div>
        <div data-role="navbar" data-iconpos="bottom">
            <ul>
             <li><a href="#page1" data-icon="arrow-l"></a></li>
            </ul>
          </div>
<!--------------------------------------------------------------------------------------------->
<?php
        $client_id = $_SESSION['id'];
        try{
            $q = $conn->prepare("SELECT * FROM `order` WHERE user_id=$client_id;");
                    $q->execute();
            if ($q->rowCount() > 0) {
                    echo "<div data-role='main' class='ui-content'>
                            <div data-role='collapsibleset'>";

                    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                             $o_id   = $row['id_order'];
                             $u_id = $row['user_id'];
                             $c_add = $row['client_address'];
                             $itm = $row['item'];
                             $t   = $row['time'];
                             $sts   = $row['status'];
                             
                             
                     echo "<div data-role='collapsible'>
                            <h3>Order ID:".$o_id." ".$t."</h3>
                                <center><p class='collapsible_cont'>Your Order ID: ".$o_id."</p><br>
                                        <p class='collapsible_cont'>Items purchased: ".$itm."</p><br>
                                        <p class='collapsible_cont'>Status of your order: ".$sts."</p><br>
                                       
                                    
                            <div data-role='footer' class='ui-bar'></div>
                          </div>";
                    }
               
        
            }
            
        }catch(PDOException $e){echo "*****Error: " . $e->getMessage();
                               }
        ?>
                
     
        <div data-role="footer" data-position="fixed"><h1><?php echo 'This are your Current Orders '.$_SESSION['username']; ?></h1></div>
    </div></div></div>                
<!--------------------------------------------------------------------------------------------->   
    <div id="page4" data-role="page" data-theme="b">
        <div data-role="header" data-position="fixed"><h1>Account Details</h1></div>
            <div data-role="navbar" data-iconpos="bottom">
                <ul>
                    <li><a href="#page1" data-icon="arrow-l"></a></li>
                </ul>
            </div>
<?php 
if($_POST){
            $id            = $_SESSION['id'];
    
			$new_name      = $_POST['name'];
			$new_surname   = $_POST['surname'];
			$new_address   = $_POST['address'];
            $new_email     = $_POST['email'];
			$new_phone     = $_POST['phone'];
			$new_username  = $_POST['username'];
			$new_password  = $_POST['password'];
            $salt          = '0123';
            $hashed        = md5($new_password,$salt);
 							
			try{
                 $q =    "UPDATE users
                            SET uname          ='$new_name',
                                surname        ='$new_surname',
                                address        ='$new_address',
                                email          ='$new_email',
                                contact_number ='$new_phone',
                                username       ='$new_username',
                                upassword      ='$hashed'
                                
                                WHERE id=$id";
                
				$q = $conn->prepare($q);
			
				$q->bindParam(1, $new_name, PDO::PARAM_STR);
				$q->bindParam(2, $new_surname, PDO::PARAM_STR);
				$q->bindParam(3, $new_address, PDO::PARAM_STR);
                $q->bindParam(4, $new_email, PDO::PARAM_STR);
				$q->bindParam(5, $new_phone, PDO::PARAM_STR);
				$q->bindParam(6, $new_username, PDO::PARAM_STR);
				$q->bindParam(7, $hashed, PDO::PARAM_STR);
			
				$q->execute();
				
                echo $q->rowCount() . "<center>**********   Your Details were Updated    **********<br>";
                echo "<center>*** Logout from your account and login with your new details to see the changes made ! ***<br>";
			
            }catch(PDOException $e){echo "*****Error: " . $e->getMessage();}
}
        ?>     
        
        
        
        
    <div data-role="main" class="ui-content">
      <div class="ui-grid-a">
        <div class="ui-block-a">
            <span>Current Details</span>
            <?php
                echo "<br><input type='text' name='name' value='".$_SESSION['name']."'readonly/>
                      <br><input type='text' name='surname' value='".$_SESSION['surname']."'readonly/>
                      <br><input type='text' name='address' value='".$_SESSION['address']."'readonly/>
                      <br><input type='email' name='email' value='".$_SESSION['email']."'readonly/>
                      <br><input type='tel' name='phone' value='".$_SESSION['phone']."'readonly/>
                      <br><input type='text' name='username' value='".$_SESSION['username']."'readonly/>
                      <br><input type='password' name='password' value='".$_SESSION['password']."'readonly/>
                      <br><a href='#page1' data-role='button' data-mini='true'>Return</a>
                      ";
            ?>
        </div>

        <div class="ui-block-b">
        
         <span>Update Your Details</span><br>
            <?php     
          echo "<form action='customer.php#page4' method='POST' onsubmit ='return validate();' data-ajax='false'>
                    <input type='text' name='name' data-clear-btn='true' placeholder='Name' required/><br>
                    <input type='text' name='surname' data-clear-btn='true' placeholder='Surname' required/><br>
                    <input type='text' name='address' data-clear-btn='true' placeholder='Address' required/><br>
                    <input type='email' name='email' data-clear-btn='true' placeholder='E-mail' required/><br>
                    <input type='tel' name='phone' data-clear-btn='true' placeholder='Phone' required/><br>
                    <input type='text' name='username' data-clear-btn='true' placeholder='Username' required/><br>
                    <input type='password' name='password' data-clear-btn='true' placeholder='Password' required/><br>
                    <input type='submit' data-mini='true' value='Update !'/>
                </form>";
            ?>
        </div>
      </div>
    </div>

        
        
        
        <div data-role="footer" data-position="fixed"><h1>Copyright 2016</h1></div>
    </div> 
 <!------------------------------------END OF PAGE ------------------------------------->    
 </body>
</html>
