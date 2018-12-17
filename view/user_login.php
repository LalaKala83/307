<h1><?= $heading?></h1>
<form action="authenticate" method="post">
    <div data-html="true" id="login">
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
            <input id="button" class="boxRound buttonCenter" type="submit" value="Einloggen"/>
            <br>
            <br>
            <div class="boxRound buttonRight">
                <a href="/user/create">Registrieren</a>
            </div>
    </div>
</form>