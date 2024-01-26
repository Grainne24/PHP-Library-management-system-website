function strlength (phone_num_length)
{
    var user_input = document.getElementById('num').value;
    if(user_input.length == phone_num_length)
    {
        return true;
    }
    else
    {
        alert("Phone number has to be 10 characters long");
        return false;
    }
}

function passcheck (password)
{
    var user_input = document.getElementById('pw').value;
    if(user_input.length == password)
    {
        return true;
    }
    else
    {
        alert("Password has to be 6 characters long");
        return false;
    }
}

function combine()
{
    return passcheck(6) && strlength(10);
}


var sbmit = document.getElementById("btn");

sbmit.addEventListener("click", strlength);
sbmit.addEventListener("click", passcheck);