<h1><?= $heading?></h1>
<form action="changing" method="post">
    <div data-html="true" id="login">
        <p>
            <div id="textred">
                <?php if (!empty($validation)): ?>
                    <p><?= $validation ?></p>
                <?php endif; ?>
            </div>
            <label for="oldPW">Altes Passwort</label>
            <br>
            <input id="oldPW" name="oldPW" type="password">
            <br>
            <br>
            <label for="newPW">Neues Passwort</label>
            <br>
            <input id="newPW" name="newPW" type="password">
            <br>
            <br>
            <input id="button" class="boxRound type2" type="submit" value="Absenden"/>
        </p>
    </div>
</form>