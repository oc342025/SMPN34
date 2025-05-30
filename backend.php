<?php
// db.php
$host = 'localhost';
$db = 'smpn34';
$user = 'root';
$pass = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Koneksi gagal: " . $e->getMessage());
}

// register.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
  require 'db.php';
  
  $nama = $_POST['nama'];
  $nis = $_POST['nis'];
  $kelas = $_POST['kelas'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  $stmt = $pdo->prepare("INSERT INTO siswa (nama, nis, kelas, email, password) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([$nama, $nis, $kelas, $email, $password]);

  echo "Pendaftaran berhasil!";
}

// login.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
  require 'db.php';
  
  $nis = $_POST['nis'];
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM siswa WHERE nis = ?");
  $stmt->execute([$nis]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['siswa_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    echo "Login berhasil!";
  } else {
    echo "NIS atau kata sandi salah.";
  }
}
?>
