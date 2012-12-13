<?php

require_once 'Modele/Modele.php';

class ModeleBillet extends Modele
{
    //Lis tous les billets du blog
    public function lireTout()
    {
        return $this->executerLecture('select * from T_BILLET order by BIL_ID desc');
    }
    
    //Ne lis qu'un seul billet du blog
    public function lireUnSeul($id)
    {
        return $this->executerLecture('select * from T_BILLET where BIL_ID='.$id, true);
    }
}

?>
