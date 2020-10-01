
<?php

function HTMLHeader() {
echo<<< HTML
<header>
  <div id="panel_header">
    <a href="index.php"><img src="img/titulo_pagina.png" alt="imagen_titulo_base"></a>
  </div>
</header>
HTML;
}

function HTMLnavegador() {
echo<<< HTML
<nav id="navegador_inicio">
    <ul>
        <li class="green"><a href="index.php" class="icon-home"><img src="https://s4.eestatic.com/2016/09/22/cultura/arte/Museos-Barack_Obama-Estados_Unidos-America-Michael_Jackson-Arte_157497107_17097213_854x640.jpg" alt="imagen_titulo_base"></a><h2>Inicio</h2></li>
        <li class="red"><a href="biografia.php" class="icon-home"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRbZNZWSXNExNxPT2bji7X9oJ_WV5mBvVm9WYYasAl59fDs6QyWg" alt="imagen_titulo_base"></a><h2>Biografía</h2></li>
        <li class="blue"><a href="discografia.php" class="icon-home"><img src="http://hdwallpaperbackgrounds.net/wp-content/uploads/2015/11/Michael-Jackson-Black-and-White-HD-Wallpapers-For-Desktop.jpg" alt="imagen_titulo_base"></a><h2>Discografía</h2></li>
        <li class="purple"><a href="conciertos.php" class="icon-home"><img src="https://ep01.epimg.net/elpais/imagenes/2017/08/25/icon/1503651867_852345_1503934348_noticia_normal.jpg" alt="imagen_titulo_base"></a><h2>Conciertos</h2></li>
        <li class="yellow"><a href="tienda.php" class="icon-home"><img src="https://i2-prod.mirror.co.uk/incoming/article9033745.ece/ALTERNATES/s615/Michael-Jackson.jpg" alt="imagen_titulo_base"></a><h2>Tienda</h2></li>
    </ul>
</nav>
HTML;
}

function HTMLfooter() {
echo<<< HTML
<footer>
  <p>© 2018 MJJ Music. Powered by Sony Music Entertainment. All Rights Reserved. Christian Andrades Molina</p>
  <ul>
     <li><a href="#" title=""><img src="https://image.flaticon.com/icons/svg/8/8730.svg"><span><i aria-hidden="true" class="icon-facebook">
     </i></span></a></li>
     <li><a href="#" title=""><img src="https://image.flaticon.com/icons/svg/9/9148.svg"><span><i aria-hidden="true" class="icon-google-plus">
     </i></span></a> </li>
     <li><a href="#" title=""><img src="https://image.flaticon.com/icons/svg/48/48898.svg"><span><i aria-hidden="true" class="icon-twitter">
     </i></span></a> </li>
  </ul>
</footer>
HTML;
}

function HTMLnav() {
echo<<< HTML
<nav id="enlaces_rapidos">
  <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="biografia.php">Biografía</a></li>
      <li><a href="discografia.php">Discografía</a></li>
      <li><a href="conciertos.php">Conciertos</a></li>
      <li><a href="tienda.php">Tienda</a></li>
  </ul>
</nav>
HTML;
}

?>
