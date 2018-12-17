<div id="image">
    <img src="/images/c.jpg" alt="Bild, das eine schöne Landschaft zeigt">
</div>
<div id="body">
    <h1><?= $title ?></h1>
    <div id="searchresults">
        <?php if (!empty($result)): ?>
            <?php foreach ($result as $row): ?>
                <a href="/entry/show/<?=$row["id"]; ?>" class="boxRound buttonSearch" ><?= $row["titel"]; ?></a>
            <?php endforeach ?>
        <?php else:?>
            <p>Nicht vorhanden</p>
        <?php endif ?>
    </div>
    <a href="/experience/experience" class="buttonRight boxRound">Zurück zu Entdecken</a>
</div>

