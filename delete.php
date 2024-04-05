<?php
require_once 'connexion.php';

$db = getConnection();
$fileDir = 'cvs/';

$result = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $db->prepare("SELECT * FROM cvs WHERE id=?");
    $query->execute(array($id));
    $cv = $query->fetch();
    if (!$cv) {
        header('location: not_found.php');
    }
} else if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    $fichier = $_POST['fichier'];

    $query = $db->prepare(
        "DELETE FROM cvs WHERE id=?"
    );
    $result = $query->execute(array($id));
    if ($result) {
        if ($fichier && file_exists($fichier)) {
            unlink($fichier);
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/datatables.min.css"/>
        <link rel="stylesheet" href="css/sweetalert2.min.css"/>
        <title>Suppression de id = <?=$cv['id']?> | Recrutement</title>
    </head>
    <body>
        <section class="container py-5">
            <div class="row">
                <div class="col-lg-8 col-sm mb-5 mx-auto">
                    <?php if ($cv):?> 
                        <h1 class="fs-4 text-center lead text-danger">Voulez-vous supprimez les données du candidat <strong>n°<?=$cv['id']?></strong> ?</h1>
                    <?php endif ?>
                </div>
            </div>
            <div class="row">
                <?php if ($cv):?> <form action="delete.php" method="POST" id="formEdit" enctype="multipart/form-data">
                <?php else:?> <form action="" method="POST" id="formEdit" enctype="multipart/form-data" style="display: none">
                <?php endif ?>
                    <div class="mb-3 row">
                        <label for="id" class="col-sm-2 col-form-label">ID candidat :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id" name="id" placeholder="ID candidat" value="<?=$cv['id']?>" readonly/>
                            <!-- <input type="text" class="form-control" id="fichier" name="fichier" placeholder="ID candidat" value="<?=$cv['fichier']?>" hidden/> -->
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nom" class="col-sm-2 col-form-label">Nom :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de famille" maxlength="45" value="<?=$cv['nom']?>" readonly/>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="prenom" class="col-sm-2 col-form-label">Prénom :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Le ou les prénoms" maxlength="45" value="<?=$cv['prenom']?>" readonly/>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email :</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="monemail@example.com" maxlength="120" value="<?=$cv['email']?>" readonly/>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telephone" class="col-sm-2 col-form-label">Téléphone :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="+229 90 00 00 00" maxlength="12" value="<?=$cv['telephone']?>" readonly/>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="niveau_etude" class="col-sm-2 col-form-label">Niveau d'étude :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="niveau_etude" name="niveau_etude" placeholder="License, Master ou Doctora" maxlength="45" value="<?=$cv['niveau_etude']?>" readonly/>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fichier" class="col-sm-2 col-form-label">Fichier :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fichier" name="fichier" placeholder="Mon CV.pdf ou .doc" value="<?=$cv['fichier']?>" maxlength="180" readonly/>
                        </div>
                    </div>
                    <!--- -->
                    <div class="row">
                        <div class="col-md-3">
                            <a href="index.php" class="btn btn-primary btn-sm me-3"><i class="fas fa-folder-plus"></i> <- Annuler</a>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <button id="create" type="submit" class="btn btn-danger" name="delete">Confirmer la suppression<i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-floating mb-3">
                        <input id="create" type="button" class="btn btn-primary" name="create">Ajouter <i class="fas fa-plus"></i></button>
                    </div> -->
                </form>
            </div>
        </section>

        <script src="js/jquery.min.js"></script>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/datatables.min.js"></script>
        <script src="js/sweetalert2.all.min.js"></script>
        <script>
            <?php
                if ($result != null) {
                    if ($result) {
                        echo '
                        Swal.fire({
                            // position: "top-end",
                            icon: "success",
                            title: "Candidat supprimé avec succès !",
                            // showConfirmButton: false,
                            // timer: 1500
                        }).then((result) => {
                            window.location="/";
                          });
                        ';
                    } else {
                        echo '
                        Swal.fire({
                            // position: "top-end",
                            icon: "fail",
                            title: "Désolé, les modification n\'ont pas pu été enrégistée. Veuillez reéssayer svp !",
                            // showConfirmButton: false,
                            // timer: 1500
                        });
                        ';
                    }
                }
            ?>
        </script>
    </body>
</html>
