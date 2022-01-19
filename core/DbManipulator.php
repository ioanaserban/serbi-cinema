<?php
include 'DbConnect.php';

class DbManipulator extends DbConnect
{
    public function getCategories()
    {
        return $this->_db->query('SELECT * FROM categorii')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovies()
    {
        return $this->_db->query('SELECT * FROM filme')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMoviesAndCategories()
    {
        return $this->_db->query('SELECT filme.id_film, filme.nume, filme.regizor, filme.casa_de_productie, categorii.nume AS categorie FROM aplicatie_cinema.filme LEFT JOIN aplicatie_cinema.categorii ON aplicatie_cinema.filme.id_categorie = aplicatie_cinema.categorii.id_categorie')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSali()
    {
        return $this->_db->query('SELECT * FROM sali')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsers()
    {
        return $this->_db->query('SELECT * FROM utilizatori')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRezervari()
    {
        return $this->_db->query('select r.id, u.nume as Nume_client, u.prenume as Prenume_client, r.data, r.ora,
                                            f.nume as Film, s.numarSala as Sala, l.numar, l.rand from aplicatie_cinema.rezervari r
                                            left join aplicatie_cinema.utilizatori u on u.id = r.id_client
                                            left join aplicatie_cinema.filme f on f.id_film = r.id_film
                                            left join aplicatie_cinema.locuri l on l.id_loc = r.id_loc
                                            left join aplicatie_cinema.sali s on s.idSala = l.id_sala')
            ->fetchAll(PDO::FETCH_ASSOC);
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
}

$dbManipulator = new DbManipulator();
