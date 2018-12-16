<div id="image">
    <img src="/images/c.jpg" width="100%">
</div>
<div id="body">
    <h1><?= $title ?></h1>
<form class="form-horizontal" action="/entry/find" method="post">
    <div data-html="true" id="login">
        <input id="title" name="title" class="searchbox" type="search" placeholder="Zielort eingeben"/>
        <input id="button" class="boxRound button" type="submit" value="Suchen"/>
    </div>
</form>
</div>
