<style type="text/css">
  nav li{
    font-family: 'Oswald', sans-serif;
    font-size:17px; 
    letter-spacing:0.8px;
    cursor: pointer;
  }  
</style>

<nav class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
        </button>
    </div>
  <div class="container-fluid" id="nav1">
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
              <li>
                  <a href="home.php">Home</a>
              </li>

                  <li>
                  <a href="accounting.php">Accounting</a>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">Orders
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="orders.php">Orders</a></li>
                  <li class="divider"></li>
                  <li><a href="ordersproccessed.php">Delivered Orders</a></li>
                  <li class="divider"></li>
                  <li><a href="ordersnotproccessed.php">Rejected Orders</a></li>
                </ul>
              </li>
              
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">Recipe
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="recipe.php">View Recipe</a></li>
                  <li class="divider"></li>
                  <li><a href="recipeaddnew.php">Add New Recipe</a></li>
                  <li class="divider"></li>
                  <li><a href="http://groctaurantretail.com/json/" target="_blank">Test JSON</a></li>
                  <li class="divider"></li>
                  <li><a href="webrecipes.php" target="_blank">Web Recipe</a></li>
                  <li class="divider"></li>
                  <li><a href="process.php" target="_blank">Ing Process</a></li>
                </ul>
              </li>
              
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">Merchants
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="merchant.php">View Merchnats</a></li>
                  <li class="divider"></li>
                  <li><a href="merchantaddnew.php">Add New Merchant</a></li>
                  <li class="divider"></li>
                  <li><a href="merchantapps.php">Merchant Apps</a></li>
                </ul>
              </li>
              <li>
                  <a href="notifications.php">Notifications</a>
              </li>
              <li>
                  <a href="logout.php">Logout</a>
              </li>
          </ul>
      </div>
  </div>
</nav>
