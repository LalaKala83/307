<h1><?= $heading?></h1>
<form action="authenticate" method="post" autocomplete="off">
    <div data-html="true" id="login">
            <label for="username">Benutzername</label>
            <br>
            <input id="username" name="username" type="text">
            <br>
            <br>
            <label for="password">Passwort</label>
            <br>
            <input id="password" name="password" type="password" >
            <br>
            <br>
            <div id="textred">
                <?php if (!empty($validation)): ?>
                    <?= $validation ?>
                <?php endif; ?>
            </div>
            <input id="button" class="boxRound buttonCenter" type="submit" value="Einloggen"/>
            <br>
            <br>
            <div class="boxRound buttonRight">
                <a href="/user/create">Registrieren</a>
            </div>
    </div>
</form>