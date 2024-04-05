<?php

require_once 'connexion.php';

$db = getConnection();
$fileDir = 'cvs/';

$result = null;
if (isset($_POST['create'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $niveau = $_POST['niveau_etude'];

    $fichier = '';
    /// uploadage
    if (isset($_FILES['fichier'])) {
        $tmpFilePath = $_FILES['fichier']['tmp_name'];
        $fileName = $_FILES['fichier']['name'];
        $md5_hash = md5(time()."".$fileName);

        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = $nom."_".$prenom.'_'.substr($md5_hash, 0, 10).".".$ext;
        $newFileName = strtolower($newFileName);
        $destPath = $fileDir.$newFileName;
        // echo $tmpFilePath;
        if (move_uploaded_file($tmpFilePath, $destPath)) {
            $fichier = $destPath;
        }
    }

    // $db = getConnection();
    $query = $db->prepare(
        "INSERT INTO cvs
        (nom, prenom, email, telephone, niveau_etude, fichier)
        VALUES (?, ?, ?, ?, ?, ?)"
    );
    $result = $query->execute(array($nom,
                                    $prenom,
                                    $email, 
                                    $telephone,
                                    $niveau,
                                    $fichier));
}

include 'create.php';
