function checkFirstName(){
            var firstName = document.getElementById('first_name').value;
            if( firstName == "" ){
              document.getElementById("firstNameErr").innerHTML = "* First name is required";
              return 1;
            }
            else{
              document.getElementById("firstNameErr").innerHTML = "* ";
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
            if( pgYop == "" || isNaN(pgYop) ){
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

            }
          }
          function company1Change(){
            var company1Ip = document.getElementById('company1');
            var company1 = company1Ip.options[company1Ip.selectedIndex].value;
            if( company1 != 'none' ){
              document.getElementById('company2').removeAttribute('disabled');
              document.getElementById('company1Err').innerHTML = "* ";
              return 0;
            }
            else{
              document.getElementById('company2').setAttribute('disabled',"");
              document.getElementById('company2').selectedIndex = 0;
              document.getElementById('company1Err').innerHTML = "* Atleast 1 company is required";
              company2Change();
              company3Change();
              company4Change();
            }
            return 1;
          }
          function company2Change(){
            var company2Ip = document.getElementById('company2');
            var company2 = company2Ip.options[company2Ip.selectedIndex].value;
            if( company2 != 'none' ){
              document.getElementById('company3').removeAttribute('disabled');
            }
            else{
              document.getElementById('company3').setAttribute('disabled',"");
              document.getElementById('company3').selectedIndex = 0;
              company3Change();
              company4Change();
            }
          }
          function company3Change(){
            var company3Ip = document.getElementById('company3');
            var company3 = company3Ip.options[company3Ip.selectedIndex].value;
            if( company3 != 'none' ){
              document.getElementById('company4').removeAttribute('disabled');
            }
            else{
              document.getElementById('company4').setAttribute('disabled',"");
              document.getElementById('company4').selectedIndex = 0;
              company4Change();
            }
          }
          function company4Change(){
            var company4Ip = document.getElementById('company4');
            var company4 = company4Ip.options[company4Ip.selectedIndex].value;
            if( company4 != 'none' ){
              document.getElementById('company5').removeAttribute('disabled');
            }
            else{
              document.getElementById('company5').setAttribute('disabled',"");
              document.getElementById('company5').selectedIndex = 0;
            }
          }
          function checkCompanies()
          {
            var companyIp = document.getElementById('company1');
            var company1 = companyIp.options[companyIp.selectedIndex].value;
            companyIp = document.getElementById('company2');
            var company2 = companyIp.options[companyIp.selectedIndex].value;
            companyIp = document.getElementById('company3');
            var company3 = companyIp.options[companyIp.selectedIndex].value;
            companyIp = document.getElementById('company4');
            var company4 = companyIp.options[companyIp.selectedIndex].value;
            companyIp = document.getElementById('company5');
            var company5 = companyIp.options[companyIp.selectedIndex].value;
            var err = 0;
            if( company1 != "none" && (company1 == company2 || company1 == company3 || company1 == company4 || company1 == company5) ){
              document.getElementById('company1Err').innerHTML = "* Duplicate selection detected";
              err += 1;
            }
            else{
              document.getElementById('company1Err').innerHTML = "* ";
            }
            if( company2 != "none" && (company2 == company3 || company2 == company4 || company2 == company5) ){
              document.getElementById('company2Err').innerHTML = "* Duplicate selection detected";
              err += 1;
            }
            else{
              document.getElementById('company2Err').innerHTML = "* ";
            }
            if( company3 != "none" && (company3 == company4 || company3 == company5) ){
              document.getElementById('company3Err').innerHTML = "* Duplicate selection detected";
              err += 1;
            }
            else{
              document.getElementById('company3Err').innerHTML = "* ";
            }
            if( company4 != "none" && (company4 == company5) ){
              document.getElementById('company4Err').innerHTML = "* Duplicate selection detected";
              err += 1;
            }
            else{
              document.getElementById('company4Err').innerHTML = "* ";
            }
            return err;
          }
          function validateForm(){
            var check = 1;
            check += checkFirstName();
            check += checkLastName();
            check += checkEmail();
            check += checkAge();
            check += checkDob();
            check += checkAddress();
            check += checkContact();
            check += checkPercentage10();
            check += checkPercentage12();
            check += checkUgCollege();
            check += checkUgCgpa();
            check += checkPgCollege();
            check += checkPgCgpa();
            check += checkPgYop();
            check += checkCompanies();
            check += company1Change();
            if( check != 0 ){
              window.alert("Please rectify all indicated errors");
              return false;
            }
            return true;
          }
