<?php
include_once 'phpsec-conf.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Väljer ett slumpat sessionsnamn.
    $secure = SECURE;					// Byt till TRUE om HTTPS används.
    // Gör så att JavaScript inte kan komma åt sessionsid.
    $httponly = true;
    // Forcerar använding av cookies för sessioner.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Hämtar parametrar från aktuell cookie.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sätter sessionens namn till samma som valts ovan.
    session_name($session_name);
    session_start();            // Startar PHP Sessionen.
    session_regenerate_id();    // Regenererar sessionen (id) och tar bort gamla när sidan laddas.
}


// Loginfunktion
function login($email, $password, $mysqli) {
    // Använder förbestämda statements så att det inte går att injecera med SQL.
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Binder "$email" till parametern.
        $stmt->execute();    // Kör SQLfrågan.
        $stmt->store_result();
 
        // Hämta variabler från resultatet
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // Hashar lösenordet med unikt salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // Om användaren finns vill vi kolla om den är låst
            // från för många inloggningsförsök. 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Kontot är låst. 
                // Skickar email till användaren om att kontot är låst.
                return false;
            } else {
                // Kollar om lösenordet i databasen matchar
                // med det som användaren fyllt i.
                if ($db_password == $password) {
                    // Lösenordet matchar.
                    // Hämtar "user-agent string" för användaren.
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
                    // Fel lösenord.
                    // Försöket sparas i databasen.
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // Ingen användare med det namnet finns.
            return false;
        }
    }
}

// Funktion för att låsa konton med mer än 5 loginförsök. (för att motverka hackers som använder sig av "brute-forcing")
function checkbrute($user_id, $mysqli) {
    // Hämtar den aktuella tiden.
    $now = time();
 
    // Räknar alla inloggningsförsök f.rom nu och 2 timmar tillbaka. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Kör SQLfråga.
        $stmt->execute();
        $stmt->store_result();
 
        // Om det finns fler än 5 misslyckade inloggningsförsök. 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

// Funktion för att kolla om användaren är inloggad.
function login_check($mysqli) {
    // Kolla om alla variabler är ifyllda. 
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
            $stmt->execute();   // Kör SQLfråga.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // Om användaren finns hämtas varieablerna från svaret.
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

// Funktion som städar upp efter PHP_SELF (gömmer känslig data)
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
        // Vi är bara intresserade av relativa länkar från $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}