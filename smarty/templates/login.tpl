{include file="headercss.tpl"}

            <h1>Zaloguj się</h1>
            <form action="/login" method="post">
                <input type="hidden" name="action" value="login">
                <div class="form-group">
                    <label for="login">Adres e-mail:</label>
                    <input class="form-control" type="email" name="login" id="login">
                </div>
                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input class="form-control" type="password" name="password" id="password">  
                </div>
                <button class="btn btn-primary" type="submit">Zaloguj się</button>
                {if isset($error)}
                <div class="alert alert-danger" role="alert">
                    {$error}
                </div>
                {/if}
            </form>
        </div>
    </div>
</div><!-- /container -->
{include file="xd.tpl"}
{include file="footer.tpl"}