<?php
$error_naam = $error_email = "";

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
  $domain = $_SERVER['HTTP_HOST'];
  $uri = parse_url($_SERVER['HTTP_REFERER']);
  $r_domain = $uri['host'];

  if ($domain == $r_domain) {

    require_once('core/signupform.php');
    require_once('core/functions.php');

    $fields = [
      'naam' => $_POST['naam'],
      'email'=> $_POST['email']
    ];
    foreach ($fields as $field => $value)  {
      if (empty($value)) {
        $errors[] = "Je bent vergeten je $field in te vullen.";
      }
    }
      if (empty($errors)) {

        $index = cleanInput(checkIfNumber($_POST['index']));

        for ($i=0; $i <= $index; $i++) {
          $name[$i] = $e_mail[$i] = $workshopI[$i] = $workshopII[$i] = $workshopIII[$i] = $organisatie = $plaatsnaam = "";

          // (loop) maakt $i leeg om POST van eerste vled te lezen
          if ($i==0) {$i='';}
            $name[$i] = cleanInput($_POST['naam'.$i]);
            $e_mail[$i] = cleanInput($_POST['email'.$i]);
            $workshopI[$i] = cleanInput($_POST['1ste_workshop'.$i]);
            $workshopII[$i] = cleanInput($_POST['2e_workshop'.$i]);
            $workshopIII[$i] = cleanInput($_POST['3e_workshop'.$i]);
            $organisatie = cleanInput($_POST['namens_organisatie']);
            $plaatsnaam = cleanInput($_POST['plaatsnaam']);

            // object verifeerd userinput via 'signupform class methods'
            $aanmelding[$i] = new Signupform($name[$i], $e_mail[$i], $workshopI[$i], $workshopII[$i], $workshopIII[$i], $organisatie, $plaatsnaam);

            // geeft TRUE / FALSE na verficatie --- default uitgeschakkeld (enkel voor testen)
            /*list($naam_error, $email_error, $I_workshop_error, $II_workshop_error, $III_workshop_error, $organisatie_error, $plaatsnaam_error) = explode(',', $aanmelding[$i]);*/

            // print of update gelukt is of niet --- default uitgeschakkeld (enkel voor testen)
            /*print $naam_error == 'TRUE' ? 'Name update <b>gelukt</b><br />' : 'Name update <b>mislukt</b><br />';
            print $email_error == 'TRUE' ? 'Email update <b>gelukt</b><br />' : 'Email update <b>mislukt</b><br />';
            print $I_workshop_error == 'TRUE' ? 'Workshop ronde I update <b>gelukt</b><br />' : 'Workshop ronde I update <b>mislukt</b><br />';
            print $II_workshop_error == 'TRUE' ? 'Workshop ronde II update <b>gelukt</b><br />' : 'Workshop ronde II update <b>mislukt</b><br />';
            print $III_workshop_error == 'TRUE' ? 'Workshop ronde III update <b>gelukt</b><br />' : 'Workshop ronde III update <b>mislukt</b><br />';
            print $organisatie_error == 'TRUE' ? 'Organisatie update <b>gelukt</b><br />' : 'Organisatie update <b>mislukt</b><br />';
            print $plaatsnaam_error == 'TRUE' ? 'Plaatsnaam update <b>gelukt</b><br />' : 'Plaatsnaam update <b>mislukt</b><br />';*/

            // haalt aangepaste waarde uit signupform method
            $form_input = $aanmelding[$i]->getFormInput();

            // variabelen krijgen waarde voor de mailer
            list($naam, $email, $I_workshop, $II_workshop, $III_workshop, $organisatie, $plaatsnaam) = explode(',', $form_input);

            // array met de email adressen voor de afzender van de mail.
            $from[] = $email;
            $afzender[] = $naam;
            // (loop) geeft $i weer waarde om array uit te lezen
            if (empty($i)) {$i=0;}
            $AanmeldingsNr = $i+1;

            $message[] = '<b>Persoon '.$AanmeldingsNr.':</b>';
            $message[] = '<ul>';
            $message[] .= '<li> Naam: <b>'.$naam.'</b></li>';
            $message[] .= '<li> Email: <b>'.$email.'</b></li>';
            $message[] .= '<li> Voor de <b>eerste ronde</b> doe ik graag mee aan workshop: <b>"'.$I_workshop.'"</b>.</li>';
            $message[] .= '<li> Voor de <b>tweede ronde</b> doe ik graag mee aan workshop: <b>"'.$II_workshop.'"</b>.</li>';
            $message[] .= '<li> Voor de <b>derde ronde</b> doe ik graag mee aan workshop: <b>"'.$III_workshop.'"</b>.</li>';
            $message[] .= '<li> Ik/Wij kom(en) namens de woongroep / organisatie: <b>"'.$organisatie.'"</b>.</li>';
            $message[] .= '<li> Ik/Wij kom(en) uit: <b>"'.$plaatsnaam.'"</b>.</li>';
            $message[] .= '</ul>';
            $message[] .= '<br />';
          }

          // afzender info voor mail

          $from = $from[0];
          $name = $afzender[0];

          $message = implode('', $message);

          $subject = 'Aanmelding woongroependag';

          // test $message voor mail --- default uitgeschakkeld (enkel voor testen)
          /*print "$message <br />";
          print "$from <br />";
          print "$name <br />";*/

          // openend mailer.php voor het opstellen van de mail.  --- default ingeschakkeld (enkel voor testen uitschakkelen)
          include 'inc/mailer.php';

        }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Opgeven | Woongroependag </title>
    <?php include 'inc/head.php'; ?>
    <script type="text/javascript" src="js/validator.js"></script>
    <script type="text/javascript" src="js/get_plaatsnaam_ajax.js"></script>
  </head>

<body>

  <header>
      <?php include 'inc/menu.php'; ?>
  </header>

  <div class="section">
    <div class="text shadow">
		
        <h1>Opgeven</h1>
  			<p>Woongroependag was op 17 september 2016, uw kunt zich niet meer opgeven.</p>
  		</div>
<!-- 
          <p>Om de onkosten van de dag, dankjes en de lunch te kunnen dekken, vragen wij iedere bezoeker om een bijdrage van €10,-. Dit bedrag kan bij ons aan de deur (alleen contant) betaald worden.</p>
          <p>Omdat we graag een overzicht hebben van de drukte bij de verschillende workshops vragen we van te voren aan te geven welke workshop je het liefst wilt volgen.
            Ook zou het leuk zijn als aan kan geven of je namens een woongroep of organisatie komt, en zo ja welke.</p><br />
          <a class="link" href="programma.php">Klikt hier voor een volledig overzicht van het programma.</a>
            <br /><br />
          <form action="<?php //echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onSubmit="return validateInput(this)">
            <input id="index" type="hidden" name="index" value="">
            <input id="extraPerson" class="button" type="button" value="extra persoon toevoegen">
            <input id="removeButton" class="button hidden" type="button" value="verwijderen">
            <p><input id="organisatie" type="checkbox" name="organisatie" autocomplete="off" value="" onclick="AjaxRequest()"><span id="confirmTextI">Ik kom</span> namens een woongroep of organisatie.</p><br />
            <p class="error"><?php //if (!empty($errors)) {echo implode('</p><p class="error">', $errors);} ?></p>
              <div id="organisatieVelden" class="signinField hidden">
                <p>Naam van uw woongroep of organisatie:<p><input class="name" type="text" name="namens_organisatie">
                <p>Plaats van uw woongroep of organisatie:<p> <div id="AjaxResponse"></div>
              </div>
              <div class="signinField" id="signinField">
                <?php //include 'inc/signinField.php'; ?>
              </div>

            <div class="hidden" id="multiSigninField"></div>
            <small>Velden met een * zijn benodigd voor het versturen van het formulier.</small><br />
            <p><input id="checkbox" type="checkbox">Ja, <span id="confirmTextII">ik kom</span> naar de woongroependag bij Iewan.</p><br />
            <input id="submit" class="button" type="submit" value="opgeven">
          </form>
            <a class="link" href="info.php#route">Klik hier voor de route beschrijving.</a>
          </div>
 -->
    <aside class="aside shadow">
      <?php include 'inc/fb_twitter.php'; ?>
    </aside>
  </div>

  <footer>
    <?php include 'inc/footer.php';?>
  </footer>

</body>
</html>
