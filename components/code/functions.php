<?php

// Einbindung der Datenbank-Verbindung und der Kern-Funktion makeStatement
include("connection.php");

// Erstellt eine Tabelle mit Selectionsmöglichkeit aus der angegebenen query/procedure
function makeTableSelect($query, $radioName = "rad", $array = null,)
{
    // Führt das Prepared Statement aus
    $stmt = makeStatement($query, $array);

    // verhindert eine null-pointer-exception
    if ($stmt != null) {
        echo '<div class="table-responsive text-nowrap">';
        echo ' <table class="table table-striped">';

        // Erstellt aus den Meta-Daten den Header der Tabelle 
        $meta = array();
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $meta[] = $stmt->getColumnMeta($i);
            echo '<th>' . $meta[$i]['name'] . '</th>';
        }
        echo '<tbody class="table-border-bottom-0">';

        // Für jede Zeile in der Datenbank-Response
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo '<tr>';
            // Für jedes Element in der Zeile
            foreach ($row as $r) {
                echo '<td>' . $r . '</td>';
            }

            // Erstellt einen Radio-Button zum auswählen
            echo '<td>.<input type="radio" name="' . $radioName . '" value="' . $row[0] . '"> </td>';

            echo '</tr>';
        }

        echo "</tbody></table></div>";
    }

    return $stmt;
}

// Erstellt eine Tabelle mit Selectionsmöglichkeit & optionalem Zeilen-Highlighing aus der angegebenen query/procedure
function makeTableSelectHightlightId($query, $radioName = "rad", $id = -1, $array = null)
{
    // Führt das Prepared Statement aus
    $stmt = makeStatement($query, $array);

    // verhindert eine null-pointer-exception
    if ($stmt != null) {

        echo '<div class="table-responsive text-nowrap">';
        echo ' <table class="table table-striped">';

        // Erstellt aus den Meta-Daten den Header der Tabelle 
        $meta = array();
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $meta[] = $stmt->getColumnMeta($i);
            echo '<th>' . $meta[$i]['name'] . '</th>';
        }
        echo '<tbody class="table-border-bottom-0">';


        // Für jede Zeile in der Datenbank-Response
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            if ($row[0] == $id) {
                echo '<tr class="table-danger">';
            } else {
                echo '<tr>';
            }

            // Für jedes Element in der Zeile
            foreach ($row as $r) {
                echo '<td>' . $r . '</td>';
            }

            echo '<td>.<input type="radio" name="' . $radioName . '" value="' . $row[0] . '"> </td>';

            echo '</tr>';
        }

        echo "</tbody></table></div>";
    }

    return $stmt;
}

// Erstellt einen Tabelle aus der angegebenen query/procedure 
function makeTable($query, $array = null)
{
    // Führt das Prepared Statement aus
    $stmt = makeStatement($query, $array);

    $darstellung = "";

    // verhindert eine null-pointer-exception
    if ($stmt != null) {
        $darstellung = $darstellung . '<div class="table-responsive text-nowrap">';
        $darstellung = $darstellung .  ' <table class="table table-striped">';

        // Erstellt aus den Meta-Daten den Header der Tabelle 
        $meta = array();
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $meta[] = $stmt->getColumnMeta($i);
            $darstellung = $darstellung .  '<th>' . $meta[$i]['name'] . '</th>';
        }

        $darstellung = $darstellung .  '<tbody class="table-border-bottom-0">';

        $counter = 0;

        // Für jede Zeile in der Datenbank-Response
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $darstellung = $darstellung .  '<tr>';
            // Für jedes Element in der Zeile
            foreach ($row as $r) {
                $darstellung = $darstellung .  '<td>' . $r . '</td>';
            }
            $darstellung = $darstellung .  '</tr>';
            $counter++;
        }

        $darstellung = $darstellung .  "</tbody></table></div>";
        // Prüfen ob überhaupt ein Datensatz vorhanden ist, ansonst Fehlernachricht
        if ($counter == 0) {
            echo "<tr> <td> KEIN Datensatz vorhanden ! </td> </tr>";
        } else {
            echo $darstellung;
        }
    }


    return $stmt;
}

