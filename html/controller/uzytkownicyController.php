<?php

class uzytkownicyController extends baseController {

    //INDEX - LISTA UZYTKOWNIKOW DLA TYLKO ADMINA
    public function index() {
        //$this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;       
        $login = isset($_SESSION['user']) ? $_SESSION['user'] : '';
        //$id2 = trim($_SESSION['user']);
        if ($db::isUserInRole($login, 'admin')) {
        $this->registry->template->results = $db::getUsersList();
        }
        else
        {
        $this->registry->template->results = $db::getUsersListByLogin($login);   
        }
        $this->registry->template->show('uzytkownicy/uzytkownicy_index');
    }
 
    //DODANIE UZYTKOWNIKA
    public function add() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = trim($_POST['login']);
            $imie = trim($_POST['imie']);
            $email = trim($_POST['email']);
            $haslo = trim($_POST['haslo']);
            $haslo2 = trim($_POST['haslo2']);
            
            if (empty($login)) {
                $error .= 'Proszę uzupełnić pole login.  <br />';
            }
            if (empty($imie)) {
                $error .= 'Proszę uzupełnić pole imię.  <br />';
            }
            if (empty($email)) {
                $error .= 'Proszę uzupełnić pole email.  <br />';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error .= 'Nieprawidłowy format adresu email. Proszę spróbować ponownie. <br />';
                        }            
            if (empty($haslo)) {
                $error .= 'Proszę uzupełnić pole haslo.  <br />';
            }
            if (empty($haslo2)) {
                $error .= 'Proszę uzupełnić pole do powtórzenia hasła.  <br />';
            }
            if (strcmp($haslo, $haslo2)) {
                $error .= 'Podane hasła różnią się. Proszę wprowadzić je ponownie. <br />';
            }
            if ($this->isUserLoginAlreadyExists($login)) {
                $error .= 'Użytkownik z podanym loginem już istnieje. <br />';
            }
            if ($this->isUserEmailAlreadyExists($email)) {
                $error .= 'Użytkownik z podanym emailem już istnieje. <br />';
            }            
            
            if (empty($error)) {
                $user = new Uzytkownik;
                $user->setLogin($login);                
                $user->setImie($imie);
                $user->setEmail($email);
                $user->setHaslo($haslo);
                $user->setRole(array());
                if ($db::addUser($user)) {
                    $success .= 'Dodano nowego użytkownika. <br />';
                } else {
                    $error .= 'Dodanie nowego użytkownika nie powiodło się. <br />';
                }
            }
            $this->registry->template->error = $error;
            $this->registry->template->success = $success;
        }
        $this->registry->template->show('uzytkownicy/uzytkownicy_add');
    }
    
    private function isUserLoginAlreadyExists($login) {
        $db = $this->registry->db;
        $user = $db::getUserByLogin($login);
        return !empty($user);
    }

    private function isUserEmailAlreadyExists($email) {
        $db = $this->registry->db;
        $user = $db::getUserByEmail($email);
        return !empty($user);
    }    
    
    //EDYCJA UZYTKOWNIKA
    public function edit() {
        //$this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $success = "";
        $db = $this->registry->db;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = trim($_POST['login']);
            $imie = trim($_POST['imie']);
            $email = trim($_POST['email']);
            $haslo = trim($_POST['haslo']);
            $haslo2 = trim($_POST['haslo2']);
            
            if (empty($login)) {
                $error .= 'Proszę uzupełnić pole login.  <br />';
            }
            if (empty($imie)) {
                $error .= 'Proszę uzupełnić pole imię.  <br />';
            }
            if (empty($email)) {
                $error .= 'Proszę uzupełnić pole email.  <br />';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error .= 'Nieprawidłowy format adresu email. Proszę spróbować ponownie. <br />';
                        }            
            if (empty($haslo)) {
                $error .= 'Proszę uzupełnić pole haslo.  <br />';
            }
            if (empty($haslo2)) {
                $error .= 'Proszę uzupełnić pole do powtórzenia hasła.  <br />';
            }
            if (strcmp($haslo, $haslo2)) {
                $error .= 'Podane hasła różnią się. Proszę wprowadzić je ponownie. <br />';
            }           
            
            if (empty($error)) {
                $user = new Uzytkownik();
                $id_uzytkownika = trim($_POST['id_uzytkownika']);
                $user->setId_Uzytkownika($id_uzytkownika);                
                $user->setLogin($login);                
                $user->setImie($imie);
                $user->setEmail($email);
                $user->setHaslo($haslo);
                //$user->setRole(array());
                if ($db::updateUser($user)) {
                    $success .= 'Edycja użytkownika powiodła się. <br />';
                } else {
                    $error .= 'Edycja użytkownika nie powiodła się. <br />';
                }
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
        } else {
            $id_uzytkownika = $this->registry->id;

            $user = $db::getUserById($id_uzytkownika);
            $this->registry->template->model = $user;
        }
        $this->registry->template->show('uzytkownicy/uzytkownicy_edit');
    }
 
    public function delete() {
        //$this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $user = new Uzytkownik();
                $id_uzytkownika = trim($_POST['id_uzytkownika']);
                $user->setId_Uzytkownika($id_uzytkownika);
                if ($db::deleteUser($user)) {
                    $success .= 'Usunięto użytkownika. <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się. <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/uzytkownicy';
                header("Location: $location");
            }
            $this->registry->template->success = $success;
            $this->registry->template->error = $error;
            $this->registry->template->show('uzytkownicy/uzytkownicy_action_result');
        } else {
            $id_uzytkownika = $this->registry->id;
            $user = $db::getUserById($id_uzytkownika);
            $this->registry->template->model = $user;
            $this->registry->template->show('uzytkownicy/uzytkownicy_delete');
        }
    }    
    
    
    
    
}


?>