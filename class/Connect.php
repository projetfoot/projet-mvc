<?php

/**
 *  creation d'une classe qui instance ma base de donnée
 * @return connexion a la bdd
 */
class Connect
{
    //paramètres pour le constructor
    protected $bdd = '';
    protected $connec_host = '';
    protected $connec_dbname = '';
    protected $connec_pseudo = '';
    protected $connec_mdp = '';
    
    //assignation des paramètres du constructor avec un try catch
    public function __construct($connec_host = 'localhost:3306', $connec_dbname = 'foot2', $connec_pseudo = 'root', $connec_mdp = ''){
        try {
            $this->bdd = new PDO('mysql:host='.$connec_host.';dbname='.$connec_dbname, $connec_pseudo, $connec_mdp);
            $this->bdd->exec("SET CHARACTER SET utf8");
            $this->bdd->exec("SET NAMES utf8");
        }
        catch(PDOException $e) {
            die('<h3>Erreur !</h3>');
        }
    }

    /**
     * fonction d'accroche de connexion pour les autres class
     * @return connexion bdd
     */
    public function connexion(){
        return $this->bdd;
    }
}

