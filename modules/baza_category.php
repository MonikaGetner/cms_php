<?php

function view_kategorie()
{

    $host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "CMS";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($polaczenie->connect_errno != 0) {
        echo "Error: " . $polaczenie->connect_errno;
    } else {
        $sql = "SELECT *FROM  kategorie";
        $i=0;
        if ($rezultat = @$polaczenie->query($sql)) {
            while ($wiersz = $rezultat->fetch_assoc()) {

                $kategoria['id']= $wiersz['id'];
                $kategoria['name']= $wiersz['kategoria'];
                $kategorie[$i]=$kategoria;
                $i++;

            }
            $rezultat->close();
            $polaczenie->close();

        } else {
            echo "blad w zapytaniu ";
        }
    }

    print_r($kategorie);
 return $kategorie;
}

?>