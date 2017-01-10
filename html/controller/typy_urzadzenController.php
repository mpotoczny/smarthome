<?php

class typy_urzadzenController extends baseController {

    //INDEX - LISTA URZADZEN DLA TYLKO ADMINA
    public function index() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;       
        $login = isset($_SESSION['user']) ? $_SESSION['user'] : '';
        if ($db::isUserInRole($login, 'admin')) {
        $this->registry->template->results = $db::getTypyUrzadzenList();
        }
        //else
        //{
        //$thisd ->registry->template->results = $db::getUrzadeniaListByLogin($login);   
        //}
        $this->registry->template->show('typy_urzadzen/typy_urzadzen_index');
    }
    
    private function isTypyUrzadzenNazwaAlreadyExists($nazwa_typu) {
        $db = $this->registry->db;
        $typ_urzadzen = $db::getTypyUrzadzenByNazwa($nazwa_typu);
        return !empty($typ_urzadzen);
    }    
    
    //DODANIE URZADZENIA
    public function add() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa_typu = trim($_POST['nazwa_typu']);
            $szczegoly_typu = trim($_POST['szczegoly_typu']);
            
            if (empty($nazwa_typu)) {
                $error .= 'Proszę uzupełnić pole: nazwa typu urządzeń.  <br />';
            }
            if (empty($szczegoly_typu)) {
                $error .= 'Proszę uzupełnić pole: szczegóły typu urządzeń.  <br />';
            }

            if ($this->isTypyUrzadzenNazwaAlreadyExists($nazwa_typu)) {
                $error .= 'Typ urządzeń z podaną nazwą już istnieje. <br />';
            }         
            
            if (empty($error)) {
                $typ_urzadzen = new Typy_urzadzen();          
                $typ_urzadzen->setNazwa_Typu($nazwa_typu);
                $typ_urzadzen->setSzczegoly_Typu($szczegoly_typu);
                if ($db::addTypyUrzadzen($typ_urzadzen)) {
                    $success .= 'Dodano nowy typ urządzeń. <br />';
                } else {
                    $error .= 'Dodanie nowego typu urządzeń nie powiodło się. <br />';
                }
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
        }
        $this->registry->template->show('typy_urzadzen/typy_urzadzen_add');
    }    

    //EDYCJA URZADZENIA
    public function edit() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa_typu = trim($_POST['nazwa_typu']);
            $szczegoly_typu = trim($_POST['szczegoly_typu']);
            
            if (empty($nazwa_typu)) {
                $error .= 'Proszę uzupełnić pole: nazwa typu urzadzenia.  <br />';
            }
            if (empty($szczegoly_typu)) {
                $error .= 'Proszę uzupełnić pole: szczegoly urzadzenia.  <br />';
            }         
            
            if (empty($error)) {
                $typ_urzadzen = new Typy_urzadzen();
                $id_typu = trim($_POST['id_typu']);
                $typ_urzadzen->setId_Typu($id_typu);                
                $typ_urzadzen->setNazwa_Typu($nazwa_typu);
                $typ_urzadzen->setSzczegoly_Typu($szczegoly_typu);
    
                //$typ_urzadzen->setRole(array());
                if ($db::updateTypyUrzadzen($typ_urzadzen)) {
                    $success .= 'Edycja typu urządzeń powiodła się. <br />';
                } else {
                    $error .= 'Edycja typu urządzeń nie powiodła się. <br />';
                }
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
        } else {
            $id_typu = $this->registry->id;

            $typ_urzadzen = $db::getTypyUrzadzenById($id_typu);
            $this->registry->template->model = $typ_urzadzen;
        }
        $this->registry->template->show('typy_urzadzen/typy_urzadzen_edit');
    }    

    //USUNIECIE URZADZENIA
    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $typ_urzadzen = new Typy_urzadzen();
                $id_typu = trim($_POST['id_typu']);
                $typ_urzadzen->setId_Typu($id_typu);
                if ($db::deleteTypyUrzadzen($typ_urzadzen)) {
                    $success .= 'Usunięto typ urządzeń. <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się. <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/typy_urzadzen'   ;
                header("Location: $location");
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
            $this->registry->template->show('typy_urzadzen/typy_urzadzen_action_result');
        } else {
            $id_typu = $this->registry->id;
            $typ_urzadzen = $db::getTypyUrzadzenById($id_typu);
            $this->registry->template->model = $typ_urzadzen;
            $this->registry->template->show('typy_urzadzen/typy_urzadzen_delete');
        }
    }      

    
    
}

       