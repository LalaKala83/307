<div id="image">
    <img src="/images/d.jpg" alt="Bild, das eine schöne Landschaft zeigt">
</div>
<div id="body">
    <h1><?= $title ?></h1>
    <form action="<?= $action ?>" method="post">
            <label for="title" class="form">Titel</label>
            <br>
                <input value="<?= $blogTitle ?>" class="form formInputFields" name="title" type="text" id="title">
            <br>
            <br>
            <label for="tags" class="form">Tags</label>
            <br>
                <select name="tags" class="form formInputFields" id="tags">
                    <option value="Andere" <?=$selectedTag == 'Andere'?' selected="selected"' : '';?>>Andere</option>
                    <option value="Nordamerika" <?=$selectedTag == 'Nordamerika'?' selected="selected"' : '';?>>Nordamerika</option>
                    <option value="Südamerika" <?=$selectedTag == 'Südamerika'?' selected="selected"' : '';?>>Südamerika</option>
                    <option value="Afrika" <?=$selectedTag == 'Afrika'?' selected="selected"' : '';?>>Afrika</option>
                    <option value="Europa" <?=$selectedTag == 'Europa'?' selected="selected"' : '';?>>Europa</option>
                    <option value="Asien" <?=$selectedTag == 'Asien'?' selected="selected"' : '';?>>Asien</option>
                    <option value="Australien" <?=$selectedTag == 'Australien'?' selected="selected"' : '';?>>Australien</option>
                    <option value="Antarktis" <?=$selectedTag == 'Antarktis'?' selected="selected"' : '';?>>Antarktis</option>
                    <option value="Ozeanien" <?=$selectedTag == 'Ozeanien'?' selected="selected"' : '';?>>Ozeanien</option>
                </select>
                <br>
                <br>
                <label for="fileToUpload" class="form">Bild</label>
                <br>
                <input type="file" class="uploadFileContainer" name="fileToUpload" id="fileToUpload">
                <br>
                <br>
                <label for="blog" class="form">Text</label>
                <br>
                <textarea name="blog" class="form" id="blog"><?= $blogContent ?></textarea>
                <div id="textred">
                    <?php if (!empty($validationMessage)):?>
                        <?= $validationMessage ?>
                     <?php endif; ?>
                </div>
            <br>
            <input type="hidden" name="id" value="<?=$blogID?>">
            <a href="/profile/profile" class="boxRound buttonDefault">Abbrechen</a>
            <input class="boxRound buttonDefault" type="submit" value="<?= $buttonValue ?>"/>
    </form>
</div>