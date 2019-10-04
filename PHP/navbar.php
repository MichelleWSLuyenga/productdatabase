
  
    <div class="row">
        
       <nav class="navbar navbar-inverse navbar-expand-lg fixed-top">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">ALBEDO</a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-3">
              <ul class="nav navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="repair_order.php">Repair Order</a></li>
                    <li class="nav-item"><a class="nav-link" href="product.php">Product</a></li>
                    <li class="nav-item"><a class="nav-link" href="Customer.php">Customer</a></li>
                    <li class="nav-item"><a class="nav-link" href="master_repair.php">Master Repair</a></li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">Extra Info</a>
                        <ul class="dropdown-menu">
                             <li class="nav-item"><a class="nav-link" href="employee.php">Employee</a></li>
                             <li class="nav-item"><a class="nav-link" href="role.php">Role</a></li>
                             <li class="nav-item"><a class="nav-link" href="warranty.php">Warranty</a></li>
                             <li class="nav-item"><a class="nav-link" href="repair_location.php">Repair Location</a></li>
                             <li class="nav-item"><a class="nav-link" href="store.php">Store</a></li>
                        </ul>
                    </li>
                    <ul class="nav navbar-nav right">
                      <li><a><i class="fas fa-user"></i>
                        <?php if(!empty($_SESSION['name']))
                        { 
                          echo $_SESSION['name'];
                        } ?>
                      </a></li>
                      <li><a href="signout.php">Sign Out</a></li>
                    </ul>
                  </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container -->
        </nav><!-- /.navbar -->
        
    </div>

    <div class="container">
