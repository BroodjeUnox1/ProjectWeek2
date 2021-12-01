<!-- signup form -->
<div class="grid-container">
    <div class="login-form">
        <div>
            <form method="POST" action="./api/inschrijven/inschrijf.php">
                <div class="form-group px-5">
                    <label for="bsn">BSN-nummer (9 cijfers)</label>
                    <input class="form-control formInput my-2" type="number" name="bsn" required="">
                    <label for="email">E-mailadres</label>
                    <input class="form-control formInput my-2" type="email" name="email" required="">
                    <label for="fullName">Volledige naam</label>
                    <input class="form-control formInput my-2" type="text" name="fullname" required="">
                    <label for="age">Geboortedatum</label>
                    <input class="form-control formInput my-2" type="date" name="date" required="">
                    <label for="number">Telefoonnummer</label>
                    <input class="form-control formInput my-2" type="tel" name="tel" required="">
                    <button type="submit" name="submit" class="btn btn-block formBtn">Schrijf je in</button>
                </div>
            </form>
        </div>
    </div>
</div>