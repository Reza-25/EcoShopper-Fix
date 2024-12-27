<?php
session_start();
include 'config.php';

$loginMessage = '';
$registerMessage = '';

// login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query untuk mengambil data pengguna berdasarkan username
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            // Login berhasil
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            header("Location:./Main/Home.php");
            exit();
        } else {
            $loginMessage = "Password salah.";
        }
    } else {
        $loginMessage = "Username tidak ditemukan.";
    }

    $stmt->close();
}

// Proses registrasi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $profilePicture = isset($_FILES["profile_picture"]) ? $_FILES["profile_picture"] : null;

    if ($password !== $confirmPassword) {
        $registerMessage = "Password tidak cocok.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah email atau username sudah terdaftar
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $registerMessage = "Username atau email sudah terdaftar.";
        } else {
            // Upload foto profil
            $profilePicturePath = null;
            if ($profilePicture && $profilePicture["tmp_name"]) {
                $extension = pathinfo($profilePicture["name"], PATHINFO_EXTENSION);
                $profilePicturePath = 'uploads/' . uniqid() . '.' . $extension;
                move_uploaded_file($profilePicture["tmp_name"], $profilePicturePath);
            }

            // Insert pengguna baru ke database
            $stmt = $db->prepare("INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $profilePicturePath);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $registerMessage = "Registrasi berhasil! Silakan login.";
                echo "<script>
                    setTimeout(() => {
                        alert('Registrasi berhasil! Silakan login.');
                        toggleForm();
                    }, 500);
                </script>";
            } else {
                $registerMessage = "Registrasi gagal. Silakan coba lagi.";
            }
        }

        $stmt->close();
    }
}
?>