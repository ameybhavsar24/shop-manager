<nav class=" blue darken-4">
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo">ShopManager</a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
      <li><a href="sass.html">About</a></li>
    </ul>
  </div>
</nav>
<ul class="sidenav" id="mobile-demo">
  <li><?= $_SESSION['name'] ?></li>
  <li><a href="logout.php">Logout</a></li>
</ul>

