<?php

function insertDataToDatabase($conn, $nama, $nim, $tgl_lahir, $alamat)
{
    $query = "INSERT INTO data_mhs (nama, nim, tgl_lahir, alamat) VALUES (:nama, :nim, :tgl_lahir, :alamat)";

    $params = array(
        ':nama' => $nama,
        ':nim' => $nim,
        ':tgl_lahir' => $tgl_lahir,
        ':alamat' => $alamat,
    );

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute($params);

        return true;
    } catch (PDOException $e) {
        return "Kesalahan tambah: " . $e->getMessage();
    }
}


function generateKeys() {
    $p = 11; 
    $q = 13; 

    $n = $p * $q; 
    $phi = ($p - 1) * ($q - 1); 

    $e = 17; 

    $d = modInverse($e, $phi);

    return [
        'public_key' => [$n, $e],
        'private_key' => [$n, $d]
    ];
}

function modInverse($a, $m) {
    for ($x = 1; $x < $m; $x++) {
        if (($a * $x) % $m == 1) {
            return $x;
        }
    }
    return 1;
}

function encrypt($nama, $public_key) {
    list($n, $e) = $public_key;

    $ciphertext = '';
    for ($i = 0; $i < strlen($nama); $i++) {
        $ciphertext .= bcpowmod(ord($nama[$i]), $e, $n) . ' ';
    }

    return ($ciphertext);
}

function decrypt($ciphertext, $private_key)
{
    list($n, $d) = $private_key;

    $ciphertextArr = explode(' ', ($ciphertext));
    $plaintext = '';

    foreach ($ciphertextArr as $char) {
        $decryptedChar = bcpowmod($char, $d, $n);
        $plaintext .= chr($decryptedChar);
    }

    return $plaintext;
}

//Enkripsi Alamat
function encryptAlamat($alamat, $public_key) {
    list($n, $e) = $public_key;

    $ciphertext = '';
    for ($i = 0; $i < strlen($alamat); $i++) {
        $ciphertext .= bcpowmod(ord($alamat[$i]), $e, $n) . ' ';
    }

    return trim($ciphertext);
}


function decryptAlamat($ciphertext, $private_key) {
    list($n, $d) = $private_key;

    $ciphertextArr = explode(' ', $ciphertext);
    $plaintext = '';

    foreach ($ciphertextArr as $char) {

        if ($char !== '') {
            $decryptedChar = bcpowmod($char, $d, $n);
            $plaintext .= chr($decryptedChar);
        }
    }

    return $plaintext;
}


$keys = generateKeys();
$public_key = $keys['public_key'];
$private_key = $keys['private_key'];

//POST
require_once 'db_conn.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['aksi']) && $_POST['aksi'] == 'Submit') {
        $nama = htmlspecialchars($_POST['nama']);
        $nim = htmlspecialchars($_POST['nim']);
        $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
        $alamat = htmlspecialchars($_POST['alamat']);

        $ciphertext = encrypt($nama, $public_key);
        $ciphertextAlamat = encryptAlamat($alamat, $public_key);

        $result = insertDataToDatabase($conn, $ciphertext, $nim, $tgl_lahir, $ciphertextAlamat);


        if ($result === true) {
            echo "Data berhasil disimpan.";
            header("Location: index.php");
            exit;
        } else {
            echo $result;
        }
    } else {
        echo "Aksi tidak valid";
    }
} 

?>
