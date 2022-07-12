<?php

// Eröffnet eine MySQL-Datenbank-Verbindung mit PDO (PHP Data Objects)
try {
    // Server-Name
    $server = 'localhost:3306';
    // Datenbank-Schema
    $db = '';
    // Datenbank-Benutzer
    $user = 'root';
    $pwd = '';

    // Erstellung eines Connection-Strings inklusive Datenbank-Verbindung
    $con = new PDO('mysql:host=' . $server . ';dbname=' . $db . ';charset=utf8', $user, $pwd);

    // Definiert das Exceptions geworfen werden können
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // Schreibt die Fehler-Meldung
    echo $e->getCode() . ': ' . $e->getMessage() . '<br>';
}

// Führt auf der offen Datenbank-Verbindung ein Prepared-Statement aus um vor SQL-Injections zu schützen
function makeStatement($query, $array = null)
{
    try {

        global $con;
        $stmt = $con->prepare($query);

        // führt übergebenen Prepared-Paramenter aus
        $stmt->execute($array);

        // Gibt das Statement zurück um checken zu können, ob es erfolgreich war, & um optional offene Cursor schließen zu können
        return $stmt;
    } catch (Exception $e) {

        // bereinigt die Message und entfernt den text mit SQLSTATE[45000]:
        $message = $e->getMessage();
        $codePosition = strpos($message, "[{$e->getCode()}]");
        if ($codePosition !== false) {
            $message = trim(substr($message, $codePosition + strlen("[{$e->getCode()}]") + 1));
        }

        // bereinigt die Message und entfernt <>: plus den opening-tag von <unkownError> um nur die Message anzeigen zu lassen
        $message = trim(substr($message, 23));

        echo $message;
    }
}
