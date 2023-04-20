<nav class="navbar navbar-expand-lg bg-dark"  data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="<?=SITE_WS_PATH?>">Home</a>
        <a class="nav-link" href="<?=SITE_WS_PATH.'admin/category/category.php'?>">Categories</a>
        <a class="nav-link" href="<?=SITE_WS_PATH.'admin/product/product.php'?>">Products</a>
        <a class="nav-link" href="#">Orders</a>
        <a class="nav-link" href="#">Users</a>
        <a class="nav-link" href="<?=SITE_WS_PATH.'logout.php'?>">Logout</a>
      </div>
    </div>
  </div>
</nav>