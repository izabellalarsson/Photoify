

      <?php if (!isset($_SESSION['user'])) :?>
          <div class="menu">
            <div class="brand">
              <a class="navbar-brand" href="index.php"><?php echo $config['title']; ?></a>
            </div>
          </div>

  <?php else : ?>
      <div class="menu">
          <div class="brand">
            <a class="navbar-brand" href="index.php"><?php echo $config['title']; ?></a>
          </div>
      <div class="toggle">
          <i class="fas fa-bars"></i>
      </div>
      <div class="toggle-close">
          <i class="fas fa-times"></i>
      </div>
  </div>

      <nav class="navbar">
          <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="/index.php">Home</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="/profile.php">Profile</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="/settings.php">Settings</a>
      </li>
      <li class="nav-item">
          <a href="./../app/users/logout.php"><input type="submit" class="nav-link logout" value="Logout" /></a>
          <!-- <button type="button" name="button" class="nav-link logout">Log Out</button> -->
      </li>
    <?php endif; ?>
  </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
