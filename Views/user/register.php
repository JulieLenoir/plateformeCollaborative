<?php
$title = 'Inscription | Innov8Hub';
?>
<div id='titreregister' class='m-5'>
<h4>Rejoignez Innov8Hub et trouvez de nouveaux collaborateurs !</h4>
<p>Remplissez ce formulaire et faîtes grandir dès aujourd'hui votre réseau.  </p>
</div>
<?=$alerte?>
<form class="row g-3 m-5" method="POST" action="index.php?controller=user&action=registertraitement">
  <div class="col-md-6">
    <label for="nom_user" class="form-label">Nom</label>
    <input type="text" class="form-control" name="nom_user">
  </div>
  <div class="col-md-6">
    <label for="prenom_user" class="form-label">Prénom</label>
    <input type="text" class="form-control" name="prenom_user">
  </div>
  <div class="col-12">
    <label for="email_user" class="form-label">Email</label>
    <input type="email" class="form-control" name="email_user" placeholder="exemple@exemple.fr">
  </div>
  <div class="col-12">
    <label for="password_user" class="form-label">Mot de passe</label>
    <input type="password" class="form-control mb-5" name="password_user">
  </div>
 
  <button type="submit" class="btn btn-info col-5 m-auto">Valider</button>
  
</form>
