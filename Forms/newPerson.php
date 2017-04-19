<!DOCTYPE HTML>  
<html>
<head>
<meta charset="utf8">
<link href="style.css" rel="stylesheet" type="text/css">


</head>
<body>  

<?php
// luodaan muuttujat ja annetaan arvoksi "null"
$name = $surname = $email = $phone = $comment = "";
// luodaan Virheiden muuttujat ja annetaan arvoksi "null"
$nameError = $surnameError = $emailError = $phoneError = $commentError = "";


// Lähettää syötettyjä tietoja tarkistettavaksi seuraavalle motodille ja tyhjentää kentät
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Tarkistetaan onko tiedot syötetty
	if (empty($_POST["name"])) {
		$nameError = "Name is required";
	} else {
		$name = test_input_data($_POST["name"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameError = "Only letters and space allowed";
		}
		
	}
	if (empty($_POST["surname"])) {
		$surnameError = "Surame is required";
	} else {
		$surname = test_input_data($_POST["surname"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$surname)) {
			$surnameError = "Only letters and space allowed";
		}
	}
	
	if (empty($_POST["email"])) {
		$emailError = "E-mail is required";
	} else {
		$email= test_input_data($_POST["email"]);
		// tarkistetaan onko sähköposti oikeassa muodossa
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErroor = "Invalid email format";
		}
	}
	
	// Phone ja comment ei ole pakollisia kentiä, niin ei ole viesti kun tyhjä
	
	if (empty($_POST["phone"])) {
		$phoneError = "";
	} else {
		$phone= test_input_data($_POST["phone"]);
		// Jos puhelin on syötetty, niin se pitää koostua numeroista
		if (!is_numeric($phone)) {
			$phoneError = "Only numbers allowed";
		}
	}
	
	if (empty($_POST["comment"])) {
		$commentError = "";
	} else {
		$comment = test_input_data($_POST["comment"]);
	}
}

// metodi joka valmistaa ja tarkistaa syötetty tieto: 
//poista välilyönnit, poista vinoviivat, poista HTML tagit 
function test_input_data($data) {
	//poista välilyönnit
	$data = trim($data);
	//poista vinoviivat(slash)
	$data = stripslashes($data);
	// poista HTML merkit, että ei voisi syöttää skriptia
	$data = htmlspecialchars($data);
	// poista HTML tagit koodista täysin
	$data = strip_tags($data);
	return $data;
}
?>
<!-- Lomakkeen HTML osio -->
<h2>Insert new person data</h2>
<p><span class="error">* - required field.</span></p>

<!-- Lomake käsittelysivu on sama missä php-skripti on,
 htmlspecialchars ei anna vaihtaa osoitetta ja  lähettää tiedot muualle -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
 <label>Name:</label>  <input type="text" name="name" value="<?php echo $name;?>">
  <!-- Tulostaa ilmoitus virheestä -->
  <span class="error">* <?php echo $nameError;?></span>
  <br><br>
  <label>Surname:</label> <input type="text" name="surname" value="<?php echo $surname;?>">
  <span class="error">* <?php echo $surnameError;?></span>
  <br><br>
  <!-- type="email" tarkistaa oikeinkirjoituksen HTML tasolla -->
  <label>E-mail:</label> <input type="email" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailError;?></span>
  <br><br>
  <!-- Tänne voi laittaa type="number, mutta tein tarkistuksen php-koodissa"  -->
  <label>Phone:</label> <input type="text" name="phone" value="<?php echo $phone;?>">
  <span class="error"> <?php echo $phoneError;?></span>
  <br><br>
  <label>Comment:</label>
  <textarea style="vertical-align:top" name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  	<label>&nbsp;</label> 
  	<input type="submit" name="submit"	value="Submit"> 
  	
    
</form>

<p>
<?php
// Tulostaa syötettyjä tietoja
echo "<h2>New person data:</h2>";
echo $name;
echo "<br>";
echo $surname;
echo "<br>";
echo $email;
echo "<br>";
echo $phone;
echo "<br>";
echo $comment;
?>
</p>

</body>
 <footer>made by Aleksandr Pantsesnyi</footer>
</html>
