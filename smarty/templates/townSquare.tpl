<h3>Plac wojskowy</h3>
        <table class="table table-bordered">
            <tr>
                <th>Nazwa jednostki</th>
                <th>Ilość jednostek</th>
                <th>Do wyszkolenia</th>
                <th>Trenuj</th>
            </tr>
            <tr>
                <td>Włócznicy</td>
                <td>0</td>
                <form method="get" action="index.php">
                    <input type="hidden" name="action" value="newUnit">
                    <td><input type="number" name="spearmen" id="spearmen"></td>
                    <td><button type="submit">Wyszkol</button></td>
                </form>
            </tr>

            <tr>
                <td>Łucznicy</td>
                <td>0</td>
                <form method="get" action="index.php">
                    <input type="hidden" name="action" value="newUnit">
                    <td><input type="number" name="archer" id="archer"></td>
                    <td><button type="submit">Wyszkol</button></td>
                </form>
            </tr>

            <tr>
                <td>Kawaleria</td>
                <td>0</td>
                <form method="get" action="index.php">
                    <input type="hidden" name="action" value="newUnit">
                    <td><input type="number" name="cavalry" id="cavalry"></td>
                    <td><button type="submit">Wyszkol</button></td>
                </form>
            </tr>

        </table>
<h3>Obecne armie:</h3>


        <table class="table table-bordered">
            <tr>
                <th>Nazwa armii</th>
                <th>Włócznicy</th>
                <th>Łucznicy</th>
                <th>Kawaleria</th>
            </tr>
            {foreach from=$armyList item=army}
            <tr>
                <td>{$army->spearmen}</td>
                <td>{$army->archers}</td>
                <td>{$army->cavalry}</td>
            </tr>
            {/foreach}
        </table>