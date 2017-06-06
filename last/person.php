<?php
class Person {
	
	// Virhekoodit ja virheilmoituksset
	private static $errorList = array(
			-1 => "Error",
			0 => "",
			1 => "Name is required",
			2 => "Name is too big or too small",
			3 => "Only letters and space & - allowed",
			11 => "Surame is required",
			12 => "Surname is too big or too small",
			21 => "Email  is required",
			22 => "Email is wrong",
			31 => "Comment is required",
			32 => "Comment is too big or too small"
	);
	
	// Palautta virheviestit
	public static function getError($error)
	{
		if (isset(self::$errorList[$error]))
			return self::$errorList[$error];
			
			return self::$errorList[-1];
	}
	
	// Attribuutit
    private $id;

   	private $name;
	private $surname;
	private $email;
	private $comment;
	
	
	// Constructor
	
	function __construct($newName = "", $newSurname = "", $newEmail = "", $newComment= "") {
		$this->name = trim($newName);
		$this->surname = trim($newSurname);
		$this->email = trim($newEmail);
		$this->comment= trim($newComment);
		
	}
	
	// Set, Get, Check - methods

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
	
	// Name
	public function setName($newName) {
		$this->name = $newName;
	}
	
	public function getName() {
		return $this->name;
	}
	
	// tarkistuksen ehdot: onko pakolinen, min & max merkkejä
	public function checkName($required = true, $min=2, $max=20) {
		
		// Jos kenttä saa olla tyhjä ja se on tyhjä, ei ole virhettä
		if ($required == false && strlen($this->name) == 0)
			return 0;
			
			// Jos kenttä on tyhjä
			if (strlen($this->name) == 0)
				return 1;
				
				// Kun on liian paljon tai liian vähän merkkejä
				if (strlen($this->name) < $min || strlen($this->name) > $max)
					return 2;
					
					// Tarkistaa kirjaimia ja vlilyönnit ja - merkki
					if (preg_match("/[^a-zåäöA-ZÅÄÖ \-]/", $this->name))
						return 3;
						
						// Kun ei ole virhettä
						return 0;
	}
	
	// Surname
	
	public function setSurname($newSurname) {
		$this->surname = $newSurname;
	}
	
	public function getSurname() {
		return $this->surname;
	}
	
	// tarkistuksen ehdot: onko pakolinen, min & max merkkejä
	public function checkSurname($required = true, $min=2, $max=20) {
		
		// Jos kenttä saa olla tyhjä ja se on tyhjä, ei ole virhettä
		if ($required == false && strlen($this->surname) == 0)
			return 0;
			
			// Jos kenttä on tyhjä
			if (strlen($this->surname) == 0)
				return 11;
				
				// Kun on liian paljon tai liian vähän merkkejä
				if (strlen($this->surname) < $min || strlen($this->surname) > $max)
					return 12;
					
					// Sama ilmoitus kun nimessä, käytän sen
					if (preg_match("/[^a-zåäöA-ZÅÄÖ \-]/", $this->surname))
						return 3;
						
						// Kun ei ole virhettä
						return 0;
	}
	
	// E-mail
	
	public function setEmail($newEmail) {
		$this->email = $newEmail;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function checkEmail($required = true) {
		
		if ($required == false && strlen($this->email) == 0)
			return 0;
			
			if (strlen($this->email) == 0)
				return 21;
				
				if (preg_match("[^a-zA-Z\.@0-9]", $this->email) || ! strstr($this->email, "@"))
					return 22;
					
					return 0;
	}
	
	// Comment
	
	public function setComment ($newComment) {
		$this->comment = $newComment;
	}
	
	public function getComment() {
		return $this->comment;
	}
	
	public function checkComment ($required = true, $min = 5, $max = 160) {
		
		if ($required == false && strlen($this->comment) == 0)
			return 0;
			
			if (strlen($this->comment) == 0)
				return 31;
				
				if (strlen($this->comment) < $min || strlen($this->comment) > $max)
					return 32;
					
					return 0;
	}
		
}
?>