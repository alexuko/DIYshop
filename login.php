<?php
session_start();
			
        if($_POST) {
				$username = $_POST['username'];
				$password = $_POST['password'];
                $salt     = '0123';
                $hashed   = md5($password,$salt);
				try{
					$host = 'localhost';
					$dbname='tool';
					$user='root';
					$pass='';
					$DBH = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
					$q = $DBH->prepare("SELECT * FROM users WHERE username = :username and upassword = :password LIMIT 1");
					$q->bindValue(':username', $username);
					$q->bindValue(':password', $hashed);
					$q->execute();
					$check=$q->fetch(PDO::FETCH_ASSOC);
					$message = "";
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['type'] = $check['type'];
                    $_SESSION['email'] = $check['email'];
                    $_SESSION['name'] = $check['uname'];
                    $_SESSION['surname'] = $check['surname'];
                    $_SESSION['address'] = $check['address'];
                    $_SESSION['phone'] = $check['contact_number'];
                    $_SESSION['password'] = $check['upassword'];
                    $_SESSION['id'] = $check['id'];
                    $_SESSION['cart'] = '';
                    
                    
                    
					if(!empty($check)){
                            $userType = $check['type'];
							$message='Logging in';
                            
                        if($userType == 'Customer'){
                           header('Location: customer.php');
                            }
                        elseif($userType == 'Staff'){
                            header('Location: staff.php');
                            echo'test';
                            }
                        elseif($userType == 'Admin'){
                            header('Location: administrator.php');
                            }
                        elseif($userType == 'D_staff'){
                            header('Location: delivery_staff.php');
                            }
                          
					}else {
						$message="Sorry your details are incorrect";
                        echo $message;
					}
				}catch(PDOException $e){echo "error";}
			}

?>
 <?php
    if(!empty($message)){
    echo '<br>';
    echo $message;
    }
?>
<?php
    if(!empty($_POST['captcha'])){
    $captcha=$_POST['captcha'];
    if($captcha==$_SESSION['img_key']){
    echo 'CAPTCHA working';
    }else{
    echo 'CAPTCHA NOT Working';}
    }
?>
<!DOCTYPE>
<html>
<head><title> Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script type="text/javascript" src="my_script.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
    
	<body>
        <div data-role="page" data-theme="b">
          <div data-role="header" style="min-height: 45px;"><a href="welcome.php" class="ui-btn ui-btn-left ui-corner-all      ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
                <h1>Tool</h1>
              <a href="register.html" class="ui-btn ui-corner-all ui-shadow ui-icon-bullets ui-btn-icon-left">Register</a>
          </div>
        <div data-role="main" class="ui-content">    
                <div>
                   <p>Log in to your Account </p>
                        <form action="login.php" method="POST" name="login" data-ajax="false">
                            <input type="text" name="username" placeholder="USERNAME" required/><br>
                            <input type="password" name="password" placeholder="PASSWORD" required/><br>
                            <center>Are you a Robot?<br><img src="captcha.php" class="captcha_image"/></center>
                            <input type="text" name="captcha" placeholder="Type-in the numbers in the box !" autofocus autocomplete="off" value="" required/><br>
                            <input type="submit"  value="Submit"/>
                        </form>
                </div>
          </div> 
   
        </div>    
    </body>
</html>