// Erstellt ein Select aus der angegebenen query/procedure
function makeSelect($name, $query, $array = null)
{

    // Führt das Prepared Statement aus
    $stmt = makeStatement($query, $array);

    // verhindert eine null-pointer-exception
    if ($stmt != null) {

        $darstellung = '<select name="' . $name . '" class="form-select">';

        $counter = 0;
        // Für jede Zeile in der Datenbank-Response
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {


            $darstellung = $darstellung . ' <option value="' . $row[0] . '">' . $row[1] . '</option>';

            $counter++;
        }

        if($counter < 1) { 
            
            $darstellung = $darstellung . ' <option >Keine Werte Vorhanden!</option>';
        }


        $darstellung = $darstellung . '</select>';
        echo $darstellung;
    }
}

// Erstellt eine Tabelle mit optionalem Zeilen-Highlighing aus der angegebenen query/procedure
function makeTableHighlightId($query, $id = -1, $array = null)
{
    // Führt das Prepared Statement aus
    $stmt = makeStatement($query, $array);

    if ($stmt != null) {

        echo '<div class="table-responsive text-nowrap">';
        echo ' <table class="table table-striped">';

        // Erstellt aus den Meta-Daten den Header der Tabelle 
        $meta = array();
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $meta[] = $stmt->getColumnMeta($i);
            echo '<th>' . $meta[$i]['name'] . '</th>';
        }
        echo '<tbody class="table-border-bottom-0">';


        // Für jede Zeile in der Datenbank-Response
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {

            if ($row[0] == $id) {
                echo '<tr class="table-danger">';
            } else {
                echo '<tr>';
            }
            // Für jedes Element in der Zeile
            foreach ($row as $r) {
                echo '<td>' . $r . '</td>';
            }
            echo '</tr>';
        }

        if ($id == null || $id == -1) {

            echo '<div style="margin:5pt" class="alert alert-danger alert-dismissible" role="alert">
                    Wert existiert bereits, oder konnte nicht eingefügt werden 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        }

        echo "</tbody></table></div>";
    }
    return $stmt;
}

// Erstellt eine Liste aus der angegebenen query/procedure
function makeList($query, $array = null)
{
    // Führt das Prepared Statement aus
    $stmt = makeStatement($query, $array);

    echo '<div class="list-group list-group-flush">';

    // checkt ob Werte vorhanden sind
    if ($stmt->rowCount() > 0) {
        // Für jede Zeile in der Datenbank-Response
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo '<a  class="list-group-item list-group-item-action">' . $row[0] . '</a>';
        }
    }
    echo '</div>';

    return $stmt;
}

// Erstellt eine Carousel-Ansicht aus einem Array an Bilder-Namen und dem übergebenen Root-Pfad
function makeCarousel($pics = [], $picroot = "../")
{


    echo '<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">';
    echo '<ol class="carousel-indicators">';

    $SlideCounter = 0;

    // Für jeden Bild-Namen im Array
    while ($SlideCounter < count($pics)) {
        // Dem Carousel die Slider-Id/Counter zuweisen
        echo '<li data-bs-target="#carouselExample" data-bs-slide-to="' . $SlideCounter . '"></li>';

        $SlideCounter += 1;
    }

    echo '</ol>';
    echo '<div class="carousel-inner">';

    // Carousel-Item
    $SlideCounter = 0;
    while ($SlideCounter < count($pics)) {
        echo '<div class="carousel-item">';
        // Dateipfad zusammenbauen 
        echo '<img class="d-block w-100" src="' . $picroot . "" . $pics[$SlideCounter] . '" alt="Slide" />';

        echo '</div>';
        $SlideCounter += 1;
    }


    // Selection Jump-Btns
    echo '</div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </a>
            </div>';
}

// Gibt die Datenbank-Version zurück
function getMySqlVersion()
{
    
    $sql = "SELECT VERSION();";

    // Holt die Datenbank-Version mit einem Statement und gibt ein einzelnes Element zurück
    return singleElement(makeStatement($sql));
}


// Gib ein einzelnes Element aus dem Statement zurück
// NOTICE: Wenn mehr als 1 Wert zurück-kommen sollte wird nur der letze Wert zurück gegeben.
function singleElement($stmt)
{
    $last = null;

    // verhindert eine null-pointer-exception
    if ($stmt != null) {

        // Für jede Zeile in der Datenbank-Response
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            // Nimm nur das Element in der ersten Spalte
            $last = $row[0];
        }
    }

    return $last;
}
