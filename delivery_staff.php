<?php
session_start();
include('connection.php');
if (isset($_SESSION['type'])){
    $userType = $_SESSION['type'];
        if($userType != 'D_staff'){
            header('location:welcome.php');
        }
}else{
    
    header('location:welcome.php');
}
?>
<!DOCTYPE>
<html>
     <head>
         <title>Delivery Staff Interface</title>
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
            <a href="#page2" class="ui-btn" data-transition="slide" data-icon="home">Orders</a>
            <a href="#page3" class="ui-btn" data-transition="slide" data-icon="home">Account Details</a>
                
           
       <div data-role="footer" data-position="fixed"><h1>Copyright 2016</h1></div>             
    </div>
      <!-----------------------------------END Page 1 ------------------------------------------------>
    
    <!------------------------------------PAGE 2------------------------------------->
    <div id="page2" data-role="page" data-theme="b">
       <div data-role="header" data-position="fixed"><h1>Orders</h1><br></div>
            <div data-role="navbar" data-iconpos="bottom">
                <ul>
                    <li><a href="#page1" data-icon="arrow-l"></a></li>
                </ul>
            </div>
<?php 
                
                    $q = $conn->prepare("SELECT * FROM `order`");
                    $q->execute();
                
                if ($q->rowCount() > 0) {
                    echo "<div data-role='main' class='ui-content'>
                            <div data-role='collapsibleset'>";

                    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                             $ord_id    = $row['id_order'];
                             $user_id   = $row['user_id'];
                             $items     = $row['item'];
                             $time      = $row['time'];
                             $status    = $row['status'];
                             $user_addr = $row['client_address'];
                            
                    
                    echo "<div data-role='collapsible'>
                            <h3>Order_ID:".$ord_id." Status:".$status."</h3>
                            
                    <form action='ord_delivered.php' method='POST' data-ajax='false'>
                            
        Order ID:               <input type='text' name='o_id' value='$ord_id' readonly/><br>
        User ID:                <input type='text' name='c_id' value='$user_id' readonly/><br>
        Items punchased:        <textarea rows='10' cols='30' readonly/>$items</textarea><br>
        User Address:           <textarea rows='10' cols='30' readonly/>$user_addr</textarea><br>
        Time Order was placed:  <input type='text' name='time' value='$time' readonly/><br>
                                <input type='hidden' name='deliv_status' value='delivered' readonly/><br>
        
                                <input type='submit' name='btn_status' data-mini='true' value='Delivered'/>
                                                
                    </form>
                        
                    
                            
                          </div>";
                    
                    }echo   "</div>
                           </div>";
                                 
                }else {echo "No Results Found";}   
?>        
                
       <div data-role="footer" data-position="fixed"><h1>Copyright 2016</h1></div>
       
    </div>

<!------------------------------------PAGE 4------------------------------------->
   <div id="page3" data-role="page" data-theme="b">
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
          echo "<form action='delivery_staff.php#page3' method='POST' onsubmit ='return validate();' data-ajax='false'>
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
   
                
 </body>
</html>
                    