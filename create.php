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
        <title>Nouvelle candidature | Recrutement</title>
    </head>
    <body>
        <section class="container py-5">
            <div class="row">
                <div class="col-lg-8 col-sm mb-5 mx-auto">
                    <h1 class="fs-4 text-center lead text-primary">Nouvelle candidature</h1>
                </div>
            </div>
            <div class="row">
                <form action="store.php" method="POST" id="formOrder" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="nom" class="col-sm-2 col-form-label">Nom :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de famille" maxlength="45" required/>
                            
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="prenom" class="col-sm-2 col-form-label">Prénom :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Le ou les prénoms" maxlength="45" required/>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email :</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="monemail@example.com" maxlength="120" required/>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telephone" class="col-sm-2 col-form-label">Téléphone :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="+229 90 00 00 00" maxlength="12" required/>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="niveau_etude" class="col-sm-2 col-form-label">Niveau d'étude :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="niveau_etude" name="niveau_etude" placeholder="License, Master ou Doctora" maxlength="45"/>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fichier" class="col-sm-2 col-form-label">Fichier :</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="fichier" name="fichier" placeholder="Mon CV.pdf ou .doc" accept="application/pdf,application/doc,application/docx" maxlength="100"/>
                        </div>
                    </div>
                    <!--- -->
                    <div class="row">
                        <div class="col-md-3">
                            <a href="index.php" class="btn btn-danger btn-sm me-3"><i class="fas fa-folder-plus"></i> <- Annuler</a>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <button id="create" type="submit" class="btn btn-primary" name="create">Enregister <i class="fas fa-plus"></i></button>
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
                            title: "Votre candidatue est enrégistrée avec succès !",
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
                            title: "Désolé, votre candidature n\'a pas pu été enrégisté. Veuillez reéssayer svp !",
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
