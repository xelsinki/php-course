<!DOCTYPE>
<html>
<head>
<meta charset="utf8">
<link href="style.css" rel="stylesheet" type="text/css">
<title>new Person</title>

</head>

<?php

require_once "person.php";

// // Jos painetaan talleta, painiketta, niin tarkistetaan kentät
if (isset($_POST["submit"])){
   // Muodostetaan olio lomakekenttien tiedoilla
   // Lomakkeen kenttiin viitataan $_POST["kentan_nimi"), koska form method="post"
	$var = new Person($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["comment"]);	
   
   // Tarkastetaan virheet
	$nameError = $var->checkName();
	$surnameError = $var->checkSurname();
	$emailError= $var->checkEmail();
	$commentError= $var->checkComment();  
}
// Sivulle tultiin ekaa kertaa 
else {
   // Muodostetaan olio oletustiedoilla eli tyhjillä tiedoilla
	$var = new Person();
   
   // Laitetaan virhekoodit 0 => eli ei virheitä
	$nameError= 0;
	$surnameError= 0;
	$emailError= 0;
	$commentError= 0;
}
?>


<body>
<h3>New Person</h3>
<p><span class="error">* - required field.</span></p>
<!-- Jos lomaken käsittelevä php-koodi on samassa tiedostossa 
action arvoksi voi laittaa myös action=""  -->
<form action="" method="post">
<p>
   <label>Name:</label>
   
  <input name="name" type="text" size="15" value="<?php print (htmlentities($var->getName(), ENT_QUOTES, "UTF-8")); ?>"> 
  <span class="error">*<?php  print($var->getError($nameError)); ?></span>
</p>

<p>
   <label>Surname:</label>
    
   <input name="surname" type="text" size="15" value="<?php print (htmlentities($var->getSurname(), ENT_QUOTES, "UTF-8")); ?>"> 
   <span class="error">*<?php  print($var->getError($surnameError)); ?></span>
</p>

<p>   
   <label>Email:</label>
   <input name="email" type="text" size="25" value="<?php print (htmlentities($var->getEmail(), ENT_QUOTES, "UTF-8")); ?>">
   <span class="error">*<?php  print ($var->getError($emailError)); ?></span>
</p>
<p>      
   <label>Comment:</label> 
   <textarea name="comment" rows="4" cols="40"><?php print (htmlentities($var->getComment(), ENT_QUOTES, "UTF-8")); ?></textarea> 
   <span class="error" style="vertical-align:top">*<?php  print($var->getError($commentError)); ?></span><br>
</p>
<p>   
   <label>&nbsp;</label>
  <input name="submit" type="submit" value="Submit">
</p>
</form>

</body>
 <footer>made by Aleksandr Pantsesnyi</footer>
</html>