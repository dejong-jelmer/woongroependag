<?php
$plaatsnamefile = simplexml_load_file("xml/plaatsnamen.xml");
$xmlText = $plaatsnamefile->asXML();

print "<select id='plaatsnaam' class='name' name='plaatsnaam'>";
print "<option>Selecteer woonplaats</option>";
  foreach ($plaatsnamefile->children() as  $name => $value) {
    print "<option value='$value'>$value</option>";
  }
print "</select>";

 ?>
