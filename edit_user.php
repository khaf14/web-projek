<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    include 'config.php';

    $user_id = $_GET['id'];
    if(isset($_POST['username'])){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];

        $query = "UPDATE `user` SET `user_fullname`='$fullname',`user_name`='$username' WHERE `user_id`='$user_id'";
        $result = mysqli_query($conn, $query);
        header("Location: user.php");
        exit();
    }else{
        $query = "SELECT * FROM user WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if(@$row){
            $fullname = $row['user_fullname'];
            $username = $row['user_name'];
        }else{
            header("Location: user.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .container {
                margin-top: 50px;
            }
        </style>
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <div class="container">
            <form method="post" action="edit_user.php?id=<?= $user_id; ?>">
                <div class="form-group">
                    <label>Nama Lengkap:</label>
                    <input type="text" class="form-control" name="fullname" value="<?= $fullname; ?>" placeholder="Fullname" required>
                </div>
                <div class="form-group">
                    <label>Nama Pengguna:</label>
                    <input type="text" class="form-control" name="username" value="<?= $username; ?>" placeholder="Username" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="user.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
