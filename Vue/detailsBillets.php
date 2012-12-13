<?php $titre = "Mon Blog - détail d'un billet" ?>

<?php ob_start() ?>
<article>
    <header>
        <h1 class="titreBillet"><?= $billets['BIL_TITRE'] ?></h1>
        <time><?= $billets['BIL_DATE'] ?></time>
    </header>
    <p><?= $billets['BIL_CONTENU'] ?></p>
</article>
<hr />
<header>
    <h1 id="titreReponses">Réponses à <?= $billets['BIL_TITRE'] ?></h1>
</header>
<?php foreach ($commentaires as $commentaire): ?>
    <p><?= $commentaire['COM_AUTEUR'] ?> dit :</p>
    <p><?= $commentaire['COM_CONTENU'] ?></p>
<?php endforeach; ?>
    
<hr />
<h2>Ecrire un commentaire :</h2>
<form method="post" action="index.php?">
    <br /><input type="text" name="auteur" placeholder="Votre pseudo" required /><br />
    <br /><textarea name="commentaire" rows="7" cols="100%" placeholder="Votre message" required /></textarea><br /><br />
    <input type="hidden" name="billet" value="<?= $billets['BIL_ID']?>" />
    <input type="submit" value="Valider" />
</form>
<?php $contenu = ob_get_clean() ?>

<?php include 'gabarit.php' ?>

