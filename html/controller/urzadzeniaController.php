<?php

class urzadzeniaController extends baseController {

    //INDEX - LISTA URZADZEN DLA TYLKO ADMINA
  /*  public function index() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;       
        $login = isset($_SESSION['user']) ? $_SESSION['user'] : '';
        if ($db::isUserInRole($login, 'admin')) {
        $this->registry->template->results = $db::getUrzadzeniaList();
        }
        //else
        //{
        //$thisd ->registry->template->results = $db::getUrzadeniaListByLogin($login);   
        //}
        $this->registry->template->show('urzadzenia/urzadzenia_index');
    } */

    public function index() {
        //$this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;       
        $results = $db::getUrzadzeniaList();
        $urzadzenia = array();
        //if ($db::isUserInRole($login, 'admin')) {
        
        foreach ($results as $row) {
            $urzadzenie = new Urzadzenia();
            $urzadzenie->setId_Urzadzenia($row['id_urzadzenia']);              
            $urzadzenie->setNazwa_Urzadzenia($row['nazwa_urzadzenia']);
            $urzadzenie->setSzczegoly_Urzadzenia($row['szczegoly_urzadzenia']);
            $urzadzenie->setTypy_Urzadzen_Id_Typu($row['typy_urzadzen_id_typu']);
            $typ_urzadzenia = $db::getTypyUrzadzenById($row['typy_urzadzen_id_typu']);
            $urzadzenie->setTyp_Urzadzenia($typ_urzadzenia);
            $urzadzenia[] = $urzadzenie;        
        }

	$typy_urzadzen = array();
	$results = $db::getTypyUrzadzenList();
        foreach ($results as $row) {
            $typ_urzadzenia = new Typy_urzadzen();
            $typ_urzadzenia->setId_Typu($row['id_typu']);
            $typ_urzadzenia->setNazwa_Typu($row['nazwa_typu']);
            $typ_urzadzenia->setSzczegoly_Typu($row['szczegoly_typu']);
            $typy_urzadzen[] = $typ_urzadzenia;
        }
        $this->registry->template->urzadzenia = $urzadzenia;
        $this->registry->template->typy_urzadzen = $typy_urzadzen;
        $this->registry->template->show('urzadzenia/urzadzenia_index');
      //    }
    } 
    
    private function isUrzadzeniaNazwaAlreadyExists($nazwa_urzadzenia) {
        $db = $this->registry->db;
        $urzadzenie = $db::getUrzadzenieByNazwa($nazwa_urzadzenia);
        return !empty($urzadzenie);
    }    
    
    //DODANIE URZADZENIA
    public function add() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        $typy_urzadzenList = $db::getTypyUrzadzenList();
        $this->registry->template->typy_urzadzen = $typy_urzadzenList;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa_urzadzenia = trim($_POST['nazwa_urzadzenia']);
            $szczegoly_urzadzenia = trim($_POST['szczegoly_urzadzenia']);
            $typy_urzadzen_id_typu = trim($_POST['typ_urzadzenia']);
            
            if (empty($nazwa_urzadzenia)) {
                $error .= 'Proszę uzupełnić pole: nazwa urzadzenia.  <br />';
            }
          //  if (empty($szczegoly_urzadzenia)) {
          //      $error .= 'Proszę uzupełnić pole: szczegoly urzadzenia.  <br />';
          //  }
            if (empty($typy_urzadzen_id_typu)) {
                $error .= 'Proszę uzupełnić pole: typ urządzenia.  <br />';
            }             

            if ($this->isUrzadzeniaNazwaAlreadyExists($nazwa_urzadzenia)) {
                $error .= 'Urzadzenie z podaną nazwą już istnieje. <br />';
            }         

            if (empty($error)) {
                $urzadzenie = new Urzadzenia();          
                $urzadzenie->setNazwa_Urzadzenia($nazwa_urzadzenia);
                $urzadzenie->setSzczegoly_Urzadzenia($szczegoly_urzadzenia);
                $urzadzenie->setTypy_Urzadzen_Id_Typu($typy_urzadzen_id_typu);
                if ($db::addUrzadzenie($urzadzenie)) {
                    $success .= 'Dodano nowe urządzenie. <br />';
                } else {
                    $error .= 'Dodanie nowego urządzenia nie powiodło się. <br />';
                }
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
        }
        $this->registry->template->show('urzadzenia/urzadzenia_add');
    } 

    
    //EDYCJA URZADZENIA
    public function edit() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        $typy_urzadzenList = $db::getTypyUrzadzenList();
        $this->registry->template->typy_urzadzenAll = $typy_urzadzenList;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = trim($_POST['id']);
            $nazwa_urzadzenia = trim($_POST['nazwa_urzadzenia']);
            $szczegoly_urzadzenia = trim($_POST['szczegoly_urzadzenia']);
            $typy_urzadzen_id_typu = trim($_POST['typ_urzadzenia']);           
            
            if (empty($id)) {
                $error .= 'Błąd <br />';
            }            
            if (empty($nazwa_urzadzenia)) {
                $error .= 'Proszę uzupełnić pole: nazwa urzadzenia.  <br />';
            }
            if (empty($szczegoly_urzadzenia)) {
                $error .= 'Proszę uzupełnić pole: szczegoly urzadzenia.  <br />';
            }
            if (empty($typy_urzadzen_id_typu)) {
                $error .= 'Proszę uzupełnić pole: typ urządzenia.  <br />';
            }         
            
            
            if (empty($error)) {
                $urzadzenie = new Urzadzenia();      
                $urzadzenie->setId_Urzadzenia($id);                
                $urzadzenie->setNazwa_Urzadzenia($nazwa_urzadzenia);
                $urzadzenie->setSzczegoly_Urzadzenia($szczegoly_urzadzenia);
                $urzadzenie->setTypy_Urzadzen_Id_Typu($typy_urzadzen_id_typu);
                if ($db::updateUrzadzenie($urzadzenie)) {
                    $success .= 'Edycja urzadzenia powiodła się. <br />';
                } else {
                    $error .= 'Edycja urzadzenia nie powiodła się. <br />';
                }
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
            $this->registry->template->show('urzadzenia/urzadzenia_action_result');            
        } else {
            $id = $this->registry->id;

            $urzadzenie = $db::getUrzadzenieById($id);
            $this->registry->template->model = $urzadzenie;
        }
        $this->registry->template->show('urzadzenia/urzadzenia_edit');
    }

    //USUNIECIE URZADZENIA
    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $urzadzenie = new Urzadzenia();
                $id_urzadzenia = trim($_POST['id_urzadzenia']);
                $urzadzenie->setId_Urzadzenia($id_urzadzenia);
                if ($db::deleteUrzadzenie($urzadzenie)) {
                    $success .= 'Usunięto urzadzenie. <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się. <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/urzadzenia'   ;
                header("Location: $location");
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
            $this->registry->template->show('urzadzenia/urzadzenia_action_result');
        } else {
            $id_urzadzenia = $this->registry->id;
            $urzadzenie = $db::getUrzadzenieById($id_urzadzenia);
            $this->registry->template->model = $urzadzenie;
            $this->registry->template->show('urzadzenia/urzadzenia_delete');
        }
    }  
    
    
}

       