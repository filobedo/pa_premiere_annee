function check(){
  const gender = document.register.gender;
  const firstname = document.register.firstname;
  const lastname = document.register.lastname;
  const birthday = document.register.birthday;
  const email = document.register.email;
  const confirm_email = document.register.confirm_email;
  const password = document.register.password;
  const confirm_password = document.register.confirm_password;
  const address_num = document.register.address_num;
  const address = document.register.address;
  const town = document.register.town;
  const num_tel = document.register.num_tel;
  const verif_captcha = document.register.verif_captcha;
  var count = 0;

  console.log(gender[0].parentNode);

  if(checkGender(gender.value)){
    console.log("Gender DONE !");
    count++
  }
  else{
    alert('Veuillez sélectionner votre sexe');
  }

  if(checkFirstname(firstname.value)){
  console.log("Name DONE !");
  document.register.firstname.style.border = '1px solid #ced4da';
  count++;
  }
  else{
    displayErrorOnInput(firstname);
  }

  if(checkLastname(lastname.value)){
    console.log("lastname DONE !");
    document.register.lastname.style.border = '1px solid #ced4da';
    count++;
  }
  else{
    displayErrorOnInput(lastname);
  }

  if(checkBirthday(birthday.value)){
    console.log("birthday DONE !");
    document.register.birthday.style.border = '1px solid #ced4da';
    count++;
  }
  else{
    displayErrorOnInput(birthday);
  }

  if(checkEmail(email.value,confirm_email.value)){
    console.log("Email DONE !");
    document.register.email.style.border = '1px solid #ced4da';
    document.register.confirm_email.style.border = '1px solid #ced4da';
    count++;
  }
  else{
    displayErrorOnInput(email);
    displayErrorOnInput(confirm_email);
  }

  if(checkPassword(password.value,confirm_password.value)){
    console.log("Password DONE !");
    document.register.password.style.border = '1px solid #ced4da';
    document.register.confirm_password.style.border = '1px solid #ced4da';
    count++;
  }
  else{
    displayErrorOnInput(password);
    displayErrorOnInput(confirm_password);
  }

  if(checkAddressNum(address_num.value)){
    console.log("Address num DONE !");
    document.register.address_num.style.border = '1px solid #ced4da';
    count++;
  }
  else{
    displayErrorOnInput(address_num);
  }

  if(checkAddress(address.value)){
    console.log("Address DONE !");
    document.register.address.style.border = '1px solid #ced4da';
    count++;
  }
  else{
    displayErrorOnInput(address);
  }

  if(checkTown(town.value)){
    console.log("Town DONE !");
    document.register.town.style.border = '1px solid #ced4da';
    count++;
  }
  else{
    displayErrorOnInput(town);
  }

  if(checkNumTel(num_tel.value)){
    console.log("num tel DONE !");
    document.register.num_tel.style.border = '1px solid #ced4da';
    count++;
  }
  else{
    displayErrorOnInput(num_tel);
  }

  if(checkCaptcha(verif_captcha.value)){
    console.log("Captcha DONE !");
    document.register.verif_captcha.style.border = '1px solid #ced4da';
    count++;
  }
  else{
    displayErrorOnInput(verif_captcha);
  }

  console.log(count);
  if(count != 11){
    return false;
  }
}


function checkGender(gender){
  if(gender != ''){
    return true;
  }
}


function checkFirstname(firstname){
  if(firstname.length != 0){
    return true;
  }
}

function checkLastname(lastname){
  if(lastname.length != 0){
    return true;
  }
}


function checkBirthday(birthday){
  if(birthday != ''){
    return true;
  }
}


function checkEmail(email,confirm_email){
  if(email.indexOf('@') != -1){
    if(email == confirm_email){
      return true;
    }
  }
}


function checkPassword(password,confirm_password){
  console.log(password.length);
  if(password.length >= 6){
    if(password == confirm_password){
      return true;
    }
  }
}


function checkAddressNum(num){
  if(num != ''){
    return true;
  }
}


function checkAddress(address){
  if(address != ''){
    return true;
  }
}

function checkTown(town){
  if(town != ''){
    return true;
  }
}

function checkNumTel(num_tel){
  if(num_tel.length == 10 && num_tel != '' && num_tel.charAt(0) == '0'){
    return true;
  }
}

function checkCaptcha(captcha){
  if(captcha != ''){
    return true;
  }
}


function displayErrorOnInput(input){
  input.style.border = '1px solid red';
}
