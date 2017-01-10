<?php

class pomiaryController extends baseController {

    //INDEX - LISTA POMIESZCZENIA DLA TYLKO ADMINA
    public function index() {
        //$this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;       
        
        $results = $db::getPomiaryList();
        $pomiary = array();
        foreach ($results as $row) {
            $pomiar = new Pomiary();
            $pomiar->setId_Pomiaru($row['id_pomiaru']);
            $pomiar->setSzczegoly_Pomiaru($row['szczegoly_pomiaru']);
            $pomiar->setWartosc($row['wartosc']);
            $pomiar->setCzas_Pomiaru($row['czas_pomiaru']);
            $pomiar->setPomieszczenia_Id_Pomieszczenia($row['pomieszczenia_id_pomieszczenia']);
            $pomiar->setUrzadzenia_Id_Urzadzenia($row['urzadzenia_id_urzadzenia']);            
            $urzadzenie = $db::getUrzadzenieById($row['urzadzenia_id_urzadzenia']);
            $pomieszczenie = $db::getPomieszczenieById($row['pomieszczenia_id_pomieszczenia']);
            $pomiar->setUrzadzenie($urzadzenie);
            $pomiar->setPomieszczenie($pomieszczenie);
            $pomiary[] = $pomiar;
        }        
               
        $this->registry->template->pomiary = $pomiary;

        $this->registry->template->show('pomiary/pomiary_index');        
        
    }
    
    //DODANIE URZADZENIA
    public function add() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";       
        $db = $this->registry->db;
        $urzadzeniaList = $db::getUrzadzeniaList();
        $pomieszczeniaList = $db::getPomieszczeniaList();
        $this->registry->template->urzadzenia = $urzadzeniaList;
        $this->registry->template->pomieszczenia = $pomieszczeniaList;         
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $szczegoly_pomiaru = trim('szczegoly_pomiaru');
            $wartosc = trim($_POST['wartosc']);
            $czas_pomiaru = trim($_POST['czas_pomiaru']);
            
            $pomieszczenia_id_pomieszczenia = trim($_POST['pomieszczenie']);
            $urzadzenia_id_urzadzenia = trim($_POST['urzadzenie']);            
                  
            if (empty($wartosc)) {
                $error .= 'Proszę uzupełnić pole: wartość.  <br />';
            }

            if (empty($szczegoly_pomiaru)) {
                $error .= 'Proszę uzupełnić pole: szczegóły pomiaru.  <br />';
            }            
            
            if (empty($pomieszczenia_id_pomieszczenia)) {
                $error .= 'Proszę uzupełnić pole: nazwa pomieszczenia.  <br />';
            }         

            if (empty($urzadzenia_id_urzadzenia)) {
                $error .= 'Proszę uzupełnić pole: nazwa urzadzenia.  <br />';
            }             
            
            
            
            

            if (empty($error)) {
                $pomiar = new Pomiary();
                $pomiar->setId_Pomiaru($pomiar);
                $pomiar->setSzczegoly_Pomiaru($szczegoly_pomiaru);
                $pomiar->setWartosc($wartosc);
                $pomiar->setCzas_Pomiaru($czas_pomiaru);
                $pomiar->setPomieszczenia_Id_Pomieszczenia($pomieszczenia_id_pomieszczenia);
                $pomiar->setUrzadzenia_Id_Urzadzenia($urzadzenia_id_urzadzenia);
                
                if ($db::addPomiar($pomiar)) {
                    $success .= 'Dodano nowy pomiar. <br />';
                } else {
                    $error .= 'Dodanie nowego pomiaru nie powiodło się. <br />';
                }
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
        }
        $this->registry->template->show('pomiary/pomiary_add');
    } 

    
    
    public function edit() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        $urzadzeniaList = $db::getUrzadzeniaList();
        $pomieszczeniaList = $db::getPomieszczeniaList();
        
        $this->registry->template->urzadzeniaAll = $urzadzeniaList;
        $this->registry->template->pomieszczeniaAll = $pomieszczeniaList;        
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $id = trim($_POST['id']);
            $szczegoly_pomiaru = trim('szczegoly_pomiaru');
            $wartosc = trim($_POST['wartosc']);
            $czas_pomiaru = trim($_POST['czas_pomiaru']);
            
            $pomieszczenia_id_pomieszczenia = trim($_POST['pomieszczenie']);
            $urzadzenia_id_urzadzenia = trim($_POST['urzadzenie']);            
            
            
            if (empty($id)) {
                $error .= 'Błąd (id) <br />';
            }            
            if (empty($wartosc)) {
                $error .= 'Proszę uzupełnić pole: wartość.  <br />';
            }
            if (empty($czas_pomiaru)) {
                $error .= 'Proszę uzupełnić pole: czas pomiaru.  <br />';
            }
            if (empty($szczegoly_pomiaru)) {
                $error .= 'Proszę uzupełnić pole: szczegóły pomiaru.  <br />';
            }            
            
            if (empty($pomieszczenia_id_pomieszczenia)) {
                $error .= 'Proszę uzupełnić pole: nazwa pomieszczenia.  <br />';
            }         

            if (empty($urzadzenia_id_urzadzenia)) {
                $error .= 'Proszę uzupełnić pole: nazwa urzadzenia.  <br />';
            }             
            
            if (empty($error)) {
                $pomiar = new Pomiary();
                $pomiar->setId_Pomiaru($pomiar);
                $pomiar->setSzczegoly_Pomiaru($szczegoly_pomiaru);
                $pomiar->setWartosc($wartosc);
                $pomiar->setCzas_Pomiaru($czas_pomiaru);
                $pomiar->setPomieszczenia_Id_Pomieszczenia($pomieszczenia_id_pomieszczenia);
                $pomiar->setUrzadzenia_Id_Urzadzenia($urzadzenia_id_urzadzenia);                
                
                
                if ($db::updatePomiary($pomiar)) {
                    $success .= 'Edycja pomiaru powiodła się. <br />';
                } else {
                    $error .= 'Edycja pomiaru nie powiodła się. <br />';
                }
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
            $this->registry->template->show('pomiary/pomiary_action_result');            
        } else {
            $id = $this->registry->id;

            $pomiar = $db::getPomiarById($id);
            $this->registry->template->model = $pomiar;
        }
        $this->registry->template->show('pomiary/pomiary_edit');
    
        
      }
      
  //USUNIECIE URZADZENIA
    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $pomiar = new Pomiary();
                $id_pomiaru = trim($_POST['id_pomiaru']);
                $pomiar->setId_Pomiaru($id_pomiaru);
                if ($db::deletePomiar($pomiar)) {
                    $success .= 'Usunięto pomiar. <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się. <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/pomiary'   ;
                header("Location: $location");
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
            $this->registry->template->show('pomiary/pomiary_action_result');
        } else {
            $id_pomiaru = $this->registry->id;
            $pomiar = $db::getPomiarById($id_pomiaru);
            $this->registry->template->model = $pomiar;
            $this->registry->template->show('pomiary/pomiary_delete');
        }
    }        
      
      
    
    
}    