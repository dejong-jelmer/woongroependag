function allAlpabetic(value)
{
  var letters = /^[a-zA-z ]+$/;
  if (value.match(letters)) {
    return true;
  } else {
    return false;
  }
}

function isEmail(emailAdres) {
  var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (emailAdres.match(mailFormat)) {
      return true;
    } else {
      return false;
    }
}

function validateNaam(the_string)
{
  if (the_string.length > 0) {
    if ((allAlpabetic(the_string)) && (the_string.length <= 30)) {
       return true;
     } else {
       return false;
     }
   } else {return true;}
}

function validateEmail(the_string)
{
  if (the_string.length > 0) {
    if ((isEmail(the_string)) && (the_string.length <= 40)) {
      return true;
    } else {
      return false;
    }
  } else {return true;}
}

function isChecked()
{
  if(document.getElementById('checkbox').checked) {
    return true;
  } else {
    return false;
  }
}

function validateInput(form)
{
  var error_message = "";
  if (!validateNaam(form.naam.value)) {
    error_message += "Ongeldige naam. Voer alleen letters in (max. 30). ";
  }
  if (!validateEmail(form.email.value)) {
    error_message += "Ongeldige emailadres. Voer een geldig adres in (max. 40). ";
  }
  if (!isChecked()) {
    error_message += "Geef je nog even aan of je ook komt? Zet een vinkje onderaan. ";
  }


  if (error_message.length > 0) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
