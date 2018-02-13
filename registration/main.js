function checkTid(){
  var tid = document.getElementById('tid').value;
  if(tid != ''){
    document.getElementById('detailEntry').submit();
  }
}

function checkName(){
  var name = document.getElementById('full_name').value;
  if( name == "" ){
    document.getElementById("fullNameErr").innerHTML = "* Name is required";
    return 1;
  }
  else{
    document.getElementById("fullNameErr").innerHTML = "* ";
  }
  return 0;
}

function checkLastName(){
  var lastName = document.getElementById('last_name').value;
  if( lastName == "" ){
    document.getElementById("lastNameErr").innerHTML = "* Last name is required";
    return 1;
  }
  else{
    document.getElementById("lastNameErr").innerHTML = "* ";
  }
  return 0;
}

function checkEmail(){
  var email = document.getElementById('email').value;
  if( email == "" ){
    document.getElementById("emailErr").innerHTML = "* Email is required";
    return 1;
  }
  else{
    document.getElementById("emailErr").innerHTML = "* ";
  }
  return 0;
}

function checkAge(){
  var age = document.getElementById('age').value;
  if( age < 18 || age > 25 ){
    document.getElementById("ageErr").innerHTML = "* Specified age cannot register";
    return 1;
  }
  else{
    document.getElementById("ageErr").innerHTML = "* ";
  }
  return 0;
}

function checkDob(){
  var dob = document.getElementById('dob').value;
  if( dob == ""){
    document.getElementById("dobErr").innerHTML = "* Date of Birth is required";
    return 1;
  }
  else{
    document.getElementById("dobErr").innerHTML = "* ";
  }
  return 0;
}

function checkAddress(){
  var address = document.getElementById("address").value;
  if( address == "" ){
    document.getElementById("addressErr").innerHTML = "* Address cannot be empty";
    return 1;
  }
  else
  {
    document.getElementById("addressErr").innerHTML = "* ";
  }
  return 0;
}

function checkContact(){
  var contact = document.getElementById('contact').value;
  var len=contact.length;
  if( len != 10 ){
    document.getElementById("contactErr").innerHTML = "* Invalid Contact Number";
    return 1;
  }
  else{
    document.getElementById("contactErr").innerHTML = "* ";
  }
  return 0;
}

function checkPercentage10(){
  var percentage10 = document.getElementById('percentage10').value;
  if( percentage10 > 100 || isNaN(percentage10) || percentage10 == "") {
    document.getElementById("percentage10Err").innerHTML = "* Invalid Input";
    return 1;
  }
  else{
    document.getElementById("percentage10Err").innerHTML = "* ";
  }
  return 0;
}

function checkPercentage12(){
  var percentage12 = document.getElementById('percentage12').value;
  if( percentage12 > 100 || isNaN(percentage12) || percentage12 == "") {
    document.getElementById("percentage12Err").innerHTML = "* Invalid Input";
    return 1;
  }
  else{
    document.getElementById("percentage12Err").innerHTML = "* ";
  }
  return 0;
}

function checkUgCollege(){
  var ugCollege = document.getElementById('ugCollege').value;
  if( ugCollege == "" ){
    document.getElementById('ugCollegeErr').innerHTML = "* Specify College";
    return 1;
  }
  else{
    document.getElementById('ugCollegeErr').innerHTML = "* ";
  }
  return 0;
}

function checkUgCgpa(){
  var ugCgpa = document.getElementById('ugCgpa').value;
  if( ugCgpa == "" || isNaN(ugCgpa) || ugCgpa>100 || (ugCgpa > 10 && ugCgpa < 20) ){
    document.getElementById('ugCgpaErr').innerHTML = "* Invalid Input";
    return 1;
  }
  else{
    document.getElementById('ugCgpaErr').innerHTML = "* ";
  }
  return 0;
}

function fresherChange(){
  fresher = document.getElementsByName('fresher');
  if( fresher[0].checked ){
    document.getElementById('experienceInput').style.display = 'none';
    document.getElementById('experience').setAttribute("disabled","");
    document.getElementById('expCompany').setAttribute("disabled","");
    document.getElementById('experienceErr').innerHTML = "";
    document.getElementById('expCompanyErr').innerHTML = "";

  }
  else{
    document.getElementById('experienceInput').style.display = 'block';
    document.getElementById('experience').removeAttribute("disabled");
    document.getElementById('expCompany').removeAttribute("disabled");
    document.getElementById('experienceErr').innerHTML = "* ";
    document.getElementById('expCompanyErr').innerHTML = "* ";
  }
}

