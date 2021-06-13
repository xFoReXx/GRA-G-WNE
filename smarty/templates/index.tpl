{include file="header.tpl"}
    <div class="container">
        <header class="row border-bottom">
            <div class="col-12 col-md-3">
                Gracz: {$playerLogin|default:"anonim"}
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 col-md-3">
                        Drewno: {$wood}
                    </div>
                    <div class="col-12 col-md-3">
                        Żelazo: {$iron}
                    </div>
                    <div class="col-12 col-md-3">
                        Jedzenie: {$food}
                    </div>
                    <div class="col-12 col-md-3">
                        Zasób 4
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <<a href="/logout">Reset</a>
            </div>
        </header>
        <main class="row border-bottom">
            <div class="col-12 col-md-2 border-right">
                Lista budynków<br>
                <ul style="list-style-type: none; padding:0;">
                    <li>
                       <a href="/townhall">Ratusz</a>
                    </li>
                    <li>
                        <a href="/townsquare">Plac</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-8">
                {include file="$mainContent"}
            </div>
            <div class="col-12 col-md-2 border-left">
                Lista wojska
            </div>
        </main>
        <footer class="row">
            <div class="col-12">
            
            {include file="log.tpl"}
            
            </div>
        </footer>
    </div> <!-- /container -->
{include file="footer.tpl"}