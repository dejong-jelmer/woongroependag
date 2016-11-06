<?php
class Contactform
{

  private $name = "Geen naam";
  private $email = "geen@email.nl";
  private $subject ="Geen onderwerp";
  private $message = "Geen bericht";
  private $error_message = "??";

// ---------------------------------------construct---------------------------------------
  public function __construct($value1, $value2, $value3, $value4)
  {
    $name_error = $this->setName($value1) == TRUE ? 'TRUE,' : 'FALSE,';
    $email_error = $this->setEmail($value2) == TRUE ? 'TRUE,' : 'FALSE,';
    $subject_error = $this->setSubject($value3) == TRUE ? 'TRUE,' : 'FALSE,';
    $message_error = $this->setMessage($value4) == TRUE ? 'TRUE,' : 'FALSE,';

    $this->error_message = $name_error . $email_error . $subject_error . $message_error;

  }

  public function __toString()
  {
    return $this->error_message;
  }

  // ---------------------------------------Set Methods---------------------------------------

  function setName($value)
  {
    $error_message = TRUE;
    (ctype_alpha(str_replace(' ','',$value)) && strlen($value) <= 30) ? $this->name = $value : $error_message = FALSE;
    return $error_message;
  }

  function setEmail($value)
  {
    $error_message = TRUE;
    $value = strtolower($value);
    (filter_var($value, FILTER_VALIDATE_EMAIL) && strlen($value) <= 40) ? $this->email = $value : $error_message = FALSE;
    return $error_message;
  }

  function setSubject($value)
  {
    $error_message = TRUE;
    (ctype_alnum(str_replace(' ','',$value)) && strlen($value) <= 30) ? $this->subject = $value : $error_message = FALSE;
    return $error_message;
  }

  function setMessage($value)
  {
    $error_message = TRUE;
    strlen($value) <= 600 ? $this->message = $value : $error_message = FALSE;
    return $error_message;
  }

  // ---------------------------------------Get Methods---------------------------------------

  function getFormInput()
  {
    return "$this->name, $this->email, $this->subject, $this->message";
  }

}



















 ?>
