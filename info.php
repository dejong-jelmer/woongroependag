<!DOCTYPE html>
<html>
<head>
    <title>Info | Woongroependag </title>
  <?php include 'inc/head.php';?>
  <!-- script voor googlemaps weergave op de site-->
  <script src="http://maps.googleapis.com/maps/api/js"></script>
  <script>google.maps.event.addDomListener(window, 'load', initialize);</script>
</head>

<body>


  <header>
      <?php include 'inc/menu.php';?>
  </header>

  <div class="section">
    <div class="text shadow" >
      <p id="route">
        <h1>Locatie:</h1>
        de Kleine Wiel<br />
        Karl Marxstraat 101<br />
        6663 LA LENT<br />
        <br />
      </p>
      <div id="googleMap" style="width:750px;height:250px;"></div>
      <p>
        Vanwege het beperkt aantal parkeerplaatsen en het ecologische karakter van ons project vragen wij bezoekers zoveel mogelijk met het openbaar vervoer te komen.
        Komt u toch met de auto: gelieve te parkeren bij het station, zodat de weinige parkeerplaatsen die we hebben beschikbaar blijven voor mensen die slecht ter been zijn.
      </p>
      <br />
      <h1 id="bus">Route:</h1>
      <p>
        <b>Vanaf station Nijmegen - via station Nijmegen - Lent:</b><br />
        Bus 13 - Lent Thermion<br />
        Bus 15 - Lent Thermion<br />
        Bus 33 - Arnhem CS<br />
        Uitstappen <b>Bushalte Turennesingel.</b><br/>
      </p>
      <img class="img" src="img/bus_looproute.png" alt="looproute vanaf Turennesingel" />
      <p>
        <b>Vanaf Utrecht:</b><br />
        Trein richting Nijmegen - overstappen in Arnhem op:<br />
        Sprinter - Nijmegen / Intercity - Den Bosch<br />
      <br />
        <b>Vanaf Zwolle:</b><br />
        Intercity - Den Bosch<br />
      <br />
        <b>Vanaf Den Bosch:</b><br />
        Intercity - Zwolle<br />
      </p>
      <p>Uitstappen <b>Nijmegen - Lent.</b><br/></p>
      <p>Verder lopen of met <a href="info.php#bus">bus</a></p>
      <img class="img" src="img/station_looproute.png" alt="looproute vanaf het station" />
    </div>

    <aside class="aside shadow">
      <?php include 'inc/fb_twitter.php'; ?>
    </aside>
  </div>


  <footer>
    <?php include 'inc/footer.php';?>
  </footer>


</body>
</html>
