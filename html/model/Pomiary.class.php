<?php

class Pomiary {
  
    private $id_pomiaru;
    private $szczegoly_pomiaru;
    private $wartosc;
    private $czas_pomiaru;    
    private $pomieszczenia_id_pomieszczenia;  
    private $urzadzenia_id_urzadzenia;
    private $pomieszczenie;
    private $urzadzenie;
    
    public function getId_Pomiaru() {
        return $this->id_pomiaru;
    }
    
    public function setId_Pomiaru($id_pomiaru) {
        $this->id_pomiaru = $id_pomiaru;
    }

    public function getSzczegoly_Pomiaru(){
        return $this->szczegoly_pomiaru;
    }
    
    public function setSzczegoly_Pomiaru($szczegoly_pomiaru) {
        $this->szczegoly_pomiaru = $szczegoly_pomiaru;
    }

    public function getWartosc(){
        return $this->wartosc;
    }
    
    public function setWartosc($wartosc) {
        $this->wartosc = $wartosc;
    }
    
    public function getCzas_Pomiaru() {
        return $this->czas_pomiaru;
    }
    
    public function setCzas_Pomiaru($czas_pomiaru) {
        $this->czas_pomiaru = $czas_pomiaru;
    }
    
    public function getPomieszczenia_Id_Pomieszczenia() {
        return $this->pomieszczenia_id_pomieszczenia;
    }
    
    public function setPomieszczenia_Id_Pomieszczenia($pomieszczenia_id_pomieszczenia) {
        $this->pomieszczenia_id_pomieszczenia = $pomieszczenia_id_pomieszczenia;
    }   
    
    public function getUrzadzenia_Id_Urzadzenia(){
        return $this->urzadzenia_id_urzadzenia;
    }
    
    public function setUrzadzenia_Id_Urzadzenia($urzadzenia_id_urzadzenia) {
        $this->urzadzenia_id_urzadzenia = $urzadzenia_id_urzadzenia;
    }     

    public function getPomieszczenie(){
        return $this->pomieszczenie;
    }
    
    public function setPomieszczenie($pomieszczenie) {
        $this->pomieszczenie = $pomieszczenie;
    }    

    public function getUrzadzenie(){
        return $this->urzadzenie;
    }
    
    public function setUrzadzenie($urzadzenie) {
        $this->urzadzenie = $urzadzenie;
    }     
    
}

?>
