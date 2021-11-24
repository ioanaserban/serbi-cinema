<?php

class User
{
    const CLIENT_ROLE = 1;
    const ADMIN_ROLE = 2;

    protected $dbManipulator;

    public function __construct()
    {
        $this->dbManipulator = new DbManipulator();
    }

    static function isAdmin()
    {
        if (!self::isLoggedIn()) {
            return false;
        }

        $user = $_SESSION['user'];

        foreach ($user['roles'] as $role) {
            if ($role['id_rol'] == self::ADMIN_ROLE) {
                return true;
            }
        }

        return false;
    }

    static function isLoggedIn()
    {
        return isset($_SESSION['user']['id']);
    }

    public function login($email, $password)
    {
        $user = $this->dbManipulator->getDb()
            ->query('SELECT * FROM utilizatori WHERE email = "' . $email . '" AND parola = "' . md5($password) . '"')
            ->fetch(PDO::FETCH_ASSOC);
        $user['roles'] = $this->dbManipulator->getDb()
                ->query('select r.* from aplicatie_cinema.roluri r
                                    left join aplicatie_cinema.utilizatori_roluri ur on r.id_rol = ur.id_rol 
                                    left join aplicatie_cinema.utilizatori u on ur.id_utilizator = u.id
                                    where u.id = '.$user['id'] )
                ->fetchAll(PDO::FETCH_ASSOC);

        return $user;
    }
}