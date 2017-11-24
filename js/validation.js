function validate(){
    
        var name, surname, address, email, phone, username, password;   
        
        name = document.getElementById('name_u').value;
        surname = document.getElementById('surname_u').value;
        address = document.getElementById('address_u').value;
        email = document.getElementById('email_u').value;
        phone = document.getElementById('c_num_u').value;
        username = document.getElementById('username_u').value;
        password = document.getElementById('password_u').value;
        
        email_exp = /^(?:(?:[\w`~!#$%^&*\-=+;:{}'|,?\/]+(?:(?:\.(?:"(?:\\?[\w`~!#$%^&*\-=+;:{}'|,?\/\.()<>\[\] @]|\\"|\\\\)*"|[\w`~!#$%^&*\-=+;:{}'|,?\/]+))*\.[\w`~!#$%^&*\-=+;:{}'|,?\/]+)?)|(?:"(?:\\?[\w`~!#$%^&*\-=+;:{}'|,?\/\.()<>\[\] @]|\\"|\\\\)+"))@(?:[a-zA-Z\d\-]+(?:\.[a-zA-Z\d\-]+)*|\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\])$/;
        name_exp =/([A-Z][a-z.]*)/;
        address_exp = /([a-z ]{2,}\s{0,1}\d{0,3})/;
       
    
    if(name == "" || surname == "" || address =="" || email == "" || phone =="" || username == "" || password == ""){
        alert('All fields are mandatory');
        return false;
    }
    
    else if(name.length>20){
         alert('Your name must not have more than 20 characters length');
        return false;
    }
    else if(!name_exp.test(name)){
         alert('This is not a valid Name');
        return false;
    }
    
    else if(surname.length>30){
         alert('Your name must not have more than 30 characters length');
        return false;    
    }
    else if(!name_exp.test(surname)){
         alert('This is not a valid Surname');
        return false;
    }
     
        
    else if(address.length>255 || address.length< 3){
         alert('Please type in a valid Address');
        return false;    
    }
    else if(!address_exp.test(address)){
         alert('This is not a valid Address ');
        return false;
    }
    
    else if(email.length>80){
        alert('Your E-mail address is too long');
        return false;    
    }
    
    else if(!email_exp.test(email)){
        alert('Your E-mail is not valid');
        return false;    
    }
    
    else if(phone.length>20){
         alert('The phone number is too long');
        return false;
    }
    
    else if(isNaN(phone)){
         alert('The phone entered is not a number');
        return false;
    }
    
    else if(username.length>10 || password.length>10){
         alert('The username and password must not exceed 10 characters length !');
        return false;    
    }
}
