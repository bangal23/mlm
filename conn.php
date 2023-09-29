<?php

    function bukaKoneksi(){
        $host = 'localhost';
        $dbname = 'mlm';
        $username = 'root';
        $password = '';
    
        try {
            $koneksi = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $koneksi;
        } catch (PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
            return null;
        }
    }

    function tutupKoneksi($koneksi) {
        $koneksi = null;
    }

    function generateRandomNumber() {
        return mt_rand(10000, 99999);
    }
    
    // Fungsi untuk memeriksa apakah angka sudah ada di dalam database
    function isNumberExistsInDatabase($number, $koneksi) {
        try {
            $sql = "SELECT COUNT(*) FROM tb_members WHERE id = :number";
            $stmt = $koneksi->prepare($sql);
            $stmt->bindParam(':number', $number, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();
    
            return ($count > 0);
        } catch (PDOException $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
            return false;
        }
    }

    function getRandomNumber(){
        $koneksi = bukaKoneksi();
        if ($koneksi) {
            do {
                // Menghasilkan angka acak
                $angka_acak = generateRandomNumber();
        
                // Memeriksa apakah angka sudah ada di dalam database
                $angka_ada_di_database = isNumberExistsInDatabase($angka_acak, $koneksi);
            } while ($angka_ada_di_database);
        
            // Sekarang $angka_acak adalah angka acak yang belum ada di dalam database
            echo $angka_acak;
        
            // Menggunakan fungsi tutupKoneksi untuk menutup koneksi
            tutupKoneksi($koneksi);
        }
    }

    function tampilSemuaData(){
        $koneksi = bukaKoneksi();
        if ($koneksi) {
            // Eksekusi perintah SQL
            try {
                $sql = "SELECT * FROM tb_members";
                $stmt = $koneksi->prepare($sql);
                $stmt->execute();
        
                // Mengambil hasil query ke dalam array
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Menggunakan fungsi tutupKoneksi untuk menutup koneksi
                tutupKoneksi($koneksi);
                return $result;
        
            } catch (PDOException $e) {
                echo "Terjadi kesalahan: " . $e->getMessage();
            }
        
        }
    }
?>