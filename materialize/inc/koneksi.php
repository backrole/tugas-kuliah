<?php  
    try {
        $db = new PDO("mysql:host=localhost;dbname=bahanbaku","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo "Koneksi Gagal ".$e->getMessage();
    }
?>