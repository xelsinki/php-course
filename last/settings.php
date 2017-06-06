
<!DOCTYPE html>


<html>
  <head>
  <meta charset="UTF=8">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>
    Settings
    </title>
  </head>
  
<body>
<header>
    <h1>PHP-Course</h1>
    <h3>Settings</h3
    <!--        Laitoin käyttäjän nimi tänne ylös headeriin-->
    <?php

    // Jos Cookie sisältää nimen, niin tulostetaan: Hello, "nimi"
    if (isset($_COOKIE["name"])) {
        print("Hello, " . $_COOKIE["name"] . " .");
    }
    ?>

</header>

	<nav>
		<a href="index.php">Home page</a>
		<a href="newHenkilo.php">New Person</a>
		<a href="allPeoples.php">All Peoples</a>
        <a href="findPerson.php">Find Person</a>
		Settings
	</nav>
	
	<aside>
		
	</aside>
	<article>
	

   
 <?php
 
 require_once "person.php";
 session_start();

// $_SESSION["person"]= $username; 
  
 ?>

<form class="form1" method="post" action="" id="form1">
<fieldset>
    
            <p>Please enter your username</p>
            <label for="name">Username:</label>
            <span><input type="text" name="name" placeholder="username"
            class="required" role="input" aria-required="true"/></span>

            <input  class="submit .transparentButton" value="Send" type="submit" name="submit"/>
            <input  class="submit .transparentButton" value="Cancel" type="submit" name="cancel"/> 

    
    <br/>
    </fieldset>
</form>

<?php
if (isset($_POST["submit"])) {
    
	// käytän Person luokka, myös käyttäjän nimelle
	$person = new Person();
	//Asetetaan Cookie:iin lisätyn henkilön nimi ja lisäysaika
	setcookie("name", $_POST["name"], time()+60*60*24*7);
	header ( "location: index.php" );
    exit ();
      
}
	elseif (isset ( $_POST ["cancel"] )) {
		// unset($_SESSION["username"]);
		header ( "location: index.php" );
		exit ();
	 
}
?> 

	</article>
  <footer>made by Aleksandr Pantsesnyi</footer>
  </body>

</html>

