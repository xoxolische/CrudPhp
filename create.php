<?php

require 'database.php';

if (!empty($_POST)) {
    $authorError = null;
    $titleError = null;
    $descriptionError = null;

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
        $sql = "INSERT INTO address_book (author, title, description) values(?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($author, $title, $description));
        Database::disconnect();
        header("Location: index.php");
    }
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
        <div class="offset-4 col-md-4">
            <form action="create.php" method="post">
                <div class="form-group" <?php echo !empty($authorError) ? 'error' : ''; ?>">
                <label class="control-label">Author:</label>
                <div class="form-group">
                    <input name="author" type="text" placeholder="Author"
                           value="<?php echo !empty($author) ? $author : ''; ?>">
                    <?php if (!empty($authorError)): ?>
                        <span class="help-inline"><?php echo $authorError; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group" <?php echo !empty($titleError) ? 'error' : ''; ?>">
                <label class="control-label">Title:</label>
                <div class="form-group">
                    <input name="title" type="text" placeholder="Title"
                           value="<?php echo !empty($title) ? $title : ''; ?>">
                    <?php if (!empty($titleError)): ?>
                        <span class="help-inline"><?php echo $titleError; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group" <?php echo !empty($descriptionError) ? 'error' : ''; ?>">
                <label class="control-label">Description:</label>
                <div class="form-group">
                <textarea class="form-control" name="description" rows="3"
                          value="<?php echo !empty($description) ? $description : ''; ?>"></textarea>
                    <?php if (!empty($descriptionError)): ?>
                        <span class="help-inline"><?php echo $descriptionError; ?></span>
                    <?php endif; ?>
                </div>


        </div>


        <div>
            <button type="submit" class="btn btn-success">Post</button>
            <a class="btn" href="index.php">Previous Page</a>
        </div>
    </div>
    </form>
</div>
</div>
</body>
</html>