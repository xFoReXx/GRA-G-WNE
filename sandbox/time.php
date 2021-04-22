<?php
$teraz = time();
echo "teraz jest: ".date('H:i:s d.m.Y', $teraz)."<br>";
$losowaLiczbaSekund = rand(0,7200); //od 0 sekund do 2 godzin
$przeszlosc = $teraz - $losowaLiczbaSekund;
echo "W przeszłości ".date('H:i:s d.m.Y', $przeszlosc)." od tego czasu minęło $losowaLiczbaSekund sekund"."<br>";
$produkcjaDrewnaGodzine = 1000;
$produkcja = ($produkcjaDrewnaGodzine / 3600) * $losowaLiczbaSekund;
echo "Od przeszłości do teraz wyprodukowano ".floor($produkcja)." sztuk drewna<br>";

$czasUlepszeniaBudynku = 2700; //45min

echo "Rozpoczęto ulepszanie budynku na następny poziom<br>";
$budynekGotowy = time() + $czasUlepszeniaBudynku;
echo "Budynek będzie gotowy ".date('H:i:s d.m.Y', $budynekGotowy);
?>