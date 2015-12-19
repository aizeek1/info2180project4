function validateForm() {
    var valid =false;
    
    ///^[A-Za-z\d]*$/
    //validation functions for variables
    var pass = /^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*/;
  ///^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9].*/
     var name=/^[a-zA-Z ]*$/;
  //validation functions for variables

    while(valid==false){
        if(document.userForm.firstname.value !='' && name.test(document.userForm.firstname.value ))
        {
            document.userForm.firstname.style.borderColor="#0BA3CA";
            valid = true; 
        }
        
        else if (document.userForm.firstname.value =='' || (!(name.test(document.userForm.firstname.value ))))
        {
            document.userForm.firstname.style.borderColor="#FF0000";
            valid = false;
            return false;
        }

        if(document.userForm.lastname.value !=''&& name.test(document.userForm.lastname.value))
        {
            document.userForm.lastname.style.borderColor="#0BA3CA";
            valid = true;
        }
        else if (document.userForm.lastname.value =='' || (!(name.test(document.userForm.lastname.value ))))
        {
            document.userForm.lastname.style.borderColor="#FF0000";
            valid = false;
            return false;
        }

        
        if (document.userForm.username.value =='') 
        {
            document.userForm.username.style.borderColor="#FF0000";
            valid = false;  
            return false;
        }
        else
        {
            document.userForm.username.style.borderColor="#0BA3CA";
            valid=true;
        }
        
        if (document.userForm.position.value =='') 
        {
            document.userForm.position.style.borderColor="#FF0000";
            valid = false;  
            return false;
        }
        else
        {
            document.userForm.position.style.borderColor="#0BA3CA";
            valid=true;
        }
        
        if ((document.userForm.password.value =='') || ((document.userForm.password.value).length < 8) || (!(pass.test(document.userForm.password.value))))
        {
            document.userForm.password.style.borderColor="#FF0000";
            valid = false;
            return false;
        }
        else if((document.userForm.password.value !='') && pass.test(document.userForm.password.value))
        {
            document.userForm.password.style.borderColor="#0BA3CA";
            valid=true;
        }
        
        if(document.userForm.confirmpassword.value =='' || (document.userForm.confirmpassword.value).length < 8 || (!(pass.test(document.userForm.confirmpassword.value))))
        {
            document.userForm.confirmpassword.style.borderColor="#FF0000";
            valid = false;
            return false;
        }
        else if(document.userForm.confirmpassword.value !='' && pass.test(document.userForm.confirmpassword.value))
        {
             document.userForm.confirmpassword.style.borderColor="#0BA3CA";
             valid=true;
        }
        
        if(document.userForm.password.value != document.userForm.confirmpassword.value )
        {
            document.userForm.confirmpassword.style.borderColor="#FF0000";
            document.userForm.password.style.borderColor="#FF0000";
            valid = false;
            return false;
        }
        else if (document.userForm.password.value == document.userForm.confirmpassword.value )
        {
            document.userForm.confirmpassword.style.borderColor="#0BA3CA";
            document.userForm.password.style.borderColor="#0BA3CA";
            valid = true;
        }
    }
   console.log(valid);
   return true;
}
