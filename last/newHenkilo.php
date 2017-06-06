

<?php

require_once "person.php";
//Aloitetaan sessio
session_start();

// // Jos painetaan talleta, painiketta, niin tarkistetaan kentät
if (isset($_POST["submit"])){
   // Muodostetaan olio lomakekenttien tiedoilla
   // Lomakkeen kenttiin viitataan $_POST["kentan_nimi"), koska form method="post"
	$person = new Person($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["comment"]);	
   
  //Session
	$_SESSION["person"] = $person;
   session_write_close();
   
   // Tarkastetaan virheet
   $nameError = $person->checkName();
   $surnameError = $person->checkSurname();
   $emailError= $person->checkEmail();
   $commentError= $person->checkComment(); 
   
   
   
   // Jos ei ole virheitä siirrytään showPerson sivulle
   if ($nameError == 0 && $surnameError == 0 && $emailError == 0 && $commentError == 0) {
    
   	//suljetaan sessio
   	// session_write_close();
   // Siirrytään näyttösivulle
   header("location: showPerson.php");
   exit;
   }
}
// jos on painettu Cancel niin siirrytään etusivulle
elseif (isset ( $_POST ["cancel"] )) {
	unset($_SESSION["person"]);
	header ( "location: index.php" );
	exit ();
} 
// Sivulle tultiin showPerson sivulta 
else {
	
	if (isset($_SESSION["person"])) {
		
		$person = $_SESSION["person"];
	} 
	// Jos sessiossa ei ole mitään 
	else {
		
			
   // Muodostetaan olio oletustiedoilla eli tyhjillä tiedoilla
	$person= new Person();
	}
   // Laitetaan virhekoodit 0 => eli ei ole virheitä
	$nameError= 0;
	$surnameError= 0;
	$emailError= 0;
	$commentError= 0;
	
}
?>

<!DOCTYPE>
<html>
<head>
<meta charset="utf8">
<link href="style.css" rel="stylesheet" type="text/css">
<title>New Person</title>

</head>

<body>
<header>
    <h1>PHP-Course</h1>
    <h3>New Person</h3>
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
		New	Person
		<a href="allPeoples.php">All Peoples</a>
        <a href="findPerson.php">Find Person</a>
		<a href="settings.php">Settings</a>
	</nav>
	
	<aside>
		
	</aside>
	<article>

<p><span class="error">* - required field.</span></p>

<!-- Jos lomaken käsittelevä php-koodi on samassa tiedostossa 
action arvoksi voi laittaa myös action="" eli tyhjän -->
<form action="" method="post">
<p>
   <label>Name:</label>
   
  <input name="name" type="text" size="15" value="<?php print (htmlentities($person->getName(), ENT_QUOTES, "UTF-8")); ?>"> 
  <span class="error">*<?php  print($person->getError($nameError)); ?></span>
</p>

<p>
   <label>Surname:</label>
    
   <input name="surname" type="text" size="15" value="<?php print (htmlentities($person->getSurname(), ENT_QUOTES, "UTF-8")); ?>"> 
   <span class="error">*<?php  print($person->getError($surnameError)); ?></span>
</p>

<p>   
   <label>Email:</label>
   <input name="email" type="text" size="25" value="<?php print (htmlentities($person->getEmail(), ENT_QUOTES, "UTF-8")); ?>">
   <span class="error">*<?php  print ($person->getError($emailError)); ?></span>
</p>
<p>      
   <label>Comment:</label> 
   <textarea name="comment" rows="4" cols="40"><?php print (htmlentities($person->getComment(), ENT_QUOTES, "UTF-8")); ?></textarea> 
   <span class="error" style="vertical-align:top">*<?php  print($person->getError($commentError)); ?></span><br>
</p>
<p>   
   <label>&nbsp;</label>
  <input name="submit" type="submit"  value="Submit">
  <input name="cancel" type="submit"  value="Cancel">
</p>

</form>
</article>

 <footer>made by Aleksandr Pantsesnyi</footer>
 
</body>
</html>