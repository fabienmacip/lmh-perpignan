Dans cette appli, copiée de SPY, l'entité PAYS correspond à la table de BDD "Chasseurs".


  <tr><td><?= $diane ?><br/><span class='et-nom'><?= $pays->getNom() ?> <?= $pays->getPrenom() ?></span><br/><span class='et-animal'><?= $animal->getNom() ?></span><br/><span class='et-date'><?= $date->getDateLong() ?></span></td>
  <td><?= $diane ?><br/><span class='et-nom'><?= $pays->getNom() ?> <?= $pays->getPrenom() ?></span><br/><span class='et-animal'><?= $animal->getNom() ?></span><br/><span class='et-date'><?= $date->getDateLong() ?></span></td></tr>


--- Modif/Ajout entité ---
Dans la BDD, créer la table.
Dans Modèles, ajouter les 2 classes.
Dans index.php, modifier le CRUD.
Dans controleur.php, modifier le CRUD.
Dans VUES, modifier "liste-monentite.php".
Dans SCRIPTS, modifier displayUpdateEntite et confirmeSuppressionEntite.


