<p>
    <link href="../public/css/style.css" rel="stylesheet">
    <h1>Registrierung</h1>
    <form class="form-horizontal" action="/user/save" method="post">
        <div data-html="true" id="login">
            <p for="username">Benutzername</p>
            <br>
            <input id="username" name="username" type="text">
            <br>
            <br>
            <p for="email">E-Mail</p>
            <br>
            <input id="email" name="email" type="email">
            <br>
            <br>
            <p for="password">Passwort</p>
            <br>
            <input id="password" name="password" type="password">
            <br>
            <br>
            <input id="button" type="submit" value="Absenden"/>
        </div>
    </form>
</p>