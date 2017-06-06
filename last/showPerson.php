<!DOCTYPE>
<html>
<head>
<meta charset="utf8">
<link href="style.css" rel="stylesheet" type="text/css">
<title>Show Person</title>

</head>



<body>
<header>
    <h1>PHP-Course</h1>
    <h3>Show Person</h3>
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
        Show Person
        <a href="allPeoples.php">All Peoples</a>
        <a href="findPerson.php">Find Person</a>
        <a href="settings.php">Settings</a>
    </nav>
	
	<aside>
		
	</aside>
	
	<article>
<?php

require_once "person.php";
session_start();

if (isset($_SESSION["person"])) {
	
	$person = $_SESSION["person"];
}
else {
	$person = new Person();
}
// unset($_SESSION["person"]);

//Asetetaan Cookie:iin lisätyn henkilön nimi ja lisäysaika
setcookie("person", $person->getName(), time()+60*60*24*30);
$currenttime = date("d.m.Y", time());
setcookie("currenttime", $currenttime, time()+60*60*24*30);

//----------------------------------------------------

// // Jos painetaan SAVE, painiketta, niin...( tehdään sen myöhemmin)
if (isset($_POST["save"])){
	
	// echo "Saving not work yet!!!";

    try {
        require_once "personPDO.php";

        $database = new personPDO();  // Luo yhteyden kantaan
        $id = $database->newPerson($person);
        $person->setId($id);
        $_SESSION["person"]->setId($id);

    } catch ( Exception $error ) {
        print("<p> Error: " . $error->getMessage ());
        // header ( "location: virhe.php?sivu=Listaus&virhe=" . $error->getMessage() );
        exit ;
    }
    session_write_close();
    header("location: index.php");
    exit;

}
// jos on painettu Edit niin siirrytään takaisin newHenkilo sivulle
elseif (isset ( $_POST ["edit"] )) {
	($_SESSION["person"]);
	$_SESSION["person"] = $person;
	header ( "location: newHenkilo.php" );
	exit ();
}

// jos on painettu Cancel niin siirrytään etusivulle
elseif (isset ( $_POST ["cancel"] )) {
	unset($_SESSION["person"]);
	header ( "location: index.php" );
	exit ();
}

//----------------------------------------------------

	// Näytetään lisätyn henkilön tiedot
	print ("<p> Name: ".$person->getName());
	print ("<p> Surname: ".$person->getSurname());
	print ("<p> E-mail: ".$person->getEmail());
	print ("<p> Comment: ".$person->getComment());
	
	?>
<form action="" method="post">
<p>   
   <label>&nbsp;</label>

  <input name="save" type="submit"  value="Save">
  <input name="edit" type="submit"  value="Edit">
  <input name="cancel" type="submit"  value="Cancel">
</p>
</form>
<!-- Toisessa tehtävässä oli tehtävän annossa redirect ominaisuus, php-koodi alhalla-->
<!--<p>If no button is pressed, then after 10 seconds it will redirect to Home page </p>-->
</article>

 <footer>made by Aleksandr Pantsesnyi</footer>
 
</body>

<?php
//// Redirect index.php 10 sekunnin kuluttua. Laitetaan kyslymerkkijonoon added ja name.
//header ( "refresh:10; url=index.php?added=yes&name=" . $person->getName());
//exit;
//?>

</html>