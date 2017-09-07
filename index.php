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
            <div class="col-md-4 col-md-offset-4">
                <p>
                    <h3>Coding Test.</h3>
                </p>
                <p>
                    <a href="create.php" class="btn btn-success">New Post</a>
                </p>
            </div>
        </div>
        <div class="row">
            <table class="table table-inverse table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Creation Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include 'database.php';
                $pdo = Database::connect();
                $sql = 'SELECT * FROM address_book WHERE deleted = 0';
                foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>'. $row['id'] . '</td>';
                    echo '<td>'. $row['author'] . '</td>';
                    echo '<td>'. $row['creation_date'] . '</td>';
                    echo '<td>
                            <a class="btn btn-info" href="read.php?id='.$row['id'].'">Get</a>
                            <a class="btn btn-warning" href="update.php?id='.$row['id'].'">Put(Edit)</a>
                            <a class="btn btn-danger" href="delete.php?id='.$row['id'].'&author='.$row['author'].'&title='.$row['title'].'">Delete</a></td>';
                    echo '</tr>';
                }
                Database::disconnect();
                ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
