<?php

require_once 'connexion.php';

$db = getConnection();
$fileDir = 'cvs/';
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
$base_url = $protocol.$_SERVER['HTTP_HOST'].'/';

$query = $db->query(
    "SELECT * FROM cvs"
);
$cvs = $query->fetchAll();

?>

<!-- https://sweetalert2.github.io/#usage -->
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
        <title>Candidature | Recrutement</title>
    </head>
    <body>

        <section class="container py-5">
            <div class="row">
                <div class="col-lg-8 col-sm mb-5 mx-auto">
                    <h1 class="fs-4 text-center lead text-primary"><strong>PLATEFORM DE RECRUTEMENT</strong></h1>
                </div>
            </div>
            <div class="dropdown-divider border-warning"></div>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-0">Liste des cadidatures</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <a href="create.php" class="btn btn-primary btn-sm me-3"><i class="fas fa-folder-plus"></i> Nouveau candidat</a>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider border-warning"></div>
            <div class="row">
                <div class="table-responsive" id="joueursTable">
                    <?php if ($cvs): ?>
                        <table id="datatable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">NOM</th>
                                    <th scope="col">PRÉNOM</th>
                                    <th scope="col">TÉLÉPHONE</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">NIVEAU D"ÉTUDE</th>
                                    <th scope="col">FICHIER</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($cvs as $cv): ?>
                                    <tr>
                                        <th scope="row"><?= $cv['nom'] ?></th>
                                        <td><?= $cv['prenom'] ?></td>
                                        <td><?= $cv['telephone'] ?></td>
                                        <td><?= $cv['email'] ?></td>
                                        <td><?= $cv['niveau_etude'] ?></td>
                                        <td>
                                            <?php if ($cv['fichier']): ?>
                                                <a href="<?= $base_url.$cv['fichier'] ?>" target="_blank" rel="noreferrer noopener"><?= $base_url.$cv['fichier'] ?></a>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <a href="edit.php?id=<?=$cv['id']?>" class="text-primary me-2 editBtn" title="Modifier"><i class="fas fa-edit"></i>Modifier</a>
                                            <a href="delete.php?id=<?=$cv['id']?>" class="text-danger me-2 deleteBtn" title="Supprimer" ><i class="fas fa-trash-alt">Supprimer</i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <h3 class="text-success text-center">Aucun candidat enrégistré! </h3>
                    <?php endif ?> 
                </div>
            </div>
        </section>

        <script src="js/jquery.min.js"></script>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/datatables.min.js"></script>
        <script src="js/sweetalert2.all.min.js"></script>
        <script>
            $(function() {
                $('table').DataTable();
            })
        </script>
    </body>
</html>
