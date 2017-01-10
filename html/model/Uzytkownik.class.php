<?php

class Uzytkownik {
	private $id_uzytkownika;
	private $login;	
        private $imie; 
        private $email;         
        private $haslo;
	private $czas_rejestracji;
	private $role = array();
               	
	public function getId_Uzytkownika(){
		return $this->id_uzytkownika;
	}
        
	public function setId_Uzytkownika($id_uzytkownika){
		$this->id_uzytkownika = $id_uzytkownika;
	}
        
	public function getLogin(){
		return $this->login;
	}
        
	public function setLogin($login){
		$this->login = $login;
	} 
        
	public function getImie(){
		return $this->imie;
	}
        
	public function setImie($imie){
		$this->imie = $imie;
	}
        
	public function getEmail(){
		return $this->email;
	}
        
	public function setEmail($email){
		$this->email = $email;
	}        

        public function getHaslo(){
		return $this->haslo;
	}
        
	public function setHaslo($haslo){
		$this->haslo = $haslo;
	}
        
        public function getCzas_Rejestracji(){
		return $this->czas_rejestracji;
	}
        
	public function setCzas_Rejestracji($czas_rejestracji){
		$this->czas_rejestracji = $czas_rejestracji;
	}        
        
	public function getRole(){
		return $this->role;
	}
	public function setRole($role){
		$this->role = $role;
	}	
}
?>