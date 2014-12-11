function formhash(form, password) {
    // Ny element input, hashat lösenordsfält
    var p = document.createElement("input");
 
    // Lägg till elementet i formen
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Säkra att lösenord i plaintext inte skickas
    password.value = "";
 
    // Skicka formen
    form.submit();
}
 
function regformhash(form, uid, email, password, conf) {
     // Kolla att varje fält har ett värde
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('Du måste fylla i alla fälten. Var god försök igen!');
        return false;
    }
 
    // Kolla användarnamnet
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Användarnamnet får endast innehålla bokstäver, siffror och understreck. Var god försök igen!"); 
        form.username.focus();
        return false; 
    }
 
    // Kollar att lösenordet är minst 6 tecken långt
    if (password.value.length < 6) {
        alert('Lösenordet måste vara minst 6 tecken långt.  Var god försök igen!');
        form.password.focus();
        return false;
    }
 
    // Minst en siffra, en versal och en gemen
    // Minst 6 tecken
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Lösenord måste innehålla minst en siffra, en versal och en gemen. Var god fösök igen!');
        return false;
    }
 
    // Kollar att lösenorden är identiska
    if (password.value != conf.value) {
        alert('Lösenordet och bekrätelsen matchar inte. Var god försök igen!');
        form.password.focus();
        return false;
    }
 
    // Skapara ett nytt inputelement för hashat lösenordsfält 
    var p = document.createElement("input");
 
    // Lägg till elementet i formen
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Säkra att plaintext lösenord inte skickas
    password.value = "";
    conf.value = "";
 
    // Skicka formen
    form.submit();
    return true;
}