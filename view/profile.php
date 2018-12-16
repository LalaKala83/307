<div id="image">
    <img src="/images/d.jpg" width="100%">
</div>
<div id="body">
    <h1><?= $title ?></h1>
    <div id="containerProfilepicture">
        <button class="buttonsExperience boxRound">
            <p class="textProfilepicture" id="p">Profilbild hinzufügen</p>
        </button>
    </div>
    <div id="usernameAndPassword">
        <h2><?= $username?></h2>
        <a href="/user/change" class="button boxRound">Passwort ändern</a>
    </div>
    <div id="createNewBlog">
        <a href="/profileBlog/createBlog" class="button boxRound">Neuen Beitrag erfassen</a>
    </div>
    <div id="blogbox">
        <?php if (empty($blogs)): ?>
            <div class="dhd">
                <h2>Hoppla! Kein Blog gefunden.</h2>
            </div>
        <?php else: ?>
            <?php foreach ($blogs as $blog):  ?>
                <div class="panel-default">
                    <h2><?= $blog["titel"]; ?></h2>
                    <div class="panel-body">
                        <p class="tag">Kategorie: <?= $blog["kontinent"]; ?></p>
                        <p class="text"><?= $blog["inhalt"]; ?></p>
                    </div>
                    <a class="button boxRound" href="/updateBlog/updateBlog?id=<?= $blog["id"]; ?>">
                        Beitrag bearbeiten
                    </a>
                    <a class="button boxRound" href="/profile/deleteBlog?id=<?= $blog["id"]; ?>">
                        Beitrag löschen
                    </a>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>