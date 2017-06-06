<!DOCTYPE>
<html>
<head>
<meta charset="utf8">
<link href="style.css" rel="stylesheet" type="text/css">
<title>All People</title>

</head>

<body>

<header>
    <h1>PHP-Course</h1>
    <h3>All Peoples</h3>
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
		All Peoples
        <a href="findPerson.php">Find Person</a>
        <a href="settings.php">Settings</a>
	</nav>
	
	<aside>
		
	</aside>

<article>
    <?php
    try {
        /*
         * Sama tiedsto näytää sekä nimilistan, että yksittäisen henkilön tietoja
         *
         * Nimilista tulostetaan foreach silmukan avulla
         */
        require_once "personPDO.php";

        // Näytetään yhden henkilön tietoja, kun painetaan show painiketta
        $personPDO = new personPDO ();
        if (isset ( $_POST ["show"] )) {
            $person = $personPDO->findPerson ( $_POST ["id"] );
            print ("<p>\n") ;

            $name = $person->getName ();
            $surname = $person->getSurname ();
            print ("name: $name $surname\n") ;

            $email = $person->getEmail ();
            $comment = $person->getComment();
            print ("<br>email: $email") ;

            print ("<br>comment: " . $person->getComment ()) ;
            print ("</p>") ;

            // Takaisin painike
            print ("<form action='' method='post'>\n") ;
            print ("<input type='submit' name='back' value='Back'>\n") ;
            print ("</form>\n") ;

        } else {

            // Poistetaan, kun painetaan DELETE painike
            if (isset ( $_POST ["delete"] )) {
                $personPDO->deletePerson( $_POST ["id"] );
            }

            $result =  $personPDO->allPeoples();

            // Tulostetaan taulu, jossa kannasta löytyneet henkilöt näytetään
            print ("<table>\n") ;
            foreach ($result as $person ) {
                print ("<tr>\n") ;

                print ("<td>" . $person->getId () . "</td>\n") ;

                $name = $person->getName ();
                $surname = $person->getSurname ();
                print ("<td>: $name $surname</td>\n") ;

                print ("<td><form action='' method='post'>\n") ;
                print ("<input type='hidden' name='id' value='" . $person->getId () . "'>\n") ;
                print ("<input type='submit' name='show' value='Show'>\n") ;
                print ("<input type='submit' name='delete' value='Delete'>\n") ;
                print ("</form></td>\n") ;

                print ("</tr>\n") ;
            }
            print ("</table>\n") ;
        }
    } catch ( Exception $error ) {
        header ( "location: error.php?error=" . $error->getMessage () );
        exit ();
    }
    ?>
</article>
	
	<footer>made by Aleksandr Pantsesnyi</footer>
</body>
 
</html>