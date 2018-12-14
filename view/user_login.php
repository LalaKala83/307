<h1><?= $heading?></h1>
<form action="authenticate" method="post">
    <div data-html="true" id="login">
        <p>
            <div id="textred">
                <?php if (!empty($validation)): ?>
                    <p><?= $validation ?></p>
                <?php endif; ?>
            </div>
            <label for="username">Benutzername</label>
            <br>
            <input id="username" name="username" type="text">
            <br>
            <br>
            <label for="password">Passwort</label>
            <br>
            <input id="password" name="password" type="password">
            <br>
            <br>
            <input id="button" class="boxRound type2" type="submit" value="Absenden"/>
            <br>
            <br>
            <div class="boxRound type1">
                <a href="/user/create">Registrieren</a>
            </div>
        </p>
    </div>
</form>