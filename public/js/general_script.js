
   function signUp() {
            let message_alert = document.getElementById("message");
            var password = document.getElementById("signup_password").value;
            var confirm_password = document.getElementById("signup_confirm_password").value;
            var user_email =document.getElementById("signup_email").value;
            var sign_up_btn = document.getElementById("sign_up_btn");
        
            if(confirm_password == password){
                if(password.length <= 5){
                     message_alert.innerText = "Password needs atleast 6 characters";
                     sign_up_btn.disabled = true;     
                }
                else{
            message_alert.innerText = ""; 
             sign_up_btn.disabled = false;  
             }
        }
            else{
             message_alert.innerText = "Inputted password not matches"; 
             sign_up_btn.disabled = true;   
            }
        }



