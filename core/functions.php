<?php
// maakt input schoon van potentieel gevaarlijke karakters
function cleanInput($value)
{
  $bad_chars = array('{', '}', '(', ')', ';', ':', '<', '>', '/', '$');
  $value = str_ireplace($bad_chars, "", $value);
  $value = strip_tags($value);
  $value = htmlspecialchars($value);

  if (get_magic_quotes_gpc()) {
    $value = stripslashes($value);
  }
  return $value;
}

function readableText($value)
{
  $value = nl2br($value);
  $value = str_ireplace(",", "", $value);
  return $value;
}

function checkIfNumber($index)
{
  if (ctype_digit($index)) {
    return $index;
  } else {
    return FALSE;
  }
}
?>
