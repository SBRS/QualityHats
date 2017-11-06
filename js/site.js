function onClickSubmit()
{
  var validEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (document.getElementsByName("FirstName")[0].value.length < 1) {
    document.getElementById("errorFirstName").innerHTML = "First Name must be at least 1 letter";
  }
  else {
    document.getElementById("errorFirstName").innerHTML = "";
  }
  if (document.getElementsByName("LastName")[0].value.length < 1) {
    document.getElementById("errorLastName").innerHTML = "Last Name must be at least 1 letter";
  }
  else {
    document.getElementById("errorLastName").innerHTML = "";
  }
  if (validEmail.test(document.getElementsByName("Email")[0].value)) {
    document.getElementById("errorEmail").innerHTML = "";
  }
  else {
    document.getElementById("errorEmail").innerHTML = "Please enter valid Email";
  }
  if (document.getElementsByName("Password")[0].value.length < 3) {
    document.getElementById("errorPassword").innerHTML = "Password must be at least 3 letters";
  }
  else {
    document.getElementById("errorPassword").innerHTML = "";
  }
  if (document.getElementsByName("Password")[0].value != document.getElementsByName("ConfirmPassword")[0].value) {
    document.getElementById("errorConfirmPassword").innerHTML = "The password and confirmation password do not match";
  }
  else {
    document.getElementById("errorConfirmPassword").innerHTML = "";
  }
  if (document.getElementsByName("Address")[0].value.length < 5) {
    document.getElementById("errorAddress").innerHTML = "Address must be at least 5 letters";
  }
  else {
    document.getElementById("errorAddress").innerHTML = "";
  }
  if (document.getElementsByName("MobileNumber")[0].value.length < 9) {
    document.getElementById("errorMobile").innerHTML = "Mobile number must be at least 9 letters";
  }
  else {
    document.getElementById("errorMobile").innerHTML = "";
  }
  if (document.getElementById("errorFirstName").innerHTML != "" || document.getElementById("errorLastName").innerHTML != "" ||
      document.getElementById("errorEmail").innerHTML != "" || document.getElementById("errorPassword").innerHTML != "" || document.getElementById("errorConfirmPassword").innerHTML != "" || document.getElementById("errorAddress").innerHTML != "" || document.getElementById("errorMobile").innerHTML != "") {
    return false;
  }
}

function onHatCreate()
{
  if (document.getElementsByName("hat_name")[0].value.length < 1) {
    document.getElementById("errorHatName").innerHTML = "Hat name must be at least 1 letter";
  }
  else {
    document.getElementById("errorHatName").innerHTML = "";
  }
  if (document.getElementsByName("hat_description")[0].value.length < 1) {
    document.getElementById("errorHatDescription").innerHTML = "Hat description must be at least 1 letter";
  }
  else {
    document.getElementById("errorHatDescription").innerHTML = "";
  }
  if (document.getElementsByName("hat_price")[0].value <= 0 || document.getElementsByName("hat_price")[0].value == '') {
    document.getElementById("errorHatPrice").innerHTML = "Price must be not empty and greater than zero";
  }
  else {
    document.getElementById("errorHatPrice").innerHTML = "";
  }
  if (document.getElementById("errorHatName").innerHTML != "" || document.getElementById("errorHatDescription").innerHTML != "" ||
      document.getElementById("errorHatPrice").innerHTML != "") {
    return false;
  }
}