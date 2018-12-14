<div id="image">
    <img src="/images/d.jpg" width="100%">
</div>
<div id="body">
    <h1><?= $title ?></h1>
    <div id="containerProfilepicture">
        <button class="buttonsExperience">
            <p class="textProfilepicture" id="p">Profilbild hinzufügen</p>
        </button>
    </div>
    <div id="usernameAndPassword">
        <h2><?= $username?></h2>
        <button class="buttonChangePassword">Passwort ändern</button>
    </div>
    <div id="createNewBlog">
        <a href="/profileBlog/createBlog" class="buttonChangePassword">Neuen Beitrag erfassen</a>
    </div>
    <div id="blogbox">
        <?php if (empty($blogs)): ?>
            <div class="dhd">
                <h2 class="item title">Hoopla! Kein Blog gefunden.</h2>
            </div>
        <?php else: ?>
            <?php foreach ($blogs as $blog):  ?>
                <div class="panel-default">
                    <div class="panel-heading"><?= $blog["titel"]; ?></div>
                    <div class="panel-body">
                        <p class="tag">Kategorie: <?= $blog["kontinent"]; ?></p>
                        <p class="text"><?= $blog["inhalt"]; ?></p>
                    </div>
                    <a href="/profile/deleteBlog?id=<?= $blog["id"]; ?>">
                        <p>Beitrag löschen</p>
                    </a>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>