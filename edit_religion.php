<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    include 'config.php';

    // Cek apakah ID agama telah diberikan
    if(isset($_GET['id'])) {
        $religion_id = $_GET['id'];

        // Ambil data agama dari database berdasarkan ID
        $query = "SELECT * FROM `religion` WHERE `religion_id` = $religion_id;";
        $result = mysqli_query($conn, $query);

        if($result->num_rows == 1) {
            $religion = mysqli_fetch_assoc($result);
        } else {
            // Redirect jika agama tidak ditemukan
            header("Location: religion.php");
            exit();
        }
    } else {
        // Redirect jika ID agama tidak diberikan
        header("Location: religion.php");
        exit();
    }

    // Proses pengiriman form edit
    if(isset($_POST['edit_religion'])) {
        $new_religion_name = $_POST['new_religion_name'];

        // Update data agama ke database
        $update_query = "UPDATE `religion` SET `religion_name` = '$new_religion_name' WHERE `religion_id` = $religion_id;";
        $update_result = mysqli_query($conn, $update_query);

        if($update_result) {
            // Redirect ke halaman religion.php jika update berhasil
            header("Location: religion.php");
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
        <title>Edit Agama</title>
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
            <h2>Edit Agama</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="new_religion_name" class="form-label">Nama Agama Baru</label>
                    <input type="text" class="form-control" id="new_religion_name" name="new_religion_name" value="<?= $religion['religion_name']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="edit_religion">Simpan Perubahan</button>
                <a href="religion.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
