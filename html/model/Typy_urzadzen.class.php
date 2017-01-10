<?php

class Typy_urzadzen {

    private $id_typu;
    private $nazwa_typu;
    private $szczegoly_typu;
 
    public function getId_Typu(){
        return $this->id_typu;
    }
    
    public function setId_Typu($id_typu) {
        $this->id_typu = $id_typu;
    }

    public function getNazwa_Typu(){
        return $this->nazwa_typu;
    }
    
    public function setNazwa_Typu($nazwa_typu) {
        $this->nazwa_typu = $nazwa_typu;
    }
    
    public function getSzczegoly_Typu() {
        return $this->szczegoly_typu;
    }
    
    public function setSzczegoly_Typu($szczegoly_typu) {
        $this->szczegoly_typu = $szczegoly_typu;
    }
}

?>
