<?php

require_once 'Modele/ModeleBillet.php';
require_once 'Modele/ModeleCommentaire.php';
require_once 'Controleur/Controleur.php';

class ControleurBillet extends Controleur{
    private $modeleBillet;
    private $modeleCommentaire;
    
    public function __construct()
    {
        $this->modeleBillet = new ModeleBillet();
        $this->modeleCommentaire = new ModeleCommentaire();
    }
    
    /*public function listerBillets()
    {
        $billets = $this->modeleBillet->lireTout();
        $lienBillet = "index.php?action=afficherBillet&id=";
        $this->genererVue('listeBillets', array('billets' => $billets, 'lienBillet' => $lienBillet));
    }*/
    
    public function listerBillets()
    {
        $resultatsBillets = $this->modeleBillet->lireTout();
        $billets = $resultatsBillets->fetchAll();
        foreach ($billets as &$billet) {
            $resultatsCom = $this->modeleCommentaire->compter($billet['BIL_ID']);
            $billet['NB_COM'] = $resultatsCom['NB_COM'];
        }
        $lienBillet = "index.php?action=afficherBillet&id=";
        $this->genererVue('listeBillets', 
                array('billets' => $billets, 'lienBillet' => $lienBillet));
    }
    
        public function afficherBillet($id)
    {
        $billets = $this->modeleBillet->lireUnSeul($id);
        $commentaires = $this->modeleCommentaire->lire($id);
        $this->genererVue('detailsBillets', array('billets' => $billets, 'commentaires' => $commentaires));
    }
    
    public function ajouterCommentaire($auteur, $commentaire, $idBillet) {
        $this->modeleCommentaire->ajouter($auteur, $commentaire, $idBillet);
        $this->afficherBillet($idBillet);
    }
}

?>
