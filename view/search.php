<div id="image">
    <img src="/images/c.jpg" alt="Bild, das eine schöne Landschaft zeigt">
</div>
<div id="body">
    <h1><?= $title ?></h1>
<form class="form-horizontal" action="/entry/find" method="post">
    <div data-html="true" id="login">
        <input id="title" name="title" class="searchbox" type="search" placeholder="Zielort eingeben"/>
        <input id="button" class="boxRound buttonDefault" type="submit" value="Suchen"/>
    </div>
</form>
</div>
