<?php
include_once 'phpsec-conf.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // V�ljer ett slumpat sessionsnamn.
    $secure = SECURE;					// Byt till TRUE om HTTPS anv�nds.
    // G�r s� att JavaScript inte kan komma �t sessionsid.
    $httponly = true;
    // Forcerar anv�nding av cookies f�r sessioner.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // H�mtar parametrar fr�n aktuell cookie.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // S�tter sessionens namn till samma som valts ovan.
    session_name($session_name);
    session_start();            // Startar PHP Sessionen.
    session_regenerate_id();    // Regenererar sessionen (id) och tar bort gamla n�r sidan laddas.
}


// Loginfunktion
function login($email, $password, $mysqli) {
    // Anv�nder f�rbest�mda statements s� att det inte g�r att injecera med SQL.
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Binder "$email" till parametern.
        $stmt->execute();    // K�r SQLfr�gan.
        $stmt->store_result();
 
        // H�mta variabler fr�n resultatet
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // Hashar l�senordet med unikt salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // Om anv�ndaren finns vill vi kolla om den �r l�st
            // fr�n f�r m�nga inloggningsf�rs�k. 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Kontot �r l�st. 
                // Skickar email till anv�ndaren om att kontot �r l�st.
                return false;
            } else {
                // Kollar om l�senordet i databasen matchar
                // med det som anv�ndaren fyllt i.
                if ($db_password == $password) {
                    // L�senordet matchar.
                    // H�mtar "user-agent string" f�r anv�ndaren.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // Skydd mot cross site script.
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // Skydd mot cross site script.
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Lyckad inloggning.
                    return true;
                } else {
                    // Fel l�senord.
                    // F�rs�ket sparas i databasen.
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // Ingen anv�ndare med det namnet finns.
            return false;
        }
    }
}

// Funktion f�r att l�sa konton med mer �n 5 loginf�rs�k. (f�r att motverka hackers som anv�nder sig av "brute-forcing")
function checkbrute($user_id, $mysqli) {
    // H�mtar den aktuella tiden.
    $now = time();
 
    // R�knar alla inloggningsf�rs�k f.rom nu och 2 timmar tillbaka. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // K�r SQLfr�ga.
        $stmt->execute();
        $stmt->store_result();
 
        // Om det finns fler �n 5 misslyckade inloggningsf�rs�k. 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

// Funktion f�r att kolla om anv�ndaren �r inloggad.
function login_check($mysqli) {
    // Kolla om alla variabler �r ifyllda. 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Binder "$user_id" till parametern. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // K�r SQLfr�ga.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // Om anv�ndaren finns h�mtas varieablerna fr�n svaret.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Inloggad! 
                    return true;
                } else {
                    // Inloggning misslyckad. 
                    return false;
                }
            } else {
                // Inloggning misslyckad. 
                return false;
            }
        } else {
            // Inloggning misslyckad.  
            return false;
        }
    } else {
        // Inloggning misslyckad.  
        return false;
    }
}

// Funktion som st�dar upp efter PHP_SELF (g�mmer k�nslig data)
function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // Vi �r bara intresserade av relativa l�nkar fr�n $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}