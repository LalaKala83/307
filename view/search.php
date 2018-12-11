<div id="image">
    <img src="/images/c.jpg" width="100%">
</div>
<div id="body">
    <h1><?= $title ?></h1>
<form class="form-horizontal" action="/entry/find" method="post">
    <div data-html="true" id="login">
        <input class="searchbox" type="search" id="username" placeholder="Benutzername eingeben"/>
        <input id="button" type="submit" value="Suchen"/>
    </div>
    <div id="searchresults">

    </div>
</form>
</div>
