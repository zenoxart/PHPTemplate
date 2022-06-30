<?php include "components/default/pagetop.php"; ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">

        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <h5 class="card-header">Suche unter Immobilien</h5>

                <form method="post">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Suche nach</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Suche ...">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Kategorie</label>
                            <select class="form-select" id="exampleFormControlSelect1"
                                aria-label="Default select example">
                                <option value="1">Ort</option>
                                <option value="2">PLZ</option>
                                <option value="3">Straßenname</option>
                                <option value="4">Preis (Suche bis max Doppeltes vom Wert)</option>
                                <option value="5">Raumname</option>
                                <option value="6">Fläche (ab Suchwert)</option>
                                <option value="7">Grundstückgröße</option>
                            </select>
                        </div>

                        
                        <button type="submit" class="btn btn-info">Suche</button>
                    </div>

                </form>
            </div>

        </div>

        <?php
            // if(isset())
        ?>


    </div>

</div>
<!-- / Content -->

<?php include "components/default/pagebottom.php"; ?>