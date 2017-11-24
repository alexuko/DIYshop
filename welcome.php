<?php if(isset($_SESSION)){
         session_destroy();
      }; 
?>
<!DOCTYPE>
<html lang="en">
  <head>
		<title>Index</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
            <script type="text/javascript" src="my_script.js"></script>
            <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
            <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  

  </head>
	  <body>
          <div data-role="page" id="pageone" data-theme="b">
           <div data-role="header">    <h1> TOOL !!!</h1>    </div>
			<div class="container">
			  <div  class="jumbotron">
                  <center><h1>You must be registered to Login.<br><br>Otherwise click on the button<br><b>"Register"</b></h1><br>
				
					   <a href="login.php" data-role="button" data-inline="true" class="ui-link ui-btn ui-btn-a ui-btn-inline ui-shadow ui-corner-all" role="button">Login</a>
                       
                       <a href="register.html" data-role="button" data-inline="true" class="ui-link ui-btn ui-btn-a ui-btn-inline ui-shadow ui-corner-all" role="button">Register</a>
                  </center>  
			   </div>
		    </div>
          <div data-role="footer"><h1>Copyright 2016</h1></div>
          </div> 	
              
	  </body>

</html>

