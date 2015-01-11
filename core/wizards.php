<?php

// Creating accounts on the site
class Account{
    public function __construct($email){
        $this->email = $email;
    }

    public function email(){
        return $this->email;
    }
}


// A wizard controls which spells are available to cast, rating, level, things like that
class Wizard{
    // Use the identity to create a new 
    public function __construct($identity){
        $this->identity = $identity;
    }

    public function identity(){
        return $this->identity;
    }
}

// Create Wizard Accounts
class WizardFactory{
    // Create the new shell of a wizard by assigning an initial identity
    public static function create($identity){
        return new Wizard($identity);
    }

    // Get an existing wizard by id
    public static function id($id){
    }
}