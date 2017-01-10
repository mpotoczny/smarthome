<?php
class accountController extends baseController {
    public function index() {    
    }
    public function login() {
        if (!empty($_POST['login']) && !empty($_POST['haslo'])) {
            $login = trim($_POST['login']);
            $haslo = trim($_POST['haslo']);
            $db = $this->registry->db;
            $user = $db::getUserByLoginAndPassword($login, $haslo);
            if (!empty($user)) {
                $_SESSION['user'] = $user->getLogin();
                $location = APP_ROOT;
                header("Location: /$location");
            }
        }
        $this->registry->template->show('account/account_login');
    }

    public function logout() {
        session_destroy();
        $location = APP_ROOT;
        header("Location: /$location");
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

    public function register() {
        $error = "";
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
                    $this->registry->template->show('account/account_register_success');
                }else{
                    $error .= 'Rejestracja nie powiodła się <br />';
                }              
            }            
            
            
            $this->registry->template->error = $error;
        }
        $this->registry->template->show('account/account_register');
    }
}
