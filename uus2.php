<?php

    //var_dump($_GET):
	//echo "<br>";
	//var_dump($_POST);
	
	$singupEmailError = "";
	
	//kas on üldse olemas
	if (isset ($_POST["singupEmail"])) {
	 
	   //oli olemas, ehk keegi vajutas nuppu
	   if (empty ($_POST["singupEmail"])) {
	     
		  //oli toesti tuhi
		  $singupEmailError = "See vali on kohustuslik";
		  
		}  
	}
	
	$singuppasswordError = "";
	
	//kas on üldse olemas
	if (isset ($_POST["singupPassword"])) {
	 
	   //oli olemas, ehk keegi vajutas nuppu
	   //kas oli tuhi
	   if (empty ($_POST["singupPassword"])) {
	     
		  //oli toesti tuhi
		  $singuppasswordError = "See parool on kohustuslik";
		  
		}  else {
			//oli midagi, ei olnud tuhi
			
			//kas pikkus vahemalt 8
			if (strlen ($_POST["singupPassword"]) < 8 ) {
				
				$singuppasswordError = "Parool peab olema vahemalt 8 tahemarki pikk";
			
			}
			
		}
		
	}
	
?>	

<!DOCTYPE html>
<html>
    <head>
         <title>Sisselogimise lehy</title>
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
		      <input name="singupEmail" type="email"> <?php echo $singupEmailError; ?>
			  
			  <br><br>
			  
			  <input placeholder="parool" name="singupPassword" type="password"> <?php echo $singuppasswordError; ?>
		       
			  <br><br>
			  
			  <input type="submit" value= "Loo kasutaja">
			  
		  </form>

    </body>
</html>
