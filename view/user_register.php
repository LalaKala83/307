    <h1><?= $title?></h1>
    <form action="save" method="post">
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
            <input id="button" class="boxRound buttonCenter" type="submit" value="Absenden"/>
            <br>
            <br>
        </div>
    </form>
