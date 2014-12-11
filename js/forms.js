function formhash(form, password) {
    // Ny element input, hashat l�senordsf�lt
    var p = document.createElement("input");
 
    // L�gg till elementet i formen
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // S�kra att l�senord i plaintext inte skickas
    password.value = "";
 
    // Skicka formen
    form.submit();
}
 
function regformhash(form, uid, email, password, conf) {
     // Kolla att varje f�lt har ett v�rde
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('Du m�ste fylla i alla f�lten. Var god f�rs�k igen!');
        return false;
    }
 
    // Kolla anv�ndarnamnet
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Anv�ndarnamnet f�r endast inneh�lla bokst�ver, siffror och understreck. Var god f�rs�k igen!"); 
        form.username.focus();
        return false; 
    }
 
    // Kollar att l�senordet �r minst 6 tecken l�ngt
    if (password.value.length < 6) {
        alert('L�senordet m�ste vara minst 6 tecken l�ngt.  Var god f�rs�k igen!');
        form.password.focus();
        return false;
    }
 
    // Minst en siffra, en versal och en gemen
    // Minst 6 tecken
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('L�senord m�ste inneh�lla minst en siffra, en versal och en gemen. Var god f�s�k igen!');
        return false;
    }
 
    // Kollar att l�senorden �r identiska
    if (password.value != conf.value) {
        alert('L�senordet och bekr�telsen matchar inte. Var god f�rs�k igen!');
        form.password.focus();
        return false;
    }
 
    // Skapara ett nytt inputelement f�r hashat l�senordsf�lt 
    var p = document.createElement("input");
 
    // L�gg till elementet i formen
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // S�kra att plaintext l�senord inte skickas
    password.value = "";
    conf.value = "";
 
    // Skicka formen
    form.submit();
    return true;
}