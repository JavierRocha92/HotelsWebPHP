
<header class="header d-flex w-100 justify-content-center bg-body-tertiary">
    <nav class="navbar navbar-expand-lg bg-body-tertiary border w-100">
  <div class="container-fluid">
    <a class="navbar-brand me-5" href="<?= $_SERVER['PHP_SELF']. '?controller=Usuario&action=showForm' ?>">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-5" href="<?= $_SERVER['PHP_SELF']. '?controller=Hotel&action=listHotels' ?>">Hotels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-5" href="<?= $_SERVER['PHP_SELF']. '?controller=Reserva&action=listReservas' ?>">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-5" href="<?= $_SERVER['PHP_SELF']. '?controller=Usuario&action=emailForm' ?>">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>


