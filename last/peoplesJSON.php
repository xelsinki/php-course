<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 10.5.2017
 * Time: 9:02
 */

try {
    require_once "personPDO.php";

    // Luodaan tietokanta-luokan olio
    $db = new personPDO ();

    // Jos sivua pyytaneelta tuli hae eli kyseessa on nimella hakeminen
    if (isset ( $_GET ["name"] )) {
        $asked = $_GET ["name"];

        // Tehdään kantahaku, parametrina on nimi
        $result = $db->findPersonByName($asked);

        // Palautetaan vastaus JSON-tekstina
        print (json_encode ( $result )) ;

    }  // Kun hakukentä on tyhjä, niin haetaan kaikki henkilöt kannasta
    else {
        $result = $db->allPeoples();

        // Palautetaan vastaus JSON-tekstinä
        print json_encode ( $result );
    }
} catch ( Exception $error ) {
}
?>