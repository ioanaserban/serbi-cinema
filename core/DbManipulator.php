<?php
include 'DbConnect.php';

class DbManipulator extends DbConnect
{
    public function getRolesOfUser($user)
    {
        return $this->_db
            ->query('select r.* from aplicatie_cinema.roluri r
                                    left join aplicatie_cinema.utilizatori_roluri ur on r.id_rol = ur.id_rol 
                                    left join aplicatie_cinema.utilizatori u on ur.id_utilizator = u.id
                                    where u.id = ' . $user['id'])
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRezervari($userId = null)
    {
        $sql = 'select r.id, u.nume as Nume_client, u.prenume as Prenume_client, r.data, r.ora,
                                            f.nume as Film, s.numarSala as Sala, l.numar, l.rand from aplicatie_cinema.rezervari r
                                            left join aplicatie_cinema.utilizatori u on u.id = r.id_client
                                            left join aplicatie_cinema.filme f on f.id_film = r.id_film
                                            left join aplicatie_cinema.locuri l on l.id_loc = r.id_loc
                                            left join aplicatie_cinema.sali s on s.idSala = l.id_sala';

        if ($userId) {
            $sql .= ' WHERE u.id = ' . $userId;
        }

        return $this->_db->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFreeSpotsByMovieIdDateTime($movieId, $date, $time)
    {
        $sql = "SELECT l.*, s.* FROM aplicatie_cinema.filme f
                LEFT JOIN aplicatie_cinema.filme_sali fs on fs.id_film = f.id_film
                LEFT JOIN aplicatie_cinema.sali s on s.idSala = fs.id_sala
                LEFT JOIN aplicatie_cinema.locuri l on l.id_sala = s.idSala
                WHERE l.id_loc NOT IN (
                    SELECT id_loc FROM aplicatie_cinema.rezervari r 
                    WHERE r.id_film = f.id_film 
                      AND data = '" . $date . "' 
                      AND ora = '" . $time . "'
                    )
                AND f.id_film = " . $movieId . "
                AND fs.data = '" . $date . "'
                AND fs.ora ='" . $time . "'";

        return $this->_db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvailableDateAndHoursByMovieId($movieId)
    {
        $sql = 'SELECT fs.ora, fs.data FROM aplicatie_cinema.filme f
                INNER JOIN aplicatie_cinema.filme_sali fs on fs.id_film = f.id_film
                WHERE f.id_film = ' . $movieId;

        $dbDateAndHours = $this->_db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $dateAndHours = [];

        foreach ($dbDateAndHours as $dbDateAndHour) {
            if (!isset($dateAndHours[$dbDateAndHour['data']])) {
                $dateAndHours[$dbDateAndHour['data']] = [];
            }

            if (!in_array($dbDateAndHour['ora'], $dateAndHours[$dbDateAndHour['data']])) {
                $dateAndHours[$dbDateAndHour['data']][] = $dbDateAndHour['ora'];
            }

        }

        return $dateAndHours;
    }

    public function getMoviesAndCategories()
    {
        return $this->_db->query('SELECT filme.id_film, filme.nume, filme.regizor, filme.casa_de_productie, categorii.nume AS categorie, categorii.id_categorie FROM aplicatie_cinema.filme 
                                            LEFT JOIN aplicatie_cinema.categorii ON aplicatie_cinema.filme.id_categorie = aplicatie_cinema.categorii.id_categorie')
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSpotsOfMovieRoom($movieRoomId)
    {
        return $this->_db->query('SELECT * FROM aplicatie_cinema.sali s
                INNER JOIN aplicatie_cinema.locuri l on l.id_sala = s.idSala where s.idSala = ' . $movieRoomId)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMoviesAndCategoriesFilterByCategoryName($categoryName)
    {
        return $this->_db->query('SELECT f.id_film, f.nume, f.regizor, f.casa_de_productie, c.nume AS categorie, c.id_categorie FROM aplicatie_cinema.filme f
                                            LEFT JOIN aplicatie_cinema.categorii c ON f.id_categorie = c.id_categorie
                                            WHERE c.nume IN (SELECT nume from aplicatie_cinema.categorii WHERE categorii.nume LIKE "%' . $categoryName . '%")')
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGenderStatisticByMovieId($movieId)
    {
        $sql = 'SELECT sub.*
                FROM (
                    SELECT distinct u.nume, u.sex, r.id_film FROM aplicatie_cinema.rezervari r
                    LEFT JOIN aplicatie_cinema.utilizatori u on u.id = r.id_client
                ) sub
                WHERE sub.id_film = ' . $movieId;

        $statistics = $this->_db->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);

        $genderStatistics = [
            'M' => 0,
            'F' => 0
        ];

        foreach ($statistics as $statistic) {
            if (isset($genderStatistics[$statistic['sex']])) {
                $genderStatistics[$statistic['sex']]++;
            }
        }

        return $genderStatistics;
    }

    public function getNumberOfMoviesPerCategory()
    {
        $sql = 'SELECT *, (SELECT count(*) FROM aplicatie_cinema.filme f where c.id_categorie = f.id_categorie) as cateFilme 
FROM aplicatie_cinema.categorii c;';

        $categoriesWithMovies = $this->_db->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);

        $categoryWithMoviesNumber = [];

        foreach ($categoriesWithMovies as $categoriesWithMovie) {
            $categoryWithMoviesNumber[$categoriesWithMovie['id_categorie']] = $categoriesWithMovie['cateFilme'];
        }

        return $categoryWithMoviesNumber;
    }


    public function getCategories()
    {
        return $this->_db->query('SELECT * FROM categorii')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovies()
    {
        return $this->_db->query('SELECT * FROM filme')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSali()
    {
        return $this->_db->query('SELECT * FROM sali')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsers()
    {
        return $this->_db->query('SELECT * FROM utilizatori')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDb()
    {
        return $this->_db;
    }

    public function insertMovie($data)
    {
        $sql = "INSERT INTO aplicatie_cinema.filme (id_categorie, nume, regizor, casa_de_productie) VALUES 
                (" . $data['category'] . ", '" . $data['filmName'] . "', '" . $data['directorName'] . "', '" . $data['producer'] . "')";

        $this->_db->exec($sql);
    }

    public function updateMovie($data)
    {
        $sql = "UPDATE aplicatie_cinema.filme 
        SET id_categorie = " . $data['category'] . ", 
        nume = '" . $data['filmName'] . "',
        regizor = '" . $data['directorName'] . "',
        casa_de_productie = '" . $data['producer'] . "' 
        WHERE id_film = " . $data['filmId'] . ";";

        $this->_db->exec($sql);
    }

    public function deleteMovie($data)
    {
        $sql = "DELETE FROM aplicatie_cinema.filme WHERE id_film = " . $data['filmId'];
        //dd($sql);
        $this->_db->exec($sql);
    }

    public function deleteCategory($data)
    {
        $sql = "DELETE FROM aplicatie_cinema.categorii WHERE id_categorie = " . $data['categId'];
        //dd($sql);
        $this->_db->exec($sql);
    }

    public function insertCategory($data)
    {
        $sql = "INSERT INTO aplicatie_cinema.categorii (nume) VALUES ('" . $data['categName'] . "')";

        $this->_db->exec($sql);
    }

    public function deleteMovieRoom($data)
    {
        $sql = "DELETE FROM aplicatie_cinema.sali WHERE idSala = " . $data['salaId'];
        //dd($sql);
        $this->_db->exec($sql);
    }

    public function insertMovieRoom($data)
    {
        $sql = "INSERT INTO aplicatie_cinema.sali (numarSala, numarLocuriTotal) VALUES ('" . $data['salaNo'] . "', '" . $data['numarLocuri'] . "')";

        $this->_db->exec($sql);
    }

    public function updateMovieRoom($data)
    {
        $sql = "UPDATE aplicatie_cinema.sali
        SET numarSala = " . $data['salaNo'] . ", 
        numarLocuriTotal = " . $data['numarLocuri'] . " 
        WHERE idSala = " . $data['salaId'];

        $this->_db->exec($sql);
    }

    public function insertReservation($clientId, $movieId, $date, $time, $spotId)
    {
        $sql = "INSERT INTO aplicatie_cinema.rezervari (id_client, id_film, data, ora, id_loc) VALUES 
                (" . $clientId . ", '" . $movieId . "', '" . $date . "', '" . $time . "', " . $spotId . ")";

        $this->_db->exec($sql);
    }

    public function verifyEmailInDb($email)
    {
        $sql = 'SELECT count(*) as checkInDb FROM aplicatie_cinema.utilizatori WHERE email = "' . $email . '"';

        return (bool)$this->_db->query($sql)->fetch(PDO::FETCH_ASSOC)['checkInDb'];
    }

    public function insertUser($data)
    {
        $sql = "INSERT INTO aplicatie_cinema.utilizatori (nume, prenume, data_nasterii, sex, email, parola) VALUES 
                ('" . $data['lastName'] . "', '" . $data['firstName'] . "', '" . $data['birthday'] . "', '" . $data['sex'] . "', '" . $data['email'] . "', '" . md5($data['password']) . "')";

        $this->_db->exec($sql);
    }
}

$dbManipulator = new DbManipulator();
