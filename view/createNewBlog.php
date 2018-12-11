<div id="image">
    <img src="/images/d.jpg" width="100%">
</div>
<div id="body">
    <h1><?= $title ?></h1>
    <form action="/profileBlog/createTheBlog" method="post">
        <div>
            <p>
            <label for="title" class="form">Titel</label>
            <br>
            <input id="formInputFields" class="form" name="title" type="text">
            <br>
            <br>
            <label for="tags" class="form">Tags</label>
            <br>
                <select id="formInputFields" name="tags" class="form">
                    <option value="Andere">Andere</option>
                    <option value="Nordamerika">Nordamerika</option>
                    <option value="Südamerika">Südamerika</option>
                    <option value="Afrika">Afrika</option>
                    <option value="Europa">Europa</option>
                    <option value="Asien">Asien</option>
                    <option value="Australien">Australien</option>
                    <option value="Antarktis">Antarktis</option>
                    <option value="Ozeanien">Ozeanien</option>
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
                <textarea name="blog" class="form" id="textarea"></textarea>
            <br>
            <a href="/profile/profile" id="buttonCancelBlog">Abbrechen</a>
            <input id="buttonCreateBlog" type="submit" value="Beitrag erfassen"/>
            </p>
        </div>
    </form>
    </div>
</div>