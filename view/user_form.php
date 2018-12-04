    <h1>Registrierung</h1>
    <form action="../public/index.php/user/save" method="post">
        <div data-html="true" id="login">
            <p>
            <label for="username">Benutzername</label>
            <br>
            <input id="username" name="username" type="text">
            <br>
            <br>
            <label for="email">E-Mail</label>
            <br>
            <input id="email" name="email" type="email">
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