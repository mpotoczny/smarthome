<?php

class Pomieszczenia {

    private $id_pomieszczenia;
    private $nazwa_pomieszczenia;
    private $szczegoly_pomieszczenia;
 
    public function getId_Pomieszczenia(){
        return $this->id_pomieszczenia;
    }
    
    public function setId_Pomieszczenia($id_pomieszczenia) {
        $this->id_pomieszczenia = $id_pomieszczenia;
    }

    public function getNazwa_Pomieszczenia(){
        return $this->nazwa_pomieszczenia;
    }
    
    public function setNazwa_Pomieszczenia($nazwa_pomieszczenia) {
        $this->nazwa_pomieszczenia = $nazwa_pomieszczenia;
    }
    
    public function getSzczegoly_Pomieszczenia() {
        return $this->szczegoly_pomieszczenia;
    }
    
    public function setSzczegoly_Pomieszczenia($szczegoly_pomieszczenia) {
        $this->szczegoly_pomieszczenia = $szczegoly_pomieszczenia;
    }
}

?>
