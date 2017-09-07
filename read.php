<?php
/**
 * Created by PhpStorm.
 * User: Nikita Pavlov
 * Date: 07.09.2017
 * Time: 16:57
 */

require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if ($id == null) {
    header("Location: index.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM address_book where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
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

        <form class="col-md-8 offset-2">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="<?php echo $data['id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Author:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="<?php echo $data['author']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Title:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="<?php echo $data['title']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Date:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="<?php echo $data['creation_date']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-10">
                    <textarea type="text" rows="5" class="form-control" placeholder="<?php echo $data['description']; ?>" readonly></textarea>
                </div>
            </div>

            <div>
                <a class="btn" href="index.php">Previous Page</a>
            </div>
        </form>
    </div>

</div> <!-- /container -->
</body>
</html>