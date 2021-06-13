{include file="header.tpl"}
<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3 text-center">
            <h1>Utwórz nowe konto</h1>
            <form action="/register" method="post">
                <input type="hidden" name="action" value="register">
                <div class="form-group">
                    <label for="login">Adres e-mail:</label>
                    <input class="form-control" type="email" name="login" id="login">
                </div>
                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input class="form-control" type="password" name="password" id="password">  
                </div>
                <button class="btn btn-primary" type="submit">Zarejestruj się</button>
            </form>
        </div>
    </div>
</div><!-- /container -->
{include file="footer.tpl"}