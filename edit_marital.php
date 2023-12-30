<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    include 'config.php';

    // Cek apakah ID marital telah diberikan
    if(isset($_GET['id'])) {
        $marital_id = $_GET['id'];

        // Ambil data marital dari database berdasarkan ID
        $query = "SELECT * FROM `marital` WHERE `marital_id` = $marital_id;";
        $result = mysqli_query($conn, $query);

        if($result->num_rows == 1) {
            $marital = mysqli_fetch_assoc($result);
        } else {
            // Redirect jika marital tidak ditemukan
            header("Location: marital.php");
            exit();
        }
    } else {
        // Redirect jika ID marital tidak diberikan
        header("Location: marital.php");
        exit();
    }

    // Proses pengiriman form edit
    if(isset($_POST['edit_marital'])) {
        $new_marital_name = $_POST['new_marital_name'];

        // Update data marital ke database
        $update_query = "UPDATE `marital` SET `marital_name` = '$new_marital_name' WHERE `marital_id` = $marital_id;";
        $update_result = mysqli_query($conn, $update_query);

        if($update_result) {
            // Redirect ke halaman marital.php jika update berhasil
            header("Location: marital.php");
            exit();
        } else {
            // Tampilkan pesan error jika update gagal
            echo "Error: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Edit Status Perkawinan</title>
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
            <h2>Edit Status Perkawinan</h2>
        <form method="post">
            <div class="mb-3">
                <label for="new_marital_name" class="form-label">Nama Status Perkawinan Baru</label>
                <input type="text" class="form-control" id="new_marital_name" name="new_marital_name" value="<?= $marital['marital_name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="edit_marital">Simpan Perubahan</button>
            <a href="marital.php" class="btn btn-secondary">Batal</a>
        </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
