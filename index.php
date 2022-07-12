  <?php include "components/default/pagetop.php"; ?>
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-12 mb-4 order-0">
        <div class="card">
          <div class="card-body">
            <a class="menu-link card-title mb-2">
              <i class="menu-icon tf-icons bx bx-coffee text-primary"></i>
              <div style="display: flex;align-items: center;">
                <h5 class="text-primary" style="margin: auto;">Willkommen</h5>
              </div>
            </a>
            <p class="mb-4">
              Sie befinden sich auf einer App von Daniel Kasper
            </p>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- PHP-Card -->
    <div class="row">
      <div class="col-lg-12 mb-4 order-0">
        <div class="card">
          <div class="card-body">

            <a class="menu-link card-title mb-2">
              <i class="menu-icon tf-icons bx bx-server text-primary"></i>
              <div style="display: flex;align-items: center;">
                <h5 class="text-primary" style="margin: auto;">Backend-Server</h5>
              </div>
            </a>

            <p class="mb-1">
              Umgesetzt mit der PHP-Version <?php echo phpversion(); ?>
            </p>


          </div>
        </div>
      </div>
    </div>

    <!-- MySQL-Card -->
    <div class="row">
      <div class="col-lg-12 mb-4 order-0">
        <div class="card">
          <div class="card-body">

            <a class="menu-link card-title mb-2">
              <i class="menu-icon tf-icons bx bx-data text-primary"></i>
              <div style="display: flex;align-items: center;">
                <h5 class="text-primary" style="margin: auto;">Database-Server</h5>
              </div>
            </a>

            <p class="mb-1">
              Umgesetzt mit der Version <?php echo getMySqlVersion(); ?>
            </p>


          </div>
        </div>
      </div>
    </div>

    <!-- Responsive-Design-Card -->
    <div class="row">
      <div class="col-lg-12  order-0">
        <div class="card">
          <div class="card-body">

            <a class="menu-link card-title mb-2">
              <i class="menu-icon tf-icons bx bx-devices text-primary"></i>
              <div style="display: flex;align-items: center;">
                <h5 class="text-primary" style="margin: auto;">Responsive Design</h5>
              </div>
            </a>

            <p class="mb-1">
              Umgesetzt mit der kostenlosen Bootstrap-Version "Sneat Admin Dashboard 1.0.0"
            </p>


          </div>
        </div>
      </div>
    </div>
 <!-- Environmentvariablen-Card -->
    <div class="row mt-4">
      <div class="col-lg-12 mb-4 order-0">
        <div class="card">
          <div class="card-body">

            <a class="menu-link card-title mb-2">
              <i class="menu-icon tf-icons bx bx-data text-primary"></i>
              <div style="display: flex;align-items: center;">
                <h5 class="text-primary" style="margin: auto;">Environmentvariablen</h5>
              </div>
            </a>
            <a href="info.php" class="btn btn-primary">Zur den PHP-Infos</a>

          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- / Content -->

  <?php include "components/default/pagebottom.php"; ?>