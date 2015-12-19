function validateForm() {
    var valid =false;
    //validation functions for variables

    while(valid==false){
         if(document.loginForm.username.value !='' )
        {
            document.loginForm.username.style.borderColor="#0BA3CA";
            valid = true;
        }
        else if (document.loginForm.username.value =='')
        {
            document.loginForm.username.style.borderColor="#FF0000";
            valid = false;
            return false;
        }
         if(document.loginForm.password.value !='' )
        {
            document.loginForm.password.style.borderColor="#0BA3CA";
            valid = true;
        }
        else if (document.loginForm.password.value =='')
        {
            document.loginForm.password.style.borderColor="#FF0000";
            valid = false;
            return false;
        }
    }
    return true;
}