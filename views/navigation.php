<div class="signout">
<h1>Are you sure to log out?</h1>
<a class="nav-link logout" href="./app/users/logout.php">Log Out</a>
<a class="nav-link logout" href="index.php">return</a>
</div>



<nav class="navbar">
  <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>

  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="./index.php">Home</a>
      </li><!-- /nav-item -->

      <li class="nav-item">
          <a class="nav-link" href="./about.php">About</a>
      </li><!-- /nav-item -->
      <?php if (!isset($_SESSION['user'])) :?>
      <li class="nav-item">
          <a class="nav-link" href="./login.php">Login</a>
      </li>
  <?php else : ?>
      <li class="nav-item">
          <a class="nav-link" href="./profile.php">Posts</a>
      </li>
      <li class="nav-item">
          <input type="submit" class="nav-link logout" value="logout" />
          <!-- <button type="button" name="button" class="nav-link logout">Log Out</button> -->
      </li>
    <?php endif; ?>
  </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->