// Generic delete confirmation modal
function confirmDel() {
    return confirm('Are you surfed dyou want to delete this item?')
}

function comparePasswords(){
    // get 2 password values from form
    let pw1 = document.getElementById('password').value
    let pw2 = document.getElementById('confirm').value
    let message = document.getElementById('message')

    //compare password values
    if(pw1 !== pw2){
        message.innerText = "password must match"
        mesasge.className = "alert alert-info"
        return false;

    }
    else{
        message.innerText = "Passwords must be a minimum of 8 characters, including 1 digit, 1 upper-case letter, and 1 lower-case letter."
        mesasge.className = "alert alert-secondary"
        return true
        }
    }

    function showHidePassword(){
        // refrence password input and showHide icons
        let pw = document.getElementById('password')
        let img = document.getElementById('showHide')

        if(pw.type == 'password'){
            pw.type = 'text'
            img.src = 'img/hide.png'
        }
        else{
            pw.type = 'password'
            img.src = 'img/show.png'
        }
    }