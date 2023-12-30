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

        // Hapus data marital dari database berdasarkan ID
        $delete_query = "DELETE FROM `marital` WHERE `marital_id` = $marital_id;";
        $delete_result = mysqli_query($conn, $delete_query);

        if($delete_result) {
            // Redirect ke halaman marital.php jika delete berhasil
            header("Location: marital.php");
            exit();
        } else {
            // Tampilkan pesan error jika delete gagal
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Redirect jika ID marital tidak diberikan
        header("Location: marital.php");
        exit();
    }
?>
