<?php include "components/default/pagetop.php"; ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

        <!-- Total Revenue -->
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-12">
                        <h5 class="card-header m-0 me-2 pb-3">Neuen Raum erstellen</h5>

                        <div style="margin: 5px">
                            <form class="d-flex" method="post">
                                <input class="form-control me-2" type="text" placeholder="Raumbezeichnung"
                                    aria-label="Raumbezeichnung" name="Raumbezeichnung">
                                <button class="btn btn-outline-info" type="submit">Hinzufügen</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!--/ Total Revenue -->

    </div>

    <?php
    if(isset($_POST['Raumbezeichnung'])){
        $bezeichnung = $_POST['Raumbezeichnung'];

        $stmt = makeStatement('CALL InsertZuorndnungVonRaum("'.$bezeichnung.'")');

        $last = singleElement($stmt);

        $stmt->CloseCursor();

        $stmt2 = makeStatement('CALL GetZordnungVonRaeumen()');

        if($stmt2->rowCount() > 0){
            
            $stmt2->CloseCursor();
?>
    <div class="row">

        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Tabelle</h5>
                <?php
                    $stmt3 = makeTableHighlightId('CALL GetZordnungVonRaeumen()',$last);
                    $stmt3->CloseCursor();
                ?>
            </div>


        </div>

    </div>
    <?php 
    }
}
?>
</div>
<?php include "components/default/pagebottom.php"; ?>