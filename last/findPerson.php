
<!DOCTYPE html>


<html>
  <head>
  <meta charset="UTF=8">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>
    Find Person
    </title>
      <script type="text/javascript">

          function getPerson() {
              var xmlhttp = new XMLHttpRequest();

              xmlhttp.onreadystatechange=function() {

                  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                      // PHP-sivulta tulleen vastauksen käsittelee listPeoples-funktio
                      // xmlhttp.responseText sisältää PHP-sivulta saadun JSON-tekstin
                      listPeoples(xmlhttp.responseText);
                  }
              }

            // Pyydetään PHP-sivua
              var name = document.hlo.nimi.value;
              xmlhttp.open("GET", "peoplesJSON.php?name=" + name, true);
              xmlhttp.send();
          }

          function listPeoples(response) {
              // Muunnetaan JSON-teksti vastaavaksi Javascript-rakenteeksi
              // Tässä tilanteessa muunnoksen tulos on taulukko, koska PHP-sivu
              // lähetti taulukkoa vastaavan rakenteen
              var result = JSON.parse(response);
              var i;
              var text = "";

              // Käsitellään taulukko
              for(i = 0; i < result.length; i++) {
                  text = text + "<p>" + result[i].name + " " + result[i].surname +
                      "<br>" + result[i].email + ", " + result[i].comment +
                      "</p>";
              }

              // Laitetaan taulukon käsittelyn tuloksena tullut teksti HTML-elementtiin
              document.getElementById("lista").innerHTML = text;
          }
      </script>
  </head>

<body>
<header>
    <h1>PHP-Course</h1>
    <h3>Find Person</h3>
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
        Find Person
        <a href="settings.php">Settings</a>
	</nav>

	<aside>

	</aside>
    <article>
        <form name="hlo" action="findPerson.php" method="post">
            <label>name:</label> <input type="text" name="nimi"> <input
                    type="button" value="Find" onclick="getPerson()">
        </form>
        <div id="lista"></div>
    </article>
<footer>made by Aleksandr Pantsesnyi</footer>
</body>

</html>

