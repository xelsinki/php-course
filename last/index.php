

<?php
// Kun palataan etusivulle redirectillä tai muulla tavalla tehdään session tyhjennys,
// eli poistetaan lomakkeen tietoja
 session_start();
 // Tyhjennetään istuntomuuttujat palvelimelta
 $_SESSION = array();
 
 if (isset($_COOKIE[session_name()])) {
 	// Poistetaan istunnon tunniste käyttäjän koneelta
 	// Laitan suuri miinus arvo vaaralle, että käyttäjän koneella aika asennettu väärin
 	setcookie(session_name(), '', time()-365*24*60*60, '/');
 } 
 // Tuhotaan sessio
 session_destroy();
?>

<!DOCTYPE html>


<html>
  <head>
  <meta charset="UTF=8">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>
    PHP-Course
    </title>
  </head>
  
<body>
	<header>
	<h1>PHP-Course</h1>
	<h3>People register</h3>
<!--        Laitoin käyttäjän nimi tänne ylös headeriin-->
        <?php

        // Jos Cookie sisältää nimen, niin tulostetaan: Hello, "nimi"
        if (isset($_COOKIE["name"])) {
            print("Hello, " . $_COOKIE["name"] . " .");
        }
        ?>

    </header>
	<nav>
		Home page
		<a href="newHenkilo.php">New Person</a>
		<a href="allPeoples.php">All Peoples</a>
        <a href="findPerson.php">Find Person</a>
		<a href="settings.php">Settings</a>
	</nav>
	
	<aside>
		
	</aside>
	<article>

        <h2>Welcome!!!</h2>
	
        <h3>This is my homework of PHP-Course</h3>

        <ul>
           <li><a href="newHenkilo.php">New Person - all working good</a></li>

        </ul>

        <?php
        // Jos GET-kyslymerkkijonossa on addded & name
        // Tarkoittaa siis sitä, että tänne tultiin tietojen näyttösivulta,
        // eli lisättiin uusi henkilö
        if (isset($_GET["added"]) && isset($_GET["name"])) {
            print("<p>Added new person: " . $_GET["name"] . "</p>");
        }

        // Cookie luodulle henkilöölle, näyttää viimeksi luodun henkilön tietoja ja luontiaika

        elseif (isset($_COOKIE["person"]) && isset($_COOKIE["currenttime"])){

            print ("<p>Last added person was: ".$_COOKIE["person"]." at: ".$_COOKIE["currenttime"].".</p>");
        }
        ?>
	</article>
  <footer>made by Aleksandr Pantsesnyi</footer>
  </body>

</html>

