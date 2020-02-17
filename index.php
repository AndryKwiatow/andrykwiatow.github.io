<?php session_start(); ?>
<?php require('dbcon.php'); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="form-wrapper">
  
  <form action="#" method="post">
    <h3>Ingresa aquí</h3>
	
    <div class="form-item">
		<input type="text" name="user" required="required" placeholder="Id de Usuario" autofocus required></input>
    </div>
    
    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Password" required></input>
    </div>
    
    <div class="button-panel">
		<input type="submit" class="button" id="btnLogin" name="login" value="Ingresar"></input>
    </div>
  </form>
  <?php
	$con = mysqli_connect("37.59.55.185","20YF07FNF8","VPeiydCL7l", "20YF07FNF8");
	//$con = mysqli_connect("remotemysql.com","20YF07FNF8","VPeiydCL7l", "20YF07FNF8");
	// Check connection
	if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else{
		echo "<h5 class=\"text-center\"><i>Connected</i></h5><br/>";
		if (isset($_POST['login']))
		{
			//echo 'User: ' . $_POST['user'] . 'Pass: ' . $_POST['pass'] . '<br/>';
			$username = mysqli_real_escape_string($con, $_POST['user']);
			$password = mysqli_real_escape_string($con, $_POST['pass']);
			$query = mysqli_query($con, "SELECT * FROM User WHERE id='$username' AND pwd='$password'");
			if(!$query){
				echo mysqli_error($con);
			}else{		
				$row = mysqli_fetch_array($query);
				$num_row = mysqli_num_rows($query);
				$date = date("Y-m-d h:m:s");
				
				if ($num_row > 0) {			
					$fName = $row['name'];
					$lName = $row['lastName'];
					$insert = mysqli_query($con, "UPDATE User SET lastLogin = '" . $date . "' WHERE id='" . $username . "'");
					echo '<script>alert(\'Bienvenido '. $fName .' '. $lName . '\'); window.location=\'http://cun-atm-app.eu5.net/home.php\'</script>';    
				}
				else{
					echo 'Invalid Username and Password Combination';
				}
			}
		}

	}
	mysqli_close($con);
	
  ?>
  <div class="reminder">
    <p>¿No estás registrado? <a href="signup.php">Crear usuario ahora</a></p>
    <p><a href="#">¿Olvidaste tu contraseña?</a></p>
  </div>
  
</div>

</body>
</html>