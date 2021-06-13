{include file="header.tpl"}
<div class="container">
        <div class="row">
            <div class="col-4 offset-4">
                <h1 class="text-center mb-3"> Zarejstruj się </h1>
                <form action="rejstracja.php" method="post">
                    <label class="form-label" for="emailinput">Adres e-mail:</label>
                    <input class="form-control mb-3 " type="email" name="email" id="emailinput" required>
                    <label class="form-label" for="passwordinput">Hasło:</label>
                    <input class="form-control mb-3" type="password" name="password" id="passwordinput">
                    <button class="class=btn btn-primary w-100" type="submit">Załóz kotno</button>
                </form>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
{include file="footer.tpl"}