<div id="commitView">
    <h1><?= $title ?></h1>
    <p>Wollen Sie den Beitrag wirklich löschen?</p>
    <form action="/profile/deleteTheBlog" method="post">
        <a href="/profile/profile" class="buttonDefault boxRound">Nein</a>
        <input type="hidden" name="id" value="<?=$blogID?>">
    <input type="submit" value="Ja" class="buttonDefault boxRound">
    </form>
</div>