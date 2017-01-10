<?php

class Urzadzenia {

    private $id_urzadzenia;
    private $nazwa_urzadzenia;
    private $szczegoly_urzadzenia;
    private $typy_urzadzen_id_typu;
    private $typ_urzadzenia;    
     
    public function getId_Urzadzenia(){
        return $this->id_urzadzenia;
    }
    
    public function setId_Urzadzenia($id_urzadzenia) {
        $this->id_urzadzenia = $id_urzadzenia;
    }

    public function getNazwa_Urzadzenia(){
        return $this->nazwa_urzadzenia;
    }
    
    public function setNazwa_Urzadzenia($nazwa_urzadzenia) {
        $this->nazwa_urzadzenia = $nazwa_urzadzenia;
    }
    
    public function getSzczegoly_Urzadzenia() {
        return $this->szczegoly_urzadzenia;
    }
    
    public function setSzczegoly_Urzadzenia($szczegoly_urzadzenia) {
        $this->szczegoly_urzadzenia = $szczegoly_urzadzenia;
    }

    public function getTypy_Urzadzen_Id_Typu() {
        return $this->typy_urzadzen_id_typu;
    }
    
    public function setTypy_Urzadzen_Id_Typu($typy_urzadzen_id_typu) {
        $this->typy_urzadzen_id_typu = $typy_urzadzen_id_typu;
    }

    public function getTyp_Urzadzenia(){
        return $this->typ_urzadzenia;
    }
    
    public function setTyp_Urzadzenia($typ_urzadzenia) {
        $this->typ_urzadzenia = $typ_urzadzenia;
    }      
    
}

?>
