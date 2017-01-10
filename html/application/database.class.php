<?php

Class Database {

    private static $db;

    public static function getInstance() {
        if (!self::$db) {
            self::$db = new PDO('mysql:host=localhost;dbname=smarthome;charset=utf8', 'root', '');
            return new Database();
        }
    }

    //użytkownicy
    //
    //dodanie użytkownika
    public static function addUser($user) {
        $stmt = self::$db->prepare("INSERT INTO uzytkownik (login, imie, haslo, email) "
                . "VALUES (:login,:imie,:haslo,:email)");
        $stmt->execute(array(
            ':login' => $user->getLogin(), ':imie' => $user->getImie(),
             ':email' => $user->getEmail(),
             ':haslo' => sha1($user->getHaslo()))
        );
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }
    
    //EDYCJA UZYTKOWNIKA
        public static function updateUser($user) {
        $stmt = self::$db->prepare('UPDATE uzytkownik SET login=:login, imie=:imie, email=:email, haslo=:haslo, czas_rejestracji=:czas_rejestracji WHERE id_uzytkownika=:id_uzytkownika');
        $stmt->execute(array(
            ':login' => $user->getLogin(), ':imie' => $user->getImie(),
             ':email' => $user->getEmail(), ':id_uzytkownika' => $user->getId_Uzytkownika(),
             ':czas_rejestracji' => $user->getCzas_Rejestracji(),':haslo' => sha1($user->getHaslo()))
        );
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }
    
        //USUNIĘCIE uzytkownika
    public static function deleteUser($user) {
        $stmt = self::$db->prepare('DELETE FROM uzytkownik WHERE  id_uzytkownika=:id_uzytkownika');
        $stmt->bindParam (':id_uzytkownika', $user->getId_Uzytkownika(), PDO::PARAM_STR); 
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }
    
    //pobranie użytkownika po id
    public static function getUserById($id_uzytkownika) {
        $stmt = self::$db->query("SELECT * FROM uzytkownik WHERE id_uzytkownika='$id_uzytkownika'");
      //  $stmt->execute(array($login));
      //  if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik;
            $user->setId_Uzytkownika($result['id_uzytkownika']);
            $user->setLogin($result['login']);
            $user->setImie($result['imie']);
            $user->setEmail($result['email']);
            $user->setHaslo($result['haslo']);   
            $user->setCzas_Rejestracji($result['czas_rejestracji']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        //}
    }
    
        //pobranie użytkownika o podanym loginie
    public static function getUserByLogin($login) {
        $stmt = self::$db->prepare('SELECT * FROM uzytkownik WHERE login=?');
        $stmt->execute(array($login));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik;
            $user->setId_Uzytkownika($result['id_uzytkownika']);
            $user->setLogin($result['login']);
            $user->setImie($result['imie']);
            $user->setEmail($result['email']);
            $user->setHaslo($result['haslo']);   
            $user->setCzas_Rejestracji($result['czas_rejestracji']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }
    
        //pobranie użytkownika o podanym mailu
    public static function getUserByEmail($email) {
        $stmt = self::$db->prepare('SELECT * FROM uzytkownik WHERE email=?');
        $stmt->execute(array($email));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik;
            $user->setId_Uzytkownika($result['id_uzytkownika']);
            $user->setLogin($result['login']);
            $user->setImie($result['imie']);
            $user->setEmail($result['email']);
            $user->setHaslo($result['haslo']);   
            $user->setCzas_Rejestracji($result['czas_rejestracji']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }
    
        //pobranie wszystkich roli użytkownika
    public static function userRoles($login) {
        $stmt = self::$db->prepare("SELECT r.szczegoly_roli FROM uzytkownik u 	
		INNER JOIN users_roles ur on(u.id_uzytkownika = ur.id_uzytkownika)
		INNER JOIN roles r on(ur.id_roli = r.id_roli)
		WHERE	u.login = ?");
        $stmt->execute(array($login));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $roles = array();
        for ($i = 0; $i < count($result); $i++) {
            $roles[] = $result[$i]['szczegoly_roli'];
        }
        return $roles;
    }
    
    //sprawdzenie, czy użytkownik posiada określoną rolę
    public static function isUserInRole($login, $role) {
        $userRoles = self::userRoles($login);
        return in_array($role, $userRoles);
    }
    
    public static function getUsersList() {
        $stmt = self::$db->query('SELECT * FROM uzytkownik');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getUsersListByLogin($login) {
        $stmt = self::$db->query("SELECT * FROM uzytkownik WHERE login='$login'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getUserByLoginAndPassword($login, $haslo) {
        $stmt = self::$db->prepare('SELECT * FROM uzytkownik WHERE login=? and haslo=?');
        $stmt->execute(array($login, sha1($haslo)));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik();
            $user->setId_Uzytkownika($result['id_uzytkownika']);
            $user->setLogin($result['login']);
            $user->setImie($result['imie']);
            $user->setEmail($result['email']);
            $user->setHaslo($result['haslo']);   
            $user->setCzas_Rejestracji($result['czas_rejestracji']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }

    //pomieszczenia
    //
    //dodanie pomieszczenia
    public static function addPomieszczenie($pomieszczenie) {
        $stmt = self::$db->prepare("INSERT INTO pomieszczenia (nazwa_pomieszczenia, szczegoly_pomieszczenia) "
                . "VALUES (:nazwa_pomieszczenia,:szczegoly_pomieszczenia)");
        $stmt->execute(array(
            ':nazwa_pomieszczenia' => $pomieszczenie->getNazwa_Pomieszczenia(), 
            ':szczegoly_pomieszczenia' => $pomieszczenie->getSzczegoly_Pomieszczenia())

        );
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }    
    
    //edycja pomieszczenia 
        public static function updatePomieszczenie($pomieszczenie) {
        $stmt = self::$db->prepare('UPDATE pomieszczenia SET nazwa_pomieszczenia=:nazwa_pomieszczenia, szczegoly_pomieszczenia=:szczegoly_pomieszczenia WHERE id_pomieszczenia=:id_pomieszczenia');
        $stmt->execute(array(
            ':nazwa_pomieszczenia' => $pomieszczenie->getNazwa_Pomieszczenia(), ':szczegoly_pomieszczenia' => $pomieszczenie->getSzczegoly_Pomieszczenia(),
             ':id_pomieszczenia' => $pomieszczenie->getId_Pomieszczenia())
        );
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }
    
            //USUNIĘCIE pomieszczenia
        public static function deletePomieszczenie($pomieszczenie) {
            $stmt = self::$db->prepare('DELETE FROM pomieszczenia WHERE  id_pomieszczenia=:id_pomieszczenia');
            $stmt->bindParam (':id_pomieszczenia', $pomieszczenie->getId_Pomieszczenia(), PDO::PARAM_STR); 
            $stmt->execute();
            $affected_rows = $stmt->rowCount();
            if ($affected_rows == 1) {
                return TRUE;
            }
            return FALSE;
        } 
    
        public static function getPomieszczenieById($id_pomieszczenia) {
                $stmt = self::$db->query("SELECT * FROM pomieszczenia WHERE id_pomieszczenia='$id_pomieszczenia'");
              //  $stmt->execute(array($login));
              //  if ($stmt->rowCount() > 0) {
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $result = $results[0];
                    $pomieszczenie = new Pomieszczenia();
                    $pomieszczenie->setId_Pomieszczenia($result['id_pomieszczenia']);
                    $pomieszczenie->setNazwa_Pomieszczenia($result['nazwa_pomieszczenia']);
                    $pomieszczenie->setSzczegoly_Pomieszczenia($result['szczegoly_pomieszczenia']);
                    return $pomieszczenie;
                //}
            }    
    
    
    
    
     public static function getPomieszczeniaList() {
        $stmt = self::$db->query('SELECT * FROM pomieszczenia');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   

        public static function getPomieszczenieByNazwa($nazwa_pomieszczenia) {
        $stmt = self::$db->prepare('SELECT * FROM pomieszczenia WHERE nazwa_pomieszczenia=?');
        $stmt->execute(array($nazwa_pomieszczenia));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $pomieszczenie = new Pomieszczenia();
            $pomieszczenie->setId_Pomieszczenia($result['id_pomieszczenia']);
            $pomieszczenie->setNazwa_Pomieszczenia($result['nazwa_pomieszczenia']);
            $pomieszczenie->setSzczegoly_Pomieszczenia($result['szczegoly_pomieszczenia']);
            return $pomieszczenie;
        }
    }
    
    //urzadzenia
    //
    //dodanie urzadzenia
    public static function addUrzadzenie($urzadzenie) {
        $stmt = self::$db->prepare("INSERT INTO urzadzenia (nazwa_urzadzenia, szczegoly_urzadzenia, typy_urzadzen_id_typu) "
                . "VALUES (:nazwa_urzadzenia,:szczegoly_urzadzenia,:typy_urzadzen_id_typu)");
        $stmt->execute(array(
            ':nazwa_urzadzenia' => $urzadzenie->getNazwa_Urzadzenia(), 
            ':szczegoly_urzadzenia' => $urzadzenie->getSzczegoly_Urzadzenia(),
            ':typy_urzadzen_id_typu' => $urzadzenie->getTypy_Urzadzen_Id_Typu())

        );
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }    
    
    //edycja urzadzenia 
 /*       public static function updateUrzadzenie($urzadzenie) {
        $stmt = self::$db->prepare('UPDATE urzadzenia SET nazwa_urzadzenia=:nazwa_urzadzenia, szczegoly_urzadzenia=:szczegoly_urzadzenia, typy_urzadzen_id_typu=:typy_urzadzen_id_typu WHERE id_urzadzenia=:id_urzadzenia');
        $stmt->execute(array(
            ':nazwa_urzadzenia' => $urzadzenie->getNazwa_Urzadzenia(), 
            ':szczegoly_urzadzenia' => $urzadzenie->getSzczegoly_Urzadzenia(),
            ':id_urzadzenia' => $urzadzenie->getId_Urzadzenia(), 
            ':typy_urzadzen_id_typu' => $urzadzenie->getTypy_Urzadzen_Id_Typu())
        );
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }*/
    
        public static function updateUrzadzenie($urzadzenie) {
            try {
                self::$db->beginTransaction();
                $stmt = self::$db->prepare('UPDATE urzadzenia SET nazwa_urzadzenia=:nazwa_urzadzenia, szczegoly_urzadzenia=:szczegoly_urzadzenia, typy_urzadzen_id_typu=:typy_urzadzen_id_typu WHERE id_urzadzenia=:id_urzadzenia');
                $stmt->execute(array(
                    ':nazwa_urzadzenia' => $urzadzenie->getNazwa_Urzadzenia(), 
                    ':szczegoly_urzadzenia' => $urzadzenie->getSzczegoly_Urzadzenia(),
                    ':id_urzadzenia' => $urzadzenie->getId_Urzadzenia(), 
                    ':typy_urzadzen_id_typu' => $urzadzenie->getTypy_Urzadzen_Id_Typu())
                );
            $affected_rows = $stmt->rowCount();
            if ($affected_rows == 1) {
                self::$db->commit();
                return TRUE;
            }
        } catch (Exception $ex) {
            echo $ex;
            self::$db->rollBack();
            return FALSE;
        }
    } 
    
    
            //USUNIĘCIE urzadzenia
        public static function deleteUrzadzenie($urzadzenie) {
            $stmt = self::$db->prepare('DELETE FROM urzadzenia WHERE  id_urzadzenia=:id_urzadzenia');
            $stmt->bindParam (':id_urzadzenia', $urzadzenie->getId_Urzadzenia(), PDO::PARAM_STR); 
            $stmt->execute();
            $affected_rows = $stmt->rowCount();
            if ($affected_rows == 1) {
                return TRUE;
            }
            return FALSE;
        } 
    
        public static function getUrzadzenieById($id_urzadzenia) {
                $stmt = self::$db->query("SELECT * FROM urzadzenia WHERE id_urzadzenia='$id_urzadzenia'");
              //  $stmt->execute(array($login));
              //  if ($stmt->rowCount() > 0) {
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $result = $results[0];
                    $urzadzenie = new Urzadzenia();
                    $urzadzenie->setId_Urzadzenia($result['id_urzadzenia']);
                    $urzadzenie->setNazwa_Urzadzenia($result['nazwa_urzadzenia']);
                    $urzadzenie->setSzczegoly_Urzadzenia($result['szczegoly_urzadzenia']);
                    $urzadzenie->setTypy_Urzadzen_Id_Typu($result['typy_urzadzen_id_typu']);                    
                    return $urzadzenie;
                //}
            }    
    
    
    
    
     public static function getUrzadzeniaList() {
        $stmt = self::$db->query('SELECT * FROM urzadzenia');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   

        public static function getUrzadzenieByNazwa($nazwa_urzadzenia) {
        $stmt = self::$db->prepare('SELECT * FROM urzadzenia WHERE nazwa_urzadzenia=?');
        $stmt->execute(array($nazwa_urzadzenia));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $urzadzenie = new Urzadzenia();
            $urzadzenie->setId_Urzadzenia($result['id_urzadzenia']);
            $urzadzenie->setNazwa_Urzadzenia($result['nazwa_urzadzenia']);
            $urzadzenie->setSzczegoly_Urzadzenia($result['szczegoly_urzadzenia']);
            return $urzadzenie;
        }
    }
    
    //typy urzadzen
     public static function getTypyUrzadzenList() {
        $stmt = self::$db->query('SELECT * FROM typy_urzadzen');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public static function getTypyUrzadzenByNazwa($nazwa_typu) {
        $stmt = self::$db->prepare('SELECT * FROM typy_urzadzen WHERE nazwa_typu=?');
        $stmt->execute(array($nazwa_typu));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $typ_urzadzen = new Typy_urzadzen();
            $typ_urzadzen->setId_Typu($result['id_typu']);
            $typ_urzadzen->setNazwa_Typu($result['nazwa_typu']);
            $typ_urzadzen->setSzczegoly_Typu($result['szczegoly_typu']);
            return $typ_urzadzen;
        }
    }

    //dodanie urzadzenia
    public static function addTypyUrzadzen($typ_urzadzen) {
        $stmt = self::$db->prepare("INSERT INTO typy_urzadzen (nazwa_typu, szczegoly_typu) "
                . "VALUES (:nazwa_typu,:szczegoly_typu)");
        $stmt->execute(array(
            ':nazwa_typu' => $typ_urzadzen->getNazwa_Typu(), 
            ':szczegoly_typu' => $typ_urzadzen->getSzczegoly_Typu())

        );
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }    
    
    //edycja urzadzenia 
        public static function updateTypyUrzadzen($typ_urzadzen) {
        $stmt = self::$db->prepare('UPDATE typy_urzadzen SET nazwa_typu=:nazwa_typu, szczegoly_typu=:szczegoly_typu WHERE id_typu=:id_typu');
        $stmt->execute(array(
            ':nazwa_typu' => $typ_urzadzen->getNazwa_Typu(), ':szczegoly_typu' => $typ_urzadzen->getSzczegoly_Typu(),
             ':id_typu' => $typ_urzadzen->getId_Typu())
        );
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }
    
            //USUNIĘCIE urzadzenia
        public static function deleteTypyUrzadzen($typ_urzadzen) {
            $stmt = self::$db->prepare('DELETE FROM typy_urzadzen WHERE  id_typu=:id_typu');
            $stmt->bindParam (':id_typu', $typ_urzadzen->getId_Typu(), PDO::PARAM_STR); 
            $stmt->execute();
            $affected_rows = $stmt->rowCount();
            if ($affected_rows == 1) {
                return TRUE;
            }
            return FALSE;
        } 
    
        public static function getTypyUrzadzenById($id_typu) {
                $stmt = self::$db->query("SELECT * FROM typy_urzadzen WHERE id_typu='$id_typu'");
              //  $stmt->execute(array($login));
              //  if ($stmt->rowCount() > 0) {
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $result = $results[0];
                    $typ_urzadzen = new Typy_urzadzen();
                    $typ_urzadzen->setId_Typu($result['id_typu']);
                    $typ_urzadzen->setNazwa_Typu($result['nazwa_typu']);
                    $typ_urzadzen->setSzczegoly_Typu($result['szczegoly_typu']);
                    return $typ_urzadzen;
                //}
            }    
        
            //POMIARY

        public static function getPomiaryList() {
           $stmt = self::$db->query('SELECT * FROM pomiary');
           return $stmt->fetchAll(PDO::FETCH_ASSOC);
       }            
    
        public static function updatePomiary($pomiar) {
            try {
                self::$db->beginTransaction();
                $stmt = self::$db->prepare('UPDATE pomiary SET szczegoly_pomiaru=:szczegoly_pomiaru, wartosc=:wartosc, czas_pomiaru=:czas_pomiaru, pomieszczenia_id_pomieszczenia=:pomieszczenia_id_pomieszczenia, urzadzenia_id_urzadzenia=:urzadzenia_id_urzadzenia WHERE id_pomiaru=:id_pomiaru');
                $stmt->execute(array(
                    ':id_pomiaru' => $pomiar->getId_Pomiaru(),
                    ':szczegoly_pomiaru' => $pomiar->getSzczegoly_Pomiaru(), 
                    ':wartosc' => $pomiar->getWartosc(),
                    ':czas_pomiaru' => $pomiar->getCzas_Pomiaru(), 
                    ':pomieszczenia_id_pomieszczenia' => $pomiar->getPomieszczenia_Id_Pomieszczenia(),
                    ':urzadzenia_id_urzadzenia' => $pomiar->getUrzadzenia_Id_Urzadzenia())
                );
            $affected_rows = $stmt->rowCount();
            if ($affected_rows == 1) {
                self::$db->commit();
                return TRUE;
            }
        } catch (Exception $ex) {
            echo $ex;
            self::$db->rollBack();
            return FALSE;
        }
    }
    
        public static function getPomiarById($id_pomiaru) {
                $stmt = self::$db->query("SELECT * FROM pomiary WHERE id_pomiaru='$id_pomiaru'");
              //  $stmt->execute(array($login));
              //  if ($stmt->rowCount() > 0) {
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $result = $results[0];
                    $pomiar = new Pomiary();
                    $pomiar->setId_Pomiaru($result['id_pomiaru']);
                    $pomiar->setSzczegoly_Pomiaru($result['szczegoly_pomiaru']);
                    $pomiar->setWartosc($result['wartosc']);
                    $pomiar->setCzas_Pomiaru($result['czas_pomiaru']);
                    $pomiar->setPomieszczenia_Id_Pomieszczenia($result['pomieszczenia_id_pomieszczenia']);
                    $pomiar->setUrzadzenia_Id_Urzadzenia($result['urzadzenia_id_urzadzenia']);                     
                    return $pomiar;
                    
                //}
            }     
       
    public static function addPomiar($pomiar) {
        $stmt = self::$db->prepare("INSERT INTO pomiary (szczegoly_pomiaru, wartosc, czas_pomiaru, pomieszczenia_id_pomieszczenia, urzadzenia_id_urzadzenia) "
                . "VALUES (:szczegoly_pomiaru,:wartosc,:czas_pomiaru,:pomieszczenia_id_pomieszczenia,:urzadzenia_id_urzadzenia)");
                $stmt->execute(array(
                    ':szczegoly_pomiaru' => $pomiar->getSzczegoly_Pomiaru(), 
                    ':wartosc' => $pomiar->getWartosc(),
                    ':czas_pomiaru' => $pomiar->getCzas_Pomiaru(), 
                    ':pomieszczenia_id_pomieszczenia' => $pomiar->getPomieszczenia_Id_Pomieszczenia(),
                    ':urzadzenia_id_urzadzenia' => $pomiar->getUrzadzenia_Id_Urzadzenia()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }             
      
        ///USUNIĘCIE pomiaru
        public static function deletePomiar($pomiar) {
            $stmt = self::$db->prepare('DELETE FROM pomiary WHERE id_pomiaru=:id_pomiaru');
            $stmt->bindParam (':id_pomiaru', $pomiar->getId_Pomiaru(), PDO::PARAM_STR); 
            $stmt->execute();
            $affected_rows = $stmt->rowCount();
            if ($affected_rows == 1) {
                return TRUE;
            }
            return FALSE;
        }     
    
    
    
}

?>