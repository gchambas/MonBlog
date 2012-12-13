<?php

require 'Controleur/ControleurBillet.php';
require_once 'Controleur/Controleur.php';

class ControleurFrontal extends Controleur
{
    private $ctrlBillet;
    
    public function __construct() {
        $this->ctrlBillet = new ControleurBillet();
    }
    
    public function routerRequete()
    {
        try{
           if (!empty($_GET)){
               $this->routerRequeteGet();
           }
           else if (!empty($_POST)){
               $this->routerRequetePost();
           } 
           else{
               $this->ctrlBillet->listerBillets();
           }
        }
        catch (Exception $e){
            $this->afficherErreur($e->getMessage());
        }
    }
    

    public function routerRequeteGet()
    {
            if (isset($_GET['action'])){
                if ($_GET['action'] == 'afficherBillet'){
                    if (isset($_GET['id'])){
                        $idBillet = intval($_GET['id']);
                        if ($idBillet != 0)
                            $this->ctrlBillet->afficherBillet($idBillet);
                        else{
                            $id = strip_tags($_GET['id']);
                            throw new Exception("Identifiant de billet '$id' non valide");
                        }
                    }
                    else{
                        throw new Exception("Identifiant de billet non dénini");
                    }
                }
                else{
                    $action = strip_tags($_GET['action']);
                    throw new Exception("Action '$action'non valide");
                }
            }
            else{
                throw new Exception("Aucune action définie");
            } 
        }
        
        private function routerRequetePost()
    {
        if (isset($_POST['auteur']) && isset($_POST['commentaire']) && isset($_POST['billet']))
        {
            $auteur = strip_tags($_POST['auteur']);
            $commentaire = strip_tags($_POST['commentaire']);
            $idBillet = intval($_POST['billet']);
            if ($idBillet != 0)
                $this->ctrlBillet->ajouterCommentaire($auteur, $commentaire, $idBillet);
            else {
                $id = strip_tags($_POST['id']);
                throw new Exception("Identifiant de billet '$id' non valide");
            }
        }
        else
            throw new Exception('Paramètres $_POST non reconnus');
    }

}