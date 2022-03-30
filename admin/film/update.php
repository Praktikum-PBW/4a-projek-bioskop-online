<?php
if (isset($_POST['edit'])) {
    $kd_film = htmlentities(string: htmlspecialchars(string: strip_tags(string: trim(string: $_POST['kd_film']))));
    $judul = htmlentities(string: htmlspecialchars(string: strip_tags(string: trim(string: $_POST['judul']))));
    $genre = htmlentities(string: htmlspecialchars(string: strip_tags(string: trim(string: $_POST['genre']))));
    $durasi = htmlentities(string: htmlspecialchars(string: strip_tags(string: trim(string: $_POST['durasi']))));
    $usia = htmlentities(string: htmlspecialchars(string: strip_tags(string: trim(string: $_POST['usia']))));
    $sinopsis = htmlentities(string: htmlspecialchars(string: strip_tags(string: trim(string: $_POST['sinopsis']))));

    //poster
    $extensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $poster = $_FILES['poster']['name'];
    $x = explode(separator: '.', string: $poster);
    $ekstensi = strtolower(string: end(array: $x));
    $ukuran = $_FILES['poster']['size'];
    $file_tmp = $_FILES['poster']['tmp_name'];

    if (in_array(needle: $ekstensi, haystack: $extensi_diperbolehkan) == true) {
        if ($ukuran < 10044070) {
            move_uploaded_file(from: $file_tmp, to: '../assets/img/' . $poster);
            $query = mysqli_query(mysql: $koneksi, query: "UPDATE film SET judul='$judul',poster='$poster',genre='$genre',durasi='$durasi',rating_usia='$usia',sinopsis='$sinopsis' WHERE kd_film='$kd_film'");

            if ($query) {
                header(header: "location: index.php?page=film");
            } else {
                echo "Gagal";
            }
        } else {
            echo "Ukuran file terlalu besar";
        }
    } else {
        echo "Ekstensi tidak sesuai";
    }
}