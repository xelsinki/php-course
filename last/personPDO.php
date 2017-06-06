<?php
require_once ("person.php");

class personPDO {

    private $connection;
    private $count;
    private static $virhelista = array (
        - 1 => "Virheellinen tieto",
        0 => "",
        1 => "Yhteys ei onnistu",
        6 => "Kaikkien haku ei onnistunut",
        7 => "Lisäys ei onnistunut",
        8 => "Haku ei onnistunut",
        9 => "Poisto ei onnistunut"
    );

    /*
     * // Metodit mitkä tulevat suoraan PDO.php:sta & PDOStatement.php
     *
     * fetchObject(), rowCount(), lastInsertId(), setAttribute(), prepare(), etc..
     *
     * http://php.net/manual/ru/class.pdo.php
     */

    function __construct($dsn = "mysql:host=localhost;dbname=a1402978", $user = "a1402978", $password = "xiSYxF76w") {
        // Ota yhteys kantaan
        if (! $this->connection = new PDO ( $dsn, $user, $password ))
            throw new Exception ( $virhelista [1], 1 );

        // Virheiden jäljitys kehitysaikana
        $this->connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

        // Tulosrivien määrä
        $this->count = 0;
    }

    function getCount() {
        return $this->count;
    }

    // --------------- All Peoples  --------------------------------
    public function allPeoples() {
        $sql = "SELECT id, name, surname, email, comment
		        FROM person";

        // Valmistellaan lause
        if (! $stmt = $this->connection->prepare ( $sql ))
            throw new Exception ( $virhelista [6], 6 );

        // Aja lauseke
        if (! $stmt->execute ())
            throw new Exception ( $virhelista [6], 6 );

        // Käsittele hakulausekkeen tulos
        $result = array();

        while ( $row = $stmt->fetchObject () ) {
            // Tehdään tietokannasta haetusta rivistä person-luokan olio
            $person = new Person ();

            $person->setId($row->id);
            $person->setName(utf8_encode($row->name));
            $person->setSurname(utf8_encode($row->surname));
            $person->setEmail(utf8_encode($row->email));
            $person->setComment($row->comment);


            // Laitetaan olio tulos taulukkoon (olio-taulukkoon)
            $result [] = $person;
        }

        // Lasketaan rivien määärää
        $this->count = $stmt->rowCount();

        return $result;
    }

    // --------------- Find Person by NAME  --------------------------------

    public function findPersonByName($name) {
        $sql = "SELECT id, name, surname, email, comment 
                FROM person 
                WHERE name like :name";

        // Valmistellaan lause
        if (! $stmt = $this->connection->prepare ( $sql ))
            throw new Exception ( $virhelista [8], 8 );

        // Laita parametrit
        $nm = "%" . utf8_decode ( $name ) . "%";
        $stmt->bindValue ( ":name", $nm );

        // Aja lauseke
        if (! $stmt->execute ())
            throw new Exception ( $virhelista [8], 8 );

        // Käsittele hakulausekkeen tulos
        $result = array ();
        while ( $row = $stmt->fetchObject () ) {
            $person = new Person ();

            $person->setId($row->id);
            $person->setName(utf8_encode($row->name));
            $person->setSurname(utf8_encode($row->surname));
            $person->setEmail(utf8_encode($row->email));
            $person->setComment(utf8_encode($row->comment));


            // Laitetaan olio tulos taulukkoon (olio-taulukkoon)
            $result [] = $person;
        }

        $this->count = $stmt->rowCount ();

        return $result;
    }

    // --------------- Find Person by ID  --------------------------------

    public function findPerson($id) {
        $sql = "SELECT id, name, surname, email, comment 
                FROM person 
                WHERE id=:id";

        // Valmistellaan lause
        if (! $stmt = $this->connection->prepare ( $sql ))
            throw new Exception ( $virhelista [8], 8 );

        // Laita parametrit
        $stmt->bindValue ( ":id", $id );

        // Aja lauseke
        if (! $stmt->execute ())
            throw new Exception ( $virhelista [8], 8 );

        // Käsittele hakulausekkeen tulos
        $row = $stmt->fetchObject ();
        if ($stmt->rowCount() == 1) {
            $person = new Person ();

            $person->setId ( $row->id );
            $person->setName ( utf8_encode ( $row->name ) );
            $person->setSurname ( utf8_encode ( $row->surname ) );
            $person->setEmail ( utf8_encode ( $row->email) );
            $person->setComment ( utf8_encode($row->comment ));

        } else {
            $person = null;
        }

        $this->count = $stmt->rowCount ();

        return $person;
    }

    // --------------- Add new Person  --------------------------------

    function newPerson($person) {
        $sql = "insert into person (name, surname, email, comment)
		        values (:name, :surname, :email, :comment)";

        // Valmistellaan SQL-lause
        if (! $stmt = $this->connection->prepare ( $sql ))
            throw new Exception ( $virhelista [7], 7 );

        // Parametrien sidonta
        $stmt->bindValue ( ":name", utf8_decode ( $person->getName() ), PDO::PARAM_STR );
        $stmt->bindValue ( ":surname", utf8_decode ( $person->getSurname () ), PDO::PARAM_STR );
        $stmt->bindValue ( ":email", utf8_decode ( $person->getEmail () ), PDO::PARAM_STR );
        $stmt->bindValue ( ":comment", utf8_decode ( $person->getComment () ), PDO::PARAM_STR );

        // Suoritetaan SQL-lause (insert)
        if (! $stmt->execute ())
            throw new Exception ( $virhelista [7], 7 );


        $this->count = $stmt->rowCount ();

        return $this->connection->lastInsertId ();
    }

    // --------------- Delete Person by ID  --------------------------------
    public function deletePerson($id) {
        $sql = "DELETE FROM person WHERE id=:id";

        // Valmistellaan lause
        if (! $stmt = $this->connection->prepare ( $sql ))
            throw new Exception ( $virhelista [9], 9 );

        // Laita parametrit
        $stmt->bindValue ( ":id", $id );

        // Aja lauseke
        if (! $stmt->execute ())
            throw new Exception ( $virhelista [9], 9 );

        // Suoritetaan SQL-lause
        if (! $stmt->execute ())
            throw new Exception ( $virhelista [9], 9 );

        $this->count = $stmt->rowCount ();
    }
}
?>
