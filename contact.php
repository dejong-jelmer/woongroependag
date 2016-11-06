<?php
$error_naam = $error_email = "";

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {

  $domain = $_SERVER['HTTP_HOST'];
  $uri = parse_url($_SERVER['HTTP_REFERER']);
  $r_domain = $uri['host'];

  if ($domain == $r_domain) {

    require_once('core/contactform.php');
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
        $naam = cleanInput($_POST['naam']);
        $email = cleanInput($_POST['email']);
        $onderwerp = cleanInput($_POST['onderwerp']);
        $bericht = readableText(cleanInput($_POST['bericht']));

        $contact = new Contactform($naam, $email, $onderwerp, $bericht);

        // geeft TRUE / FALSE na verficatie --- default uitgeschakkeld (enkel voor testen)
        list($naam_error, $email_error, $subject_error, $message_error) = explode(',', $contact);

        // print of update gelukt is of niet --- default uitgeschakkeld (enkel voor testen)
        /*print $naam_error == 'TRUE' ? 'Name update <b>gelukt</b><br />' : 'Name update <b>mislukt</b><br />';
        print $email_error == 'TRUE' ? 'Email update <b>gelukt</b><br />' : 'Email update <b>mislukt</b><br />';
        print $subject_error == 'TRUE' ? 'Onderwerp update <b>gelukt</b><br />' : 'Onderwerp update <b>mislukt</b><br />';
        print $message_error == 'TRUE' ? 'Bericht update <b>gelukt</b><br />' : 'Bericht update <b>mislukt</b><br />';*/

        $form_input = $contact->getFormInput();

        list($name, $from, $subject, $message) = explode(',', $form_input);

        // test $message voor mail --- default uitgeschakkeld (enkel voor testen)
        /*print "$name <br />";
        print "$from <br />";
        print "$subject <br />";
        print "$message <br />";*/

        // openend mailer.php voor het opstellen van de mail.  --- default ingeschakkeld (enkel voor testen uitschakkelen)
        include 'inc/mailer.php';

    }
  }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Contact | Woongroependag</title>
  <?php include 'inc/head.php';?>
  <script type="text/javascript" src="js/validator.js"></script>
</head>

<body>


  <header>
      <?php include 'inc/menu.php';?>
  </header>

  <div class="section">
    <div class="text shadow" >
      <p class="error"><?php if (!empty($errors)) {echo implode('</p><p class="error">', $errors);} ?></p>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onSubmit="return validateInput(this)">
        <p>Naam:<span class="error">*</span></p><input class="name" name="naam" type="text" pattern="[A-Za-z ]*" title="Voer een geldige naam in. Niet langer dan 30 karakters, gebruik alleen letters." maxlength="30" autocomplete="off" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {echo cleanInput($_POST['naam']);} ?>"><span class="error"></span>
        <p>Je e-mailadres:<span class="error">*</span></p><input class="email" name="email" type="email" size="40" title="Voer een geldig emailadress in." autocomplete="off" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {echo cleanInput($_POST['email']);} ?>"><span class="error"></span>

        <p>Onderwerp:</p><input class="name" name="onderwerp" type="text" pattern="[A-Za-z0-9 ]*" title="Voer een geldig onderwerp in. Niet langer dan 30 karakters, gebruik alleen letters en cijfers." autocomplete="off">
        <p>Bericht: </p>
        <textarea name="bericht" rows="8" cols="100" maxlength="600"></textarea>
        <small>Velden met een * zijn benodigd voor het versturen van het formulier.</small><br />
        <input type="submit" class="button" value="versturen">
        <input id="checkbox" type="checkbox" class="hidden" value="checked" checked="yes">
      </form>
      <br /><br /><br />

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
