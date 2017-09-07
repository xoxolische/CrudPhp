<?php
/**
 * Created by PhpStorm.
 * User: Nikita Pavlov
 * Date: 07.09.2017
 * Time: 18:09
 */


require 'database.php';


if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {
    $authorError = null;
    $titleError = null;
    $descriptionError = null;

    $id = $_POST['id'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $valid = true;
    if (empty($author)) {
        $authorError = 'Please enter an Author';
        $valid = false;
    }

    if (empty($title)) {
        $titleError = 'Please enter a Title';
        $valid = false;
    }

    if (empty($description)) {
        $descriptionError = 'Please enter a Description';
        $valid = false;
    }

    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE address_book set author=?, title=?, description=? WHERE id=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($author, $title, $description, $id));
        Database::disconnect();
        header("Location: index.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM address_book where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    $author = $data['author'];
    $title = $data['title'];
    $description = $data['description'];
    $creationDate = $data['creation_date'];
    Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="offset-2 col-md-8">
            <form action="update.php" method="post">

                <div class="form-group row">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label class="col-sm-2 col-form-label">ID:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="<?php echo $id; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Author:</label>
                    <div class="col-sm-10">
                        <input name="author" type="text" class="form-control" value="<?php echo $author; ?>">
                        <?php if (!empty($authorError)): ?>
                            <span class="help-inline"><?php echo $authorError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Title:</label>
                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control" value="<?php echo $title; ?>">
                        <?php if (!empty($titleError)): ?>
                            <span class="help-inline"><?php echo $titleError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-10">
                        <textarea name="description" type="text" rows="5" class="form-control"><?php echo $description; ?></textarea>
                        <?php if (!empty($descriptionError)): ?>
                            <span class="help-inline"><?php echo $descriptionError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-success">UPDATE</button>
                    <a class="btn" href="index.php">Previous Page</a>
                </div>

        </div>
    </div>
    </form>
</div>
</div>
</body>
</html>