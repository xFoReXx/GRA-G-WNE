<?php
session_start();

if( !isset($_SESSION['ostatniRefresh']) ) //sprawdź czy istnieje taka zmienna w sesji
{
    $_SESSION['ostatniRefresh'] = time(); //jeżeli nie istnieje taka zmienna w sesji to zapisz obecny czas
    $_SESSION['skladDrewna'] = 0;
}
else
{
    $staryCzas = date('H:i:s d.m.Y', $_SESSION['ostatniRefresh']); // czas pierwszego odświeżenia strony
    $nowyCzas = date('H:i:s d.m.Y'); // czas teraz
    $iloscSekund = time() - $_SESSION['ostatniRefresh'];
    echo "Od $staryCzas do teraz ($nowyCzas) minęło $iloscSekund sekund<br>";
    $produkcjaDrewna = 1000;
    $_SESSION['składDrewna'] += $iloscSekund * ( $produkcjaDrewna / 3600 );
    echo "Skład drewna: ".floor($_SESSION['SkładDrewna'])."<br>";
    $_SESSION['ostatniRefresh'] = time();
}

?>