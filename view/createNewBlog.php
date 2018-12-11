<div id="image">
    <img src="/images/d.jpg" width="100%">
</div>
<div id="body">
    <h1><?= $title ?></h1>
    <form action="createTheBlog" method="post">
        <div>
            <p>
            <label for="title" class="form">Titel</label>
            <br>
            <input id="formInputFields" class="form" name="username" type="text">
            <br>
            <br>
            <label for="tags" class="form">Tags</label>
            <br>
                <select id="formInputFields" name="tags" class="form">
                    <option value="Andere">Andere</option>
                    <option value="Nordamerika">Nordamerika</option>
                    <option value="Südamerika">Südamerika</option>
                    <option value="Südamerika">Afrika</option>
                    <option value="Südamerika">Europa</option>
                    <option value="Südamerika">Asien</option>
                    <option value="Südamerika">Australien</option>
                    <option value="Südamerika">Antarktis</option>
                    <option value="Südamerika">Ozeanien</option>
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
            <input id="buttonCreateBlog" type="submit" value="Beitrag erfassen"/>
            </p>
        </div>
    </form>
    </div>
</div>