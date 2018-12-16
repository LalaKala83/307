<div id="image">
    <img src="/images/d.jpg" width="100%">
</div>
<div id="body">
    <h1><?= $title ?></h1>
    <form action="<?= $action ?>" method="post">
        <div>
            <label for="title" class="form">Titel</label>
            <br>
                <input id="formInputFields" value="<?= $blogTitle ?>" class="form" name="title" type="text">
            <br>
            <br>
            <label for="tags" class="form">Tags</label>
            <br>
                <select id="formInputFields" name="tags" class="form">
                    <option value="Andere" <?=$selectedTag == 'Andere'?' selected="selected"' : '';?>'>Andere</option>
                    <option value="Nordamerika" <?=$selectedTag == 'Nordamerika'?' selected="selected"' : '';?>'>Nordamerika</option>
                    <option value="Südamerika" <?=$selectedTag == 'Südamerika'?' selected="selected"' : '';?>'>Südamerika</option>
                    <option value="Afrika" <?=$selectedTag == 'Afrika'?' selected="selected"' : '';?>'>Afrika</option>
                    <option value="Europa" <?=$selectedTag == 'Europa'?' selected="selected"' : '';?>'>Europa</option>
                    <option value="Asien" <?=$selectedTag == 'Asien'?' selected="selected"' : '';?>'>Asien</option>
                    <option value="Australien" <?=$selectedTag == 'Australien'?' selected="selected"' : '';?>'>Australien</option>
                    <option value="Antarktis" <?=$selectedTag == 'Antarktis'?' selected="selected"' : '';?>'>Antarktis</option>
                    <option value="Ozeanien" <?=$selectedTag == 'Ozeanien'?' selected="selected"' : '';?>'>Ozeanien</option>
                </select>
                <br>
                <br>
                <label for="image" class="form">Bild</label>
                <br>
                <input type="file" class="uploadFileContainer" name="fileToUpload" id="fileToUpload">
                <br>
                <br>
                <label for="blog" class="form">Text</label>
            <br>
                <textarea name="blog" class="form" id="textarea"><?= $blogContent ?></textarea>
            <br>
            <input type="hidden" name="id" value="<?=$blogID?>">
            <a href="/profile/profile" class="buttonDefault">Abbrechen</a>
            <input class="buttonDefault" type="submit" value="<?= $buttonValue ?>"/>
            </p>
        </div>
    </form>
    </div>
</div>