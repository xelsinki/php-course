<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 09.5.2017
 * Time: 13:12
 */
?>
<!DOCTYPE>
<html>
<head>
<meta charset="utf8">
<link href="style.css" rel="stylesheet" type="text/css">
<title>Error</title>

</head>

<body>
<header>
	<h1>PHP-Course</h1>
	<h3>All Peoples</h3>
	</header>

<nav>
    <a href="index.php">Home page</a>
    <a href="newHenkilo.php">New Person</a>
    <a href="allPeoples.php">All Peoples</a>
    Find Person
    <a href="settings.php">Settings</a>
</nav>

	<aside>

	</aside>

<article>
    <?php
    if (isset ( $_GET ["error"] ))
        print ("<p>" . stripcslashes ( $_GET ["error"] ) . "</p>") ;
    else
        print ("<p>Unknow error</p>") ;
    ?>
</article>

<footer>made by Aleksandr Pantsesnyi</footer>
</body>

</html>