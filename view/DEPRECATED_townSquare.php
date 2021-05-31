<?php
$mainContent = "<h3>Plac wojskowy<h3>";
$mainContent = "<table class=\"table table-bordered\">";
$mainContent .= "<tr><th>Nazwa jednostki</th><th>Ilość jednostek</th>
                <th>Do wyszkolenia</th><th>Trenuj</th></tr>";

$mainContent .= "<tr>
                    <td>Włócznicy</td>
                    <td>0</td>
                    <form method=\"get\" action=\"index.php\">
                    <input type=\"hidden\" name=\"action\" value=\"newUnit\">
                    <td><input type=\"number\" name=\"spearmen\" id=\"spearmen\"></td>
                    <td><button type=\"submit\">Wyszkol</button></td>
                    </form>
                </tr>";

$mainContent .= "<tr>
                    <td>Łucznicy</td>
                    <td>0</td>
                    <form method=\"get\" action=\"index.php\">
                    <input type=\"hidden\" name=\"action\" value=\"newUnit\">
                    <td><input type=\"number\" name=\"archer\" id=\"archer\"></td>
                    <td><button type=\"submit\">Wyszkol</button></td>
                    </form>
                </tr>";

$mainContent .= "<tr>
                    <td>Kawaleria</td>
                    <td>0</td>
                    <form method=\"get\" action=\"index.php\">
                    <input type=\"hidden\" name=\"action\" value=\"newUnit\">
                    <td><input type=\"number\" name=\"cavalry\" id=\"cavalry\"></td>
                    <td><button type=\"submit\">Wyszkol</button></td>
                    </form>
                </tr>";

$mainContent .= "</table>";
$mainContent .= "<h3>Obecne armie:</h3>";
$armyList = $gm->getArmyList();
$mainContent .= "<table class=\"table table-bordered\">";
$mainContent .= "<tr>
                    <th>Nazwa armii</th>
                    <th>Włócznicy</th>
                    <th>Łucznicy</th>
                    <th>Kawaleria</th>
                </tr>";
if(is_array($armyList)) 
{
    foreach($armyList as $army)
    {
        $mainContent .= "<tr>";
        $mainContent .= "<td></td>";
        $mainContent .= "<td>$army->spearmen</td>";
        $mainContent .= "<td>$army->archers</td>";
        $mainContent .= "<td>$army->cavalry</td>";
        $mainContent .= "</tr>";
    }
}

$mainContent .= "</table>";
?>