function checkExperience(){
  fresher = document.getElementsByName('fresher');
  if(fresher[0].checked){
    document.getElementById('experienceErr').innerHTML = "";
    return 0;
  }
  experience = document.getElementById('experience').value;
  if( experience == "" || experience == "0" || isNaN(experience) ){
    document.getElementById('experienceErr').innerHTML = "* Invalid Input";
    console.log("experience err");
    return 1;
  }
  else{
    document.getElementById('experienceErr').innerHTML = "* ";
  }
  return 0;
}

function checkExpCompany(){
  fresher = document.getElementsByName('fresher');
  if(fresher[0].checked){
    document.getElementById('expCompanyErr').innerHTML = "";
    return 0;
  }
  expCompany = document.getElementById('expCompany').value;
  if( expCompany== "" ){
    document.getElementById('expCompanyErr').innerHTML = "* Please Specify Previous Company";
    return 1;
  }
  else{
    document.getElementById('expCompanyErr').innerHTML = "* ";
  }
  return 0;
}

function checkPgCollege(){
  if( document.getElementById('pgCollege').hasAttribute('disabled') ){
    return 0;
  }
  var pgCollege = document.getElementById('pgCollege').value;
  if( pgCollege == "" ){
    document.getElementById('pgCollegeErr').innerHTML = "* Specify College";
    return 1;
  }
  else{
    document.getElementById('pgCollegeErr').innerHTML = "* ";
  }
  return 0;
}

function checkPgCgpa(){
  if( document.getElementById('pgCgpa').hasAttribute('disabled') ){
    return 0;
  }
  var pgCgpa = document.getElementById('pgCgpa').value;
  if( pgCgpa == "" || isNaN(pgCgpa) ){
    document.getElementById('pgCgpaErr').innerHTML = "* Invalid Input";
    return 1;
  }
  else{
    document.getElementById('pgCgpaErr').innerHTML = "* ";
  }
  return 0;
}

function checkPgYop(){
  if( document.getElementById('pgYop').hasAttribute('disabled') ){
    return 0;
  }
  var pgYop = document.getElementById('pgYop').value;
  if( pgYop == "" || isNaN(pgYop) || pgYop < 2015 || pgYop > 2018 ){
    document.getElementById('pgYopErr').innerHTML = "* Invalid Input";
    return 1;
  }
  else{
    document.getElementById('pgYopErr').innerHTML = "* ";
  }
  return 0;
}

function pgCourseChange(){
  var pgCourseIp = document.getElementById('pgCourse');
  var pgCourse = pgCourseIp.options[pgCourseIp.selectedIndex].value;
  if( pgCourse == "none" ){
    document.getElementById('pgCollege').setAttribute('disabled',"");
    document.getElementById('pgCgpa').setAttribute('disabled',"");
    document.getElementById('pgYop').setAttribute('disabled',"");
    document.getElementById('pgCollegeErr').innerHTML = "";
    document.getElementById('pgCgpaErr').innerHTML = "";
    document.getElementById('pgYopErr').innerHTML = "";
    document.getElementById('pgInput').style.display = "none";
  }
  else{
    document.getElementById('pgCollege').removeAttribute('disabled');
    document.getElementById('pgCgpa').removeAttribute('disabled');
    document.getElementById('pgYop').removeAttribute('disabled');
    document.getElementById('pgCollege').value = "";
    document.getElementById('pgCgpa').value = "";
    document.getElementById('pgYop').value = "";
    document.getElementById('pgCollegeErr').innerHTML = "* ";
    document.getElementById('pgCgpaErr').innerHTML = "* ";
    document.getElementById('pgYopErr').innerHTML = "* ";
    document.getElementById('pgInput').style.display = "block";
  }
}

var alertFlag = 0;
function validateForm(){
  //debugger;
  var check = 0;
  check += checkName();
  //check += checkLastName();
  check += checkEmail();
  check += checkAge();
  check += checkDob();
  check += checkAddress();
  check += checkContact();
  check += checkPercentage10();
  check += checkPercentage12();
  check += checkUgCollege();
  check += checkUgCgpa();
  check += checkExperience();
  check += checkExpCompany();
  check += checkPgCollege();
  check += checkPgCgpa();
  check += checkPgYop();
  if( check != 0 ){
    if( alertFlag == 0 ){
      window.alert("Please rectify all indicated errors");
      alertFlag = 1;
    }
    return false;
  }
  return true;
}



