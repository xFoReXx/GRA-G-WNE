<?php
$buildingList = $v->buildingList();
$mainContent = "<h3>Ratusz<h3>";
$mainContent = "<table class=\"table table-bordered\">";
$mainContent .= "<tr><th>Nazwa budyku</th><th>Poziom budynku</th>
                <th>Produkcja/h / pojemność</th><th>Koszt ulepszenia</th><th>Rozbudowa</th></tr>";
foreach($buildingList as $index => $building) 
{
    $name = $building['buildingName'];
    $level = $building['buildingLVL'];
    $upgradeCost = "";
    foreach($building['upgradeCost'] as $resource => $cost)
    {
        $upgradeCost .= "$resource: $cost,";
    }
    $mainContent .="<tr><td>$name</td><td>$level</td>";
    if(isset($building['capacity']))
    {
        $gain = $building['hourGain'];
        $cap = $building['capacity'];
        $mainContent .="<td>$gain / $cap</td>";
    }
    else 
    {
        $mainContent .="<td></td>";
    }
    $mainContent .="<td>$upgradeCost</td>";
    if($v->checkBuildingUpgrade($name))
        $mainContent .= 
            "<td><a href=\"index.php?action=upgradeBuilding&building=$name\">
            <button>Rozbuduj</button>
            </a></td>";
    else
        $mainContent .= "<td></td>";
    $mainContent .="</tr>";
}
$mainContent .= "</table>";
$mainContent .= "<h3>Aktywne budowy:</h3>";
$tasks = $gm->s->getTasksByFunction("scheduledBuildingUpgrade"); //znajdz na liscie zadan wszystie dotyczace rozbudoqwy budynków
foreach($tasks as $task)
{
    $buildingName = $task['param'];
    $scheduledTime = $task['timestamp'];
    $mainContent .= "<p>Budynek $buildingName będzie gotowy ".date('d.m.Y H:i:s', $scheduledTime)."</p>";
}

$mainContent .= "<a href=\"index.php\">Powrót</a>";

?>