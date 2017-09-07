<?php
/**
 * Created by PhpStorm.
 * User: Nikita Pavlov
 * Date: 07.09.2017
 * Time: 17:19
 */

require 'database.php';
$id = 0;

if (!empty($_GET['id']) && !empty($_GET['author']) && !empty($_GET['title'])) {
    $id = $_REQUEST['id'];
    $author = $_REQUEST['author'];
    $title = $_REQUEST['title'];
}

if (!empty($_POST)) {
    $id = $_POST['id'];

    // delete data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE address_book set deleted = 1 WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Database::disconnect();
    header("Location: index.php");

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

    <div class="container">

        <div class="row">
            <div>
                <form class="form-horizontal" action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <p class="alert alert-error">Are you sure to delete <?php echo $author;?>`s entry with Title "<?php echo $title;?>"?</p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Yes</button>
                        <a class="btn" href="index.php">No</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
</body>
</html>