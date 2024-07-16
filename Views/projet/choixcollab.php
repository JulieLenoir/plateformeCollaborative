<?php
$title = "Inviter des collaborateurs | Innov8Hub";
?>
<div class="text-center">
    <h3>Création d'un nouveau projet</h3>
    <h5> Et si vous invitiez des collaborateurs ?</h5>
    <p>Allez-y, <?= $_SESSION['prenom_user'] ?> ! Ils n'attendent que vous. Vous pouvez en ajouter 4 !</p>
</div>
<?=$alerte?>
<form action="index.php?controller=projet&action=addCollab&id=<?=$newprojetid?>" method="post">
    <div class="mb-3">
        <label for="email_user1" class="form-label">Email 1 : </label>
        <input type="email" class="form-control" name="email_user1">
    </div>
    <div class="mb-3">
        <label for="email_user2" class="form-label">Email 2: </label>
        <input type="email" class="form-control" name="email_user2">
    </div>
    <div class="mb-3">
        <label for="email_user3" class="form-label">Email 3: </label>
        <input type="email" class="form-control" name="email_user3">
    </div>
    <div class="mb-3">
        <label for="email_user4" class="form-label">Email 4: </label>
        <input type="email" class="form-control" name="email_user4">
    </div>


    <button class="btn btn-info me-3" type="submit">Ajouter les collaborateurs</button><a href="index.php?controller=projet&action=tableauDeBord"><button class="btn btn-info">Non merci !</button></a>
</form>