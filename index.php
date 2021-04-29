<?php 
        require_once('./class/GameManager.class.php');
        session_start();
        if(!isset($_SESSION['gm'])) // jeżeli nie ma w sesji naszej wioski
        {
            $gm = new GameManager();
            $_SESSION['gm'] = $gm;
        } 
        else //mamy już wioskę w sesji - przywróć ją
        {
            $gm = $_SESSION['gm'];
        }
        $v = $gm->v; //niezależnmie czy nowa gra czy załadowana
        $gm->sync(); //przelicz surowce

        if(isset($_REQUEST['action'])) 
        {
            switch($_REQUEST['action'])
            {
                case 'upgradeBuilding':
                    $v->upgradeBuilding($_REQUEST['building']);
                break;
                case 'townHall' :
                    $buildingList = $v->buildingList();
                    $mainContent = "<table class=\"table table-bordered\">";
                    $mainContent .= "<tr><th>Nazwa budynku</th><th>Poziom budynku</th>
                                   <th>Produkcja/h / pojemność</th><th>Kosz ulepszenia</th><th>Rozbudowa</th></tr>";
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
                    $mainContent .= "<a href=\"index.php\">Powrót</a>";
                break;
                default:
                    $gm->l->log( "Nieprawidłowa zmienna \"action\"", "controller", "error");
            }
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <header class="row border-bottom">
            <div class="col-12 col-md-3">
                Informacje o graczu
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 col-md-3">
                        Drewno: <?php echo $v->showStorage("wood"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Żelazo: <?php echo $v->showStorage("iron"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Zasób 3
                    </div>
                    <div class="col-12 col-md-3">
                        Zasób 4
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                Guzik wyloguj
            </div>
        </header>
        <main class="row border-bottom">
            <div class="col-12 col-md-2 border-right">
                Lista budynków<br>
                <!--
                Drwal, poziom <?php echo $v->buildingLVL("woodcutter"); ?> <br>
                Zysk/h: <?php echo $v->showHourGain("wood"); ?><br>
                <?php if($v->checkBuildingUpgrade("woodcutter")) : ?>
                <a href="index.php?action=upgradeBuilding&building=woodcutter">
                    <button>Rozbuduj drwala</button>
                </a><br>
                <?php else : ?>
                    <button onclick="missingResourcesPopup()">Rozbuduj drwala</button>
                <br>
                <?php endif; ?> 
                Kopalnia żelaza, poziom <?php echo $v->buildingLVL("ironMine"); ?> <br>
                Zysk/h: <?php echo $v->showHourGain("iron"); ?><br>
                <?php if($v->checkBuildingUpgrade("ironMine")) : ?>
                <a href="index.php?action=upgradeBuilding&building=ironMine">
                    <button>Rozbuduj kopalnie żelaza</button>
                </a>
                <?php else : ?>
                    <button onclick="missingResourcesPopup()">Rozbuduj kopalnie żelaza</button>
                <br>
                <?php endif; ?> 
                <br>
                -->
                <a href="index.php?action=townHall">Ratusz</a>
            </div>
            <div class="col-12 col-md-8">
            <?php if(isset($mainContent)) : 
                    echo $mainContent; ?>
                <?php else : ?>
                Widok wioski
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-2 border-left">
                Lista wojska
            </div>
        </main>
        <footer class="row">
            <div class="col-12">
            <table class="table table-bordered">
            <?php
            


            
            foreach ($gm->l->getLog() as $entry) {
                $timestamp = date('d.m.Y H:i:s', $entry['timestamp']);
                $sender = $entry['sender'];
                $message = $entry['message'];
                $type = $entry['type'];
                 echo "<tr>";
                 echo "<td>$timestamp</td>";
                 echo "<td>$sender</td>";
                 echo "<td>$message</td>";
                 echo "<td>$type</td>";
                 echo "</tr>";
            }
            
            ?>
            </table>
            </div>
        </footer>
    </div>
        <script>
            function missingResourcesPopup(){
                window.alert("Brakuje zasobów");
            }
        </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html> 