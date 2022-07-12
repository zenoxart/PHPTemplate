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

                   $stmt = makeProcedure("InsertZuorndnungVonRaum('".$_POST['Raumbezeichnung']."'));");


                   if($stmt->count() > 0){


                    ?>
<div class="row">

<!-- Total Revenue -->
<div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
        <h5 class="card-header">Tabelle</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Bezeichnung</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php

                    while ($row = $stmt->fetch(PDO:FETCH_NUM)) {
                        foreach ($row as $r) {
                            echo ' <tr>
                            <td>'.$r[0].'</td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>'.$r[1].'
                                    Project</strong></td>
    
                        </tr>';
                        }
                   }
                   
                }

                    
              ?>
    
                           
                            <tr style="background: #FF686B;color: white">
                                <td>2</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular
                                        Project</strong></td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <?php 
    }
    ?>
        <!--/ Total Revenue -->

    </div>
</div>
<!-- / Content -->

<?php include "components/default/pagebottom.php"; ?>