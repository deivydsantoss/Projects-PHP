<?php

require_once("configDatabase.php");


if (isset($_POST['busca'])) {

    $busca = mysqli_real_escape_string($conn, $_POST['busca']);

    $sth = $conn->query("SELECT * FROM anotacoes WHERE status = '1' AND (titulo LIKE '%$busca%' OR autor LIKE '%$busca%' OR text LIKE '%$busca%')");

    $notes = $sth->fetch_all(MYSQLI_ASSOC);

} else if(isset($_POST['lixeira'])){
    
    $lixeira = mysqli_real_escape_string($conn, isset($_POST['lixeira']));

    $sql = $conn->query("SELECT * FROM anotacoes WHERE status = '0'");

    if ($sql->num_rows > 0) {
        $notes_trash = $sql->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "nao tem nada";
    }
    
} else {

    $sql = $conn->query("SELECT * FROM anotacoes WHERE status = '1'");

    if ($sql->num_rows > 0) {
        $notes = $sql->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "nao tem nada";
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/jquery-3.7.1.min.js" defer></script>
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js" defer></script>
    <script type="text/javascript" src=""></script>
</head>

<body class="bg-body-tertiary">
    <header>
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark p-3">
            <div class="container">
                <h1 class="navbar-brand">Notez</h1>

                <form class="" action="Home.php" method="POST">
                    <button class="btn btn-secondary" type="submit" name="lixeira" value="0">Lixeira</button>
                </form>

                <div class="float-end" id="navbarSupportedContent">
                    <form class="d-flex " role="search" action="Home.php" method="POST">
                        <input class="form-control me-2" type="search" name="busca" placeholder="Buscar nota..." aria-label="Search" />
                        <button class="btn btn-primary me-2" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </button>
                    </form>
                    
                </div>
            </div>
        </nav>
    </header>

    <main>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="">
                                Notas
                            </h2>
                            <form action="">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#CriarNotaModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    Criar nota
                                </button>
                            </form>
                        </div>


                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="">Suas Notas</h1>
                                <?php
                                if(isset($_POST['busca'])){
                                    echo'
                                    <a href="Home.php" type="button" class="btn btn-secondary h-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                    Voltar
                                    </a>';
                                }
                                ?>
                                <?php
                                if(isset($_POST['lixeira'])){
                                    echo'
                                    <a href="Home.php" type="button" class="btn btn-secondary h-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                    Voltar
                                    </a>';
                                }
                                ?>
                            </div>
                            <div class="row">
                                <?php foreach ($notes as $note): ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $note['titulo'] ?></h5>
                                                <h6 class="card-subtitle mb-2 text-body-secondary"><?= $note['autor'] ?></h6>
                                                <p class="card-text"><?= $note['text'] ?></p>
                                                <div class="">
                                                    <button type="submit" class="btn btn-primary text-light col-md-3 " data-bs-toggle="modal" data-bs-target="#EditarNotaModal-<?= $note['id'] ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                        </svg>
                                                    </button>
                                                    <button type="submit" class="btn btn-secondary text-light col-md-3 " data-bs-toggle="modal" data-bs-target="#DeletarNotaModal-<?= $note['id'] ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                        </svg>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade modal-lg" id="EditarNotaModal-<?= $note['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="EditarNotaModal">Edite sua nota.</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="./actionsNotes/editNote.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $note['id'] ?>">
                                                        <div class="input-group">
                                                            <input type="text" name="autor" class="form-control" placeholder="Autor" value="<?= $note['autor'] ?>">
                                                        </div>
                                                        <br>
                                                        <div class="input-group">
                                                            <input type="text" name="titulo" class="form-control" placeholder="Titulo" value="<?= $note['titulo'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Nota:</label>
                                                            <textarea class="form-control" name="text" id="message-text"><?= $note['text'] ?></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" name="edit_usuario" class="btn btn-primary">Editar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade modal-lg" id="DeletarNotaModal-<?= $note['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content p-1">
                                                <h1>Você tem certeza?</h1>
                                                <div class="modal-footer">
                                                    <form action="./actionsNotes/moveToTrash.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $note['id'] ?>">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" name="" class="btn btn-primary">Deletar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>

                                <?php foreach ($notes_trash as $note_trash): ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $note_trash['titulo'] ?></h5>
                                                <h6 class="card-subtitle mb-2 text-body-secondary"><?= $note_trash['autor'] ?></h6>
                                                <p class="card-text"><?= $note_trash['text'] ?></p>
                                                <div class="mx-xl-2 row">
                                                    <button type="submit" class="btn btn-danger text-light col-md-3 " data-bs-toggle="modal" data-bs-target="#DeletarNotaModal-<?= $note_trash['id'] ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                        </svg>
                                                    </button>

                                                    <form class="col-md-3" action="./actionsNotes/rescueNote.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $note_trash['id'] ?>">
                                                        <button type="submit" class="btn btn-success text-light">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-up" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5m-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5"/>
                                                            </svg>
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade modal-lg" id="EditarNotaModal-<?= $note_trash['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="EditarNotaModal">Edite sua nota.</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="./actionsNotes/editNote.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $note_trash['id'] ?>">
                                                        <div class="input-group">
                                                            <input type="text" name="autor" class="form-control" placeholder="Autor" value="<?= $note_trash['autor'] ?>">
                                                        </div>
                                                        <br>
                                                        <div class="input-group">
                                                            <input type="text" name="titulo" class="form-control" placeholder="Titulo" value="<?= $note_trash['titulo'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Nota:</label>
                                                            <textarea class="form-control" name="text" id="message-text"><?= $note_trash['text'] ?></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" name="edit_usuario" class="btn btn-primary">Editar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade modal-lg" id="DeletarNotaModal-<?= $note_trash['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content p-1">
                                                <h1>Você tem certeza?</h1>
                                                <div class="modal-footer">
                                                    <form action="./actionsNotes/Trash.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $note_trash['id'] ?>">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" name="" class="btn btn-primary">Deletar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-lg" id="CriarNotaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="CriarNotaModal">Crie sua nova nota.</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./actionsNotes/createNote.php" method="POST">
                            <div class="input-group">
                                <input type="text" name="autor" class="form-control" placeholder="Autor">
                            </div>
                            <br>
                            <div class="input-group">
                                <input type="text" name="titulo" class="form-control" placeholder="Titulo">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Nota:</label>
                                <textarea class="form-control" name="text" id="message-text"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="create_usuario" class="btn btn-primary">Criar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>

</html>