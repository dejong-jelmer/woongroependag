<?php

?>
<p>Naam:<span class="error">*</span></p><input class="name" name="naam" type="text" pattern="[A-Za-z ]*" autocomplete="off" title="Voer een geldige naam in. Niet langer dan 30 karakters, gebruik alleen letters." maxlength="30" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {echo cleanInput($_POST['naam']);} ?>"><span class="error"></span>
<p>Je e-mailadres:<span class="error">*</span></p><input class="email" name="email" type="email" size="40" autocomplete="off" title="Voer een geldig emailadress in." value="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {echo cleanInput($_POST['email']);} ?>"><span class="error"></span>
<p>Mijn workshop voorkeuren:</p>
<p>Workshop ronde I: </p>
  <select class="select" name="1ste_workshop">
    <option value="" disabled="" selected="">Kies een workshop:</option>
    <option value="Ecologiseren">Ecologiseren van bestaande panden</option>
    <option value="Nieuwbouw">Nieuwbouw en ecologie</option>
    <option value="Klussen">Ecologisch klussen</option>
    <option value="zonne_energie">Samen (zonne)energie opwekken</option>

  </select>
  <p>Workshop ronde II: </p>
    <select class="select" name="2e_workshop">
      <option value="" disabled="" selected="">Kies een workshop:</option>
      <option value="Woningcorporaties">Vertrouwen kwijt in woningcorporaties, wat nu?</option>
      <option value="Cooplink">Je eigen wooncoöperatie! Dankzij Cooplink, het kennisnetwerk wooncoöperaties</option>
      <option value="Financieren_woongemeenschap">Hoe financier je je woongemeenschap</option>
      <option value="Centraalwonen">Centraal Wonen: nieuwe afspraken maken met je verhuurder?</option>

    </select>
    <p>Workshop ronde III: </p>
      <select class="select" name="3e_workshop">
        <option value="" disabled="" selected="">Kies een workshop:</option>
        <option value="Besluitvorming">Besluitvorming</option>
        <option value="Betrokkenheid">Hoe houd je elkaar betrokken</option>
        <option value="Diversiteit">Diversiteit woongroepen</option>
        <option value="ind_vs_groep">Individu vs woongemeenschap</option>
      </select>
