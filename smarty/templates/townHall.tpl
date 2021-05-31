<h3>Ratusz</h3>
<table class="table table-bordered">
<tr>
<th>Nazwa budyku</th>
<th>Poziom budynku</th>
<th>Produkcja/h / pojemność</th>
<th>Koszt ulepszenia</th>
<th>Rozbudowa</th>
</tr>
{foreach from=$buildingList key=key item=building}

    <tr>
    <td>{$building.buildingName}</td>
    <td>{$building.buildingLVL}</td>
    <td>{$building.hourGain|default:""} / {$building.capacity|default:""}</td>
    <td> {*upgrade cost*}
        {foreach from=$building.upgradeCost key=resource item=cost}
            {$resource}: {$cost}
        {/foreach}
    </td>
    <td>
    {if $building.upgradePossible}
        <a href="index.php?action=upgradeBuilding&building={$building.buildingName}">
            <button>Rozbuduj</button>
    </a>
    {/if}
    </td>
    </tr>
{/foreach}
</table>
<h3>Aktywne budowy:</h3>
{foreach from=$buildingUpgrades item=buildingUpgrade}
    <p>Budynek {$buildingUpgrade.param} będzie gotowy {$buildingUpgrade.timestamp|date_format:$config.datetime}</p>
{/foreach}
<a href="index.php">Powrót</a>