<h1><?= $heading?></h1>
<form action="authenticate" method="post">
    <div data-html="true" id="login">
        <p>
            <div id="textred"><?= $validation ?></div>
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

        </p>
    </div>
</form>