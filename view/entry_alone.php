<div id="image">
    <img src="/images/c.jpg" alt="Bild, das eine schöne Landschaft zeigt">
</div>
<div id="body">
    <h1><?= $blog["titel"]; ?></h1>
    <p class="kontinent"><?= $blog["kontinent"]; ?></p>
    <div id="searchresults">
        <?php if (!empty($blog)): ?>
            <div class="panel-body">
                <p class="text"><?= $blog["inhalt"]; ?></p>
            </div>
        <?php else: ?>
            <h1>Ein Fehler ist aufgetreten!</h1>
        <?php endif;?>
    </div>
</div>
