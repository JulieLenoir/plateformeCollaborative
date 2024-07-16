<?php



abstract class Controller

{

    protected function render(string $path, array $data = [])

    {
        extract($data);

        ob_start();

        if (isset($_SESSION['prenom_user'])){
            $bonjour = 'Bonjour '.$_SESSION['prenom_user'].'<br><a href="index.php?controller=projet&action=tableauDeBord">Voir le tableau de bord</a><br><a href="index.php?controller=user&action=logout">Me déconnecter</a>';
        
        }
        else {
            $bonjour = '';
        }
        

        include dirname(__DIR__) . '/Views/' . $path . '.php';
        $content = ob_get_clean();


        include dirname(__DIR__) . '/Views/base.php';
    }
}
