<?php

class Signupform
{

  private $name = "Geen naam";
  private $email = "geen@email.nl";
  private $workshopI = "Geen workshop keuze";
  private $workshopII = "Geen workshop keuze";
  private $workshopIII = "Geen workshop keuze";
  private $organisatie = "Geen organisatie opgegeven";
  private $plaatsnaam = "Geen plaatsnaam opgegeven";

  private $error_message = "??";

// ---------------------------------------construct---------------------------------------
  public function __construct($value1, $value2, $value3, $value4, $value5, $value6, $value7)
  {
    $name_error = $this->setName($value1) == TRUE ? 'TRUE,' : 'FALSE,';
    $email_error = $this->setEmail($value2) == TRUE ? 'TRUE,' : 'FALSE,';
    $workshopI_error = $this->setWorkshopRondeI($value3) == TRUE ? 'TRUE,' : 'FALSE,';
    $workshopII_error = $this->setWorkshopRondeII($value4) == TRUE ? 'TRUE,' : 'FALSE,';
    $workshopIII_error = $this->setWorkshopRondeIII($value5) == TRUE ? 'TRUE,' : 'FALSE,';
    $organisatie_error = $this->setOrganisatie($value6) == TRUE ? 'TRUE,' : 'FALSE,';
    $plaatsnaam_error = $this->setPlaatsnaam($value7) == TRUE ? 'TRUE,' : 'FALSE,';

    $this->error_message = $name_error . $email_error . $workshopI_error . $workshopII_error . $workshopIII_error . $organisatie_error . $plaatsnaam_error;

  }
  //------------------------------------------toString---------------------------------------

  public function __toString()
  {
    return $this->error_message;
  }

  //------------------------------------------General Method----------------------------------
  private function validatePlaatsnaam($value)
  {
    $plaatsnamefile = simplexml_load_file("inc/xml/plaatsnamen.xml");
    $xmlText = $plaatsnamefile->asXML();

    if(stristr($xmlText, $value) === FALSE) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  // ---------------------------------------Set Methods---------------------------------------

  private function setName($value)
  {
    $error_message = TRUE;
    (ctype_alpha(str_replace(' ','',$value)) && strlen($value) <= 30) ? $this->name = $value : $error_message = FALSE;
    return $error_message;
  }

  private function setEmail($value)
  {
    $error_message = TRUE;
    $value = strtolower($value);
    (filter_var($value, FILTER_VALIDATE_EMAIL) && strlen($value) <= 40) ? $this->email = $value : $error_message = FALSE;
    return $error_message;
  }

  private function setWorkshopRondeI($value)
  {
    $error_message = TRUE;
    ($value == 'Ecologiseren' || $value == 'Nieuwbouw' || $value == 'Klussen' || $value == 'zonne_energie') ? $this->workshopI = $value : $error_message = FALSE;
    return $error_message;
  }

  private function setWorkshopRondeII($value)
  {
    $error_message = TRUE;
    ($value == 'Woningcorporaties' || $value == 'Cooplink' || $value == 'Financieren_woongemeenschap' || $value == 'Centraalwonen') ? $this->workshopII = $value : $error_message = FALSE;
    return $error_message;
  }

  private function setWorkshopRondeIII($value)
  {
    $error_message = TRUE;
    ($value == 'Besluitvorming' || $value == 'Betrokkenheid' || $value == 'Diversiteit' || $value == 'ind_vs_groep') ? $this->workshopIII = $value : $error_message = FALSE;
    return $error_message;
  }

  private function setOrganisatie($value)
  {
    $error_message = TRUE;
    (ctype_alpha(str_replace(' ','',$value)) && strlen($value) <= 30) ? $this->organisatie = $value : $error_message = FALSE;
    return $error_message;
  }

  private function setPlaatsnaam($value)
  {
    $error_message = TRUE;
    (ctype_alpha(str_replace(' ','',$value)) && ($this->validatePlaatsnaam($value) === TRUE) && strlen($value) <= 35) ? $this->plaatsnaam = $value : $error_message = FALSE;
    return $error_message;
  }

  // ---------------------------------------Get Methods---------------------------------------


  public function getFormInput()
  {
    return "$this->name, $this->email, $this->workshopI, $this->workshopII, $this->workshopIII, $this->organisatie, $this->plaatsnaam";
  }
}

 ?>
