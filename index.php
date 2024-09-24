<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Hurtownia szkolna</title>    
    <link rel="stylesheet" href="styl.css">  
</head>
<body>
<!--baner-->
<header>
<h1>Hurtownia z najlepszymi cenami</h1>
</header>
    
<!--LEWA STR-->
<section>
<h2>Nasze ceny</h2>
<?php

$conn = mysqli_connect('localhost', 'root', '', 'sklep2');


if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
}

$zapytanie = "SELECT nazwa, cena FROM towary LIMIT 4";
$wynik = mysqli_query($conn, $zapytanie);

if (mysqli_num_rows($wynik) > 0) {
    echo "<table>";
    while ($wiersz = mysqli_fetch_assoc($wynik)) {
        echo "<tr><td>" . $wiersz['nazwa'] . "</td><td>" . $wiersz['cena'] . " zł</td></tr>";
    }
    echo "</table>";
} else {
    echo "Brak danych.";
}

mysqli_close($conn);

?>


</section>
<!--SRODEK STR-->
<main>
<h2>Koszt zakupów</h2>
<form method='POST' action="index.php">
    <p>wybierz artykuł</p>
    <select name="lista" id="lista">
        <option>Zeszyt 60 kartek</option>
        <option>Zeszyt 32 kartki</option>
        <option>Cyrkiel</option>
        <option>Linijka 30 cm</option>
    </select><br>
    liczba sztuk: <input type="number" name="liczba" id="liczba"><br>
  
    <button>OBLICZ</button><br>
    <?php
// Połączenie z bazą danych MySQL
$conn = mysqli_connect('localhost', 'root', '', 'sklep2');

// Sprawdzanie połączenia
if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
}

// Sprawdzanie, czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pobieranie danych z formularza
    $wybrany_towar = $_POST['lista'];
    $liczba_sztuk = intval($_POST['liczba']);

    // Tworzenie zapytania do bazy danych na podstawie wybranego towaru
    $zapytanie = "SELECT cena FROM towary WHERE nazwa='$wybrany_towar'";
    $wynik = mysqli_query($conn, $zapytanie);

    // Sprawdzanie, czy zapytanie zwróciło wynik
    if ($wynik && mysqli_num_rows($wynik) > 0) {
        // Pobieranie ceny towaru
        $wiersz = mysqli_fetch_assoc($wynik);
        $cena_towaru = floatval($wiersz['cena']);

        // Obliczanie wartości zakupów
        $wartosc_zakupow = $cena_towaru * $liczba_sztuk;
        echo "Wartość zakupów: " . number_format($wartosc_zakupow, 2) . " zł";
    } else {
        echo "Nie znaleziono wybranego towaru.";
    }
}

// Zamknięcie połączenia z bazą
mysqli_close($conn);
?>

</form>
</main>
<!--PRAWA STR-->
<aside>
<h2>Kontak</h2>
<img src=" zakupy.png" alt="hurtownia">
<p><a href="hurt@poczta2.pl ">e-mail: hurt@poczta2.pl</a></p>
</aside>

<footer>
   <h4>Witrynę wykonał: nr 7</h4> 
</footer>


</body>
</html>
    