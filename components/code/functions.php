<?php

include("connection.php");

function makeTableSelect($query, $radioName = "rad", $array = null,)
{
    $stmt = makeStatement($query, $array);

    echo '<div class="table-responsive text-nowrap">';
    echo ' <table class="table table-striped">';
    $meta = array();
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $meta[] = $stmt->getColumnMeta($i);
        echo '<th>' . $meta[$i]['name'] . '</th>';
    }
    echo '
    <tbody class="table-border-bottom-0">';


    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo '<tr>';
        foreach ($row as $r) {
            echo '<td>' . $r . '</td>';
        }

        echo '<td>.<input type="radio" name="' . $radioName . '" value="' . $row[0] . '"> </td>';

        echo '</tr>';
    }

    echo "</tbody></table></div>";

    return $stmt;
}

function makeTableSelectHightlightId($query, $radioName = "rad", $id = -1, $array = null)
{
    $stmt = makeStatement($query, $array);

    echo '<div class="table-responsive text-nowrap">';
    echo ' <table class="table table-striped">';
    $meta = array();
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $meta[] = $stmt->getColumnMeta($i);
        echo '<th>' . $meta[$i]['name'] . '</th>';
    }
    echo '
    <tbody class="table-border-bottom-0">';


    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        if ($row[0] == $id) {
            echo '<tr class="table-danger">';
        } else {
            echo '<tr>';
        }

        foreach ($row as $r) {
            echo '<td>' . $r . '</td>';
        }

        echo '<td>.<input type="radio" name="' . $radioName . '" value="' . $row[0] . '"> </td>';

        echo '</tr>';
    }

    echo "</tbody></table></div>";

    return $stmt;
}

function makeTable($query, $array = null)
{
    $stmt = makeStatement($query, $array);

    $darstellung = "";

    if ($stmt != null) {
        $darstellung = $darstellung. '<div class="table-responsive text-nowrap">';
        $darstellung = $darstellung.  ' <table class="table table-striped">';
        $meta = array();


        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $meta[] = $stmt->getColumnMeta($i);
            $darstellung = $darstellung.  '<th>' . $meta[$i]['name'] . '</th>';
        }
        $darstellung = $darstellung.  '<tbody class="table-border-bottom-0">';

        $counter = 0;
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $darstellung = $darstellung.  '<tr>';
            foreach ($row as $r) {
                $darstellung = $darstellung.  '<td>' . $r . '</td>';
            }
            $darstellung = $darstellung.  '</tr>';
            $counter++;
        }

        $darstellung = $darstellung.  "</tbody></table></div>";
        if ($counter == 0 ){
            echo "<tr> <td> KEIN Datensatz vorhanden ! </td> </tr>";
        }else{
            echo $darstellung;
        }


    }


    return $stmt;
}

function singleElement($stmt)
{

    $last = null;
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $last = $row[0];
    }

    return $last;
}

function makeTableHighlightId($query, $id = -1, $array = null)
{
    $stmt = makeStatement($query, $array);

    echo '<div class="table-responsive text-nowrap">';
    echo ' <table class="table table-striped">';
    $meta = array();
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $meta[] = $stmt->getColumnMeta($i);
        echo '<th>' . $meta[$i]['name'] . '</th>';
    }
    echo '<tbody class="table-border-bottom-0">';


    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {

        if ($row[0] == $id) {
            echo '<tr class="table-danger">';
        } else {
            echo '<tr>';
        }
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

    return $stmt;
}

function makeList($query, $array = null)
{
    $stmt = makeStatement($query, $array);

    echo '<div class="list-group list-group-flush">';

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo '<a  class="list-group-item list-group-item-action">' . $row[0] . '</a>';
        }
    }
    echo '</div>';

    return $stmt;
}

function makeCarousel($pics = [], $picroot = "../")
{


    echo '<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">';
    echo '<ol class="carousel-indicators">';

    $SlideCounter = 0;
    while ($SlideCounter < count($pics)) {
        echo '<li data-bs-target="#carouselExample" data-bs-slide-to="' . $SlideCounter . '"></li>';

        $SlideCounter += 1;
    }

    echo '</ol>';
    echo '<div class="carousel-inner">';

    // Carousel-Item
    $SlideCounter = 0;
    while ($SlideCounter < count($pics)) {
        echo '<div class="carousel-item">';
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

function getMySqlVersion()
{
    $sql = "SELECT VERSION();";
    return singleElement(makeStatement($sql));
}
