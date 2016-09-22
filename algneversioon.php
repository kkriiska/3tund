<?php

    require("../../config.php");

    //var_dump($_GET):
	//echo "<br>";
	//var_dump($_POST);
	
	$signupEmailError = "";
	$signupEmail = "";
	
	//kas on üldse olemas
	if (isset ($_POST["signupEmail"])) {
	 
	   //oli olemas, ehk keegi vajutas nuppu
	   //kas oli tuhi
	   if (empty ($_POST["signupEmail"])) {
	     
		  //oli toesti tuhi
		  $singupEmailError = "See vali on kohustuslik";
		 
	    }else{	

           //koik korras, email ei ole tuhi ja on olemas
		   $signupEmail = $_POST["signupEmail"];
		 
		
		}  
		
	}
	
	$signupPasswordError = "";
	
	//kas on üldse olemas
	if (isset ($_POST["signupPassword"])) {
	 
	   //oli olemas, ehk keegi vajutas nuppu
	   //kas oli tuhi
	   if (empty ($_POST["signupPassword"])) {
	     
		  //oli toesti tuhi
		  $signupPasswordError = "See parool on kohustuslik";
		  
		}  else {
			//oli midagi, ei olnud tuhi
			
			//kas pikkus vahemalt 8
			if (strlen ($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vahemalt 8 tahemarki pikk";
			
			}
			
		}
		
	}
	
	
	$gender = "";
	if(isset($_POST["gender"])) {
		if(!empty($_POST["gender"])){
			
			//on olemas ja ei ole tuhi
			$gender = $_POST["gender"];
		}		
	}
	
	
	if ( isset($_POST["signupEmail"]) &&
             isset($_POST["signupPassword"]) &&
             $signupEmailError == "" &&
             empty($signupPasswordError)  
	    ) {
		
		//uhtegi viga ei ole, koik vajalik olemas
		echo "salvestan...";
		echo "email ".$signupEmail."<br>";
		echo "parool ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		
		
		
		echo "rasi ".$password."<br>";
		
		//uhendus
		$database = "if16_karokrii";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database );
	
	    //kask
	    $stmt = $mysqli->prepare("INSERT INTO user_sample(email, password) VALUES(?, ?)");
		
		echo $mysqli ->error;
		
		// s - string
		// i - int
		// d - decimal/double
		//iga kusimargi jaoke uks taht, mis tuupi on
		$stmt->bind_param("ss", $signupEmail, $password );
		
		//taida kasku
		if($stmt->execute() ) {
			
			echo "salvestamine onnestus";
			
		}else{
			
		    echo "ERROR ".$stmt->error;
		
		}
		
		
		
	}
?>	

<!DOCTYPE html>
<html>
    <head>
         <title>Sisselogimise leht</title>
    </head>
    <body>

          <h1>Logi sisse</h1>
		  
		  <form method="POST">
		  
		      <lable>E-post</lable><br>
		      <input name="loginEmail" type="email">
			  
			  <br><br>
			  
			  <input placeholder="parool" name="loginPassword" type="password">
		       
			  <br><br>
			  
			  <input type="submit">
			  
		  </form>
          <h1>Loo kasutaja</h1>
		  
		  <form method="POST">
		  
		  
		      <lable>E-post</lable><br>
		      <input name="signupEmail" type="email"> <?php echo $signupEmailError; ?> 
			  
			  <br><br>
			  
			  <input placeholder="parool" name="signupPassword" type="password"> <?php echo $signupPasswordError; ?>
		       
			  <br><br>
			  
			  <?php if ($gender == "male") { ?>
			        <input type="radio" name="gender" value="male"> Mees<br>
			  <?php } else { ?>
			        <input type="radio" name="gender" value="male" checked> Mees<br>
			  <?php } ?>
			 
			  <?php if ($gender == "female") { ?>
			        <input type="radio" name="gender" value="female"> Naine<br>
			  <?php } else { ?>
			        <input type="radio" name="gender" value="male" checked> Naine<br>
			  <?php } ?>
			  
			  <?php if ($gender == "other") { ?>
			        <input type="radio" name="gender" value="other"> Muu<br><br>
			  <?php } else { ?>
			        <input type="radio" name="gender" value="other" checked> Muu<br><br>
			  <?php } ?>
			        
			  <input type="submit" value= "Loo kasutaja">
			  
		  </form>

    </body>
</html>
