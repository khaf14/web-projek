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

        // Hapus data agama dari database berdasarkan ID
        $delete_query = "DELETE FROM `religion` WHERE `religion_id` = $religion_id;";
        $delete_result = mysqli_query($conn, $delete_query);

        if($delete_result) {
            // Redirect ke halaman religion.php jika delete berhasil
            header("Location: religion.php");
            exit();
        } else {
            // Tampilkan pesan error jika delete gagal
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Redirect jika ID agama tidak diberikan
        header("Location: religion.php");
        exit();
    }
?>
