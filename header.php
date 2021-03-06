<?php session_start(); ?>
<div class="navbar-fixed">
  <div class="above-nav"></div>
  <ul id="FS_Account" class="dropdown-content zpDropdown">
    <li><a href="account.php"><i class="material-icons left">account_circle</i>ACCOUNT</a></li>
    <li><a href="tracker.php"><i class="material-icons left">description</i>TRACKER</a></li>
    <li><a href="login.php?logout=true"><i class="material-icons left">error_outline</i>LOGOUT</a></li>
  </ul>
  <nav role="navigation">
      <div class="nav-wrapper navbar">
        <a href="#" class="brand-logo nav-logo">ZIGGERAUT PRIME</a>
        <ul id="nav" class="right hide-on-med-and-down">
          <li><a href="index.php" class="waves-effect waves-light nav-btn ">HOME</a></li>
          <li><a href="forum/" class="waves-effect waves-light nav-btn">FORUM</a></li>
          <li><a href="comic.php" class="waves-effect waves-light nav-btn ">COMIC</a></li>
          <!--<li><a href="abilities.php" class="waves-effect waves-light nav-btn">ABILITIES</a></li>
          <li><a href="equipment.php" class="waves-effect waves-light nav-btn">EQUIPMENT</a></li>-->
          <!--<li><a href="spells.php" class="waves-effect waves-light nav-btn">SPELLS</a></li>-->
          <?php if(!isset($_SESSION['username'])) echo '<li><a href="login.php" class="waves-effect waves-light nav-btn">LOGIN</a></li>';
                else echo '<li><a href="#!" class="dropdown-button nav-btn" data-activates="FS_Account">'.$_SESSION['username'].'</a></li>';
          ?>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse the-menu"><i class="material-icons">menu</i></a>
        <ul class="side-nav" id="nav-mobile">
          <li class="li-fill"><a href="index.php" class="waves-effect waves-light nav-btn ">HOME</a></li>
          <li class="li-fill"><a href="forum/" class="waves-effect waves-light nav-btn ">FORUM</a></li>
          <li class="li-fill"><a href="comic.php" class="waves-effect waves-light nav-btn ">COMIC</a></li>
          <!--<li class="li-fill"><a href="abilities.php" class="waves-effect waves-light nav-btn">ABILITIES</a></li>
          <li class="li-fill"><a href="equipment.php" class="waves-effect waves-light nav-btn">EQUIPMENT</a></li>
          
          <!--<li class="li-fill"><a href="spells.php" class="waves-effect waves-light nav-btn">SPELLS</a></li>-->
          <?php if(isset($_SESSION['username'])) echo '<li class="li-fill"><a href="tracker.php" class="waves-effect waves-light nav-btn">TRACKER</a></li>'; ?>
          <?php if(!isset($_SESSION['username'])) echo '<li class="li-fill"><a href="login.php" class="waves-effect waves-light nav-btn">LOGIN</a></li>';
                else echo '<li class="li-fill"><a href="login.php?logout=true" class="waves-effect waves-light nav-btn">LOGOUT</a></li>'; 
          ?>
        </ul>
      </div>
  </nav>
</div>
