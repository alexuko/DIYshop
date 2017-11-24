<!DOCTYPE>
<html>
 <head>
  <title>Complete Register</title>
 </head>
 <body>
     <div data-role="page" data-theme="b">
          <div data-role="header" style="min-height: 45px;">
              <a href="welcome.php" class="ui-btn ui-btn-left ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
                <h1>Register Completed</h1>
              <a href="register.php" class="ui-btn ui-corner-all ui-shadow ui-icon-bullets ui-btn-icon-left">Register</a>
          </div>
        <div data-role="main" class="ui-content">    
                <div>
                    <p> These are your Details</p>
<?php 
if($_POST){
			$name           = $_POST['uname'];
			$surname        = $_POST['surname'];
			$address        = $_POST['address'];
            $email          = $_POST['email'];
			$contact_number = $_POST['contact_number'];
			$username       = $_POST['username'];
			$password       = $_POST['upassword'];
            $salt           = '0123';
            $hashed         = md5($password,$salt);
 
			
			echo "Name: ".$name."<br>Surname: ".$surname."<br>Contact number: ".$contact_number."<br>E-mail: ".$email."<br>Address: ".$address."<br>Username: ".$username."<br>Password: 'Not displayed for security'<br>";
						
			try{
				$host = 'localhost';
				$dbname = 'tool';
				$user = 'root';
				$pass = '';
				$DBH = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
				$sql = "INSERT INTO users (uname, surname, address, email, contact_number, username, upassword) VALUES (?,?,?,?,?,?,?)";
				
				$sth = $DBH->prepare($sql);
			
				$sth->bindParam(1, $name, PDO::PARAM_STR);
				$sth->bindParam(2, $surname, PDO::PARAM_STR);
				$sth->bindParam(3, $address, PDO::PARAM_STR);
                $sth->bindParam(4, $email, PDO::PARAM_STR);
				$sth->bindParam(5, $contact_number, PDO::PARAM_STR);
				$sth->bindParam(6, $username, PDO::PARAM_STR);
				$sth->bindParam(7, $hashed, PDO::PARAM_STR);
			
				$sth->execute();
				echo "<center>**********   You are now registered    **********<br>Thank You<br>All your Details were stored Succesfully<br>";
			}catch(PDOException $e) {echo '-----------------Error------------------';}
		}
        ?> 
                           <br><center><a href="login.php" data-role="button" data-inline="true" class="ui-link ui-btn ui-btn-a ui-btn-inline ui-shadow ui-corner-all" role="button">Login</a></center>
        </div>
     </div>
     </div>
 </body>
</html>
