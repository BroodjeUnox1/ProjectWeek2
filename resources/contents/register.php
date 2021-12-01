<!-- register form -->
<div class="grid-container">
    <div class="login-form">
        <div>
            <form method="POST" action="./resources/contents/loginHandler.php">
                <div class="form-group px-5">
                    <label for="bsn">Gebruikersnaam</label>
                    <input class="form-control formInput my-2" type="text" name="username" required="">
                    <label for="email">E-mailadres</label>
                    <input class="form-control formInput my-2" type="email" name="email" required="">
                    <label for="fullName">Wachtwoord</label>
                    <input class="form-control formInput my-2" type="password" name="password" required="">
                    <input type="hidden" name="action" value="register">
                    <button type="submit" name="register" class="btn btn-block formBtn">Regristreer je nu!</button>
                </div>
            </form>
        </div>
    </div>
</div>