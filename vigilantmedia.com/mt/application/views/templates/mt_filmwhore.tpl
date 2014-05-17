<p>
<strong>Artist administration</strong><br>
<a href="/index.php/filmwhore/film/options/">Add a new film</a><br>
Edit a film:<br></p>

<p>
<span style="font-size: 80%">
Filter:
{foreach item=rsNav from=$rsNav}
<a href="/index.php/mt/filmwhore/{$rsNav->nav|lower}/">{$rsNav->nav}</a>
{/foreach}
</span>
</p>

<ul>
{foreach item=rsFilm from=$rsFilms}
<li> <a href="/index.php/filmwhore/film/info/{$rsFilm->film_id}/">{format_film_title_object obj=$rsFilm}</a></li>
{/foreach}
</ul>

