<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?=SITE_WS_PATH . 'index.php'?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=SITE_WS_PATH . 'catalog.php'?>">Catalog</a>
          </li>
          <!--<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>-->
          <?php if (User::checkLogin()) {?>
            <?php if (User::checkAdminLogin()) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?=SITE_WS_PATH.'admin/index.php'?>">Admin Panel</a>
            </li>
            <?php }?>
            <li class="nav-item">
              <a class="nav-link" href="<?=SITE_WS_PATH . 'order-history.php'?>">Order History</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=SITE_WS_PATH . 'logout.php'?>">Logout</a>
            </li>
          <?php } else {?>
            <li class="nav-item">
              <a class="nav-link" href="<?=SITE_WS_PATH . 'login.php'?>">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=SITE_WS_PATH . 'register.php'?>">Register</a>
            </li>
          <?php }?>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
          <a class="btn btn-primary ms-3" href="<?=SITE_WS_PATH.'cart.php'?>">Cart</a>
        </form>
      </div>
    </div>
  </nav>
</header>