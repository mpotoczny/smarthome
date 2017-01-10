<?php

class pomieszczeniaController extends baseController {

    //INDEX - LISTA POMIESZCZENIA DLA TYLKO ADMINA
    public function index() {
        //$this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;       
        $login = isset($_SESSION['user']) ? $_SESSION['user'] : '';
        //if ($db::isUserInRole($login, 'admin')) {
        $this->registry->template->results = $db::getPomieszczeniaList();
        //}
        //else
        //{
        //$this->registry->template->results = $db::getPomieszczeniaListByLogin($login);   
        //}
        $this->registry->template->show('pomieszczenia/pomieszczenia_index');
    }
    
    private function isPomieszczeniaNazwaAlreadyExists($nazwa_pomieszczenia) {
        $db = $this->registry->db;
        $pomieszczenie = $db::getPomieszczenieByNazwa($nazwa_pomieszczenia);
        return !empty($pomieszczenie);
    }    
    
    //DODANIE POMIESZCZENIE
    public function add() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa_pomieszczenia = trim($_POST['nazwa_pomieszczenia']);
            $szczegoly_pomieszczenia = trim($_POST['szczegoly_pomieszczenia']);
            
            if (empty($nazwa_pomieszczenia)) {
                $error .= 'Proszę uzupełnić pole: nazwa pomieszczenia.  <br />';
            }
            if (empty($szczegoly_pomieszczenia)) {
                $error .= 'Proszę uzupełnić pole: szczegoly pomieszczenia.  <br />';
            }

            if ($this->isPomieszczeniaNazwaAlreadyExists($nazwa_pomieszczenia)) {
                $error .= 'Pomieszczenie z podaną nazwą już istnieje. <br />';
            }         
            
            if (empty($error)) {
                $pomieszczenie = new Pomieszczenia();          
                $pomieszczenie->setNazwa_Pomieszczenia($nazwa_pomieszczenia);
                $pomieszczenie->setSzczegoly_Pomieszczenia($szczegoly_pomieszczenia);
                if ($db::addPomieszczenie($pomieszczenie)) {
                    $success .= 'Dodano nowe pomieszczenie. <br />';
                } else {
                    $error .= 'Dodanie nowego pomieszczenia nie powiodło się. <br />';
                }
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
        }
        $this->registry->template->show('pomieszczenia/pomieszczenia_add');
    }    

    //EDYCJA POMIESZCZENIA
    public function edit() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa_pomieszczenia = trim($_POST['nazwa_pomieszczenia']);
            $szczegoly_pomieszczenia = trim($_POST['szczegoly_pomieszczenia']);
            
            if (empty($nazwa_pomieszczenia)) {
                $error .= 'Proszę uzupełnić pole: nazwa pomieszczenia.  <br />';
            }
            if (empty($szczegoly_pomieszczenia)) {
                $error .= 'Proszę uzupełnić pole: szczegoly pomieszczenia.  <br />';
            }         
            
            if (empty($error)) {
                $pomieszczenie = new Pomieszczenia();
                $id_pomieszczenia = trim($_POST['id_pomieszczenia']);
                $pomieszczenie->setId_Pomieszczenia($id_pomieszczenia);                
                $pomieszczenie->setNazwa_Pomieszczenia($nazwa_pomieszczenia);
                $pomieszczenie->setSzczegoly_Pomieszczenia($szczegoly_pomieszczenia);
    
                //$pomieszczenie->setRole(array());
                if ($db::updatePomieszczenie($pomieszczenie)) {
                    $success .= 'Edycja pomieszczenia powiodła się. <br />';
                } else {
                    $error .= 'Edycja pomieszczenia nie powiodła się. <br />';
                }
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
        } else {
            $id_pomieszczenia = $this->registry->id;

            $pomieszczenie = $db::getPomieszczenieById($id_pomieszczenia);
            $this->registry->template->model = $pomieszczenie;
        }
        $this->registry->template->show('pomieszczenia/pomieszczenia_edit');
    }    

    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $pomieszczenie = new Pomieszczenia();
                $id_pomieszczenia = trim($_POST['id_pomieszczenia']);
                $pomieszczenie->setId_Pomieszczenia($id_pomieszczenia);
                if ($db::deletePomieszczenie($pomieszczenie)) {
                    $success .= 'Usunięto pomieszczenie. <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się. <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/pomieszczenia'   ;
                header("Location: $location");
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
            $this->registry->template->show('pomieszczenia/pomieszczenia_action_result');
        } else {
            $id_pomieszczenia = $this->registry->id;
            $pomieszczenie = $db::getPomieszczenieById($id_pomieszczenia);
            $this->registry->template->model = $pomieszczenie;
            $this->registry->template->show('pomieszczenia/pomieszczenia_delete');
        }
    }  
    
    
}