<h1><?= $heading?></h1>
<form action="authenticate" method="post">
    <div data-html="true" id="login">
        <p>
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
            <input id="button" type="submit" value="Absenden"/>
            <div id="textred"><?= $invalidData ?></div>
        </p>
    </div>
</form>