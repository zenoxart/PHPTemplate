<?php include "components/default/pagetop.php"; ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">

        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Alle Immobilien</h5>
                <form method="post">

                    <?php 

                        if(isset($_POST["rad"])){
                            $PostId = $_POST["rad"];
                        }else{
                            $PostId = -1;
                        }
                        $stmt2 = makeTableSelectHightlightId("CALL GetImmos();","rad",$PostId );

                        $stmt2->closeCursor();
                    ?>

                    <button type="submit" class="btn btn-info">Details Anzeigen</button>
                </form>
            </div>


        </div>

        <?php 
        if(isset($_POST["rad"])){ ?>

        <!-- Hauptdetails -->
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Immobilien-Details</h5>

                <?php
                    $stmt3 = makeTable("CALL GetDetailKopf(?)",[$_POST["rad"]]);

                    $stmt3->CloseCursor();
                ?>


            </div>
        </div>

        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Darstellung</h5>
        

        </div>
        </div>

        <!-- Heizung -->
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Heizen/Wasser</h5>

                <?php 
                    $stmt4 = makeList("CALL GetHeizung(?)",[$_POST["rad"]]);
                    
                    $stmt4->CloseCursor(); 
                ?>

            </div>

        </div>
        <!-- Flächen -->
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Flächen</h5>

                <?php
                    $stmt5 = makeTable("CALL GetDetailKopf(?)",[$_POST["rad"]]);

                    $stmt5->CloseCursor();
                ?>


            </div>
        </div>

        <!-- Raumanzahl -->
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Raumanzahl</h5>

                <?php 
                    $stmt6 = makeList("CALL GetRaumanzahl(?)",[$_POST["rad"]]);
                    
                    $stmt6->CloseCursor(); 
                ?>

            </div>
        </div>
        <!-- Sonstige Features -->
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Sonstige</h5>

                <?php 
                    $stmt7 = makeList("CALL GetFeatures(?)",[$_POST["rad"]]);
                    
                    $stmt7->CloseCursor(); 
                ?>
            </div>

        </div>
        <!-- Badegeräte -->
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Bad</h5>


                <?php 
                    $stmt8 = makeList("CALL GetBadgeraete(?)",[$_POST["rad"]]);
                    
                    $stmt8->CloseCursor(); 
                ?>

            </div>

        </div>
        <!-- Küchengeräte -->
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Küche</h5>

                <?php 
                    $stmt9 = makeList("CALL GetKuechengeraete(?)",[$_POST["rad"]]);
                    
                    $stmt9->CloseCursor(); 
                ?>
            </div>

        </div>

        <!-- Weitere Räume -->
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Sonstige Räume</h5>

                <?php 
                    $stmt10 = makeList("CALL GetRestbezeichnungen(?)",[$_POST["rad"]]);
                    
                    $stmt10->CloseCursor(); 
                ?>

            </div>

        </div>


        <?php }?>


    </div>
</div>

</div>
<!-- / Content -->

<?php include "components/default/pagebottom.php"; ?>