<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
            <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
            <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
            <!-- <li class="nav-item"><a class="nav-link" href="nonCurrentAssetInfo.php"><i class="fas fa-table"></i><span>Non-Current Assets</span></a></li>
            
            <li class="nav-item"><a class="nav-link" href=""><i class="fas fa-table"></i><span>Non-Current Assets</span></a></li> -->
            
            <!-- Non-Current Assets Drop Down -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#nonCurrentAssets" role="button" aria-expanded="false" aria-controls="collapseExample" class="dropdown-toggle"><i class="fas fa-table"></i><span>Asset Management</span></a>
                <div class="collapse" id="nonCurrentAssets">
                    <ul class="navbar-nav text-light" id="nonCurrentAssets">
                        <li class="nav-item"><a class="nav-link" href="addNonCurrentAsset.php"><i class="fas fa-plus"></i> Add</a></li>
                        <li class="nav-item"><a class="nav-link" href="nonCurrentAssetInfo.php"><i class="fas fa-eye"></i> View/Dispose</a></li>                
                    </ul>
                </div>
             </li>

             <!-- Inventory Assets Drop Down -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#inventory" role="button" aria-expanded="false" aria-controls="collapseExample" class="dropdown-toggle"><i class="fas fa-table"></i><span>Inventory Management</span></a>
                <div class="collapse" id="inventory">
                    <ul class="navbar-nav text-light" id="nonCurrentAssets">
                        <li class="nav-item"><a class="nav-link" href="#"><i class="far fa-chart-bar"></i> Analytics</a></li>
                        <li class="nav-item"><a class="nav-link" href="manageInventory.php"><i class="fas fa-tasks"></i> Manage</a></li>                
                    </ul>
                </div>
             </li>

            <li class="nav-item"><a class="nav-link" href="login.php"><i class="far fa-user-circle"></i><span>Login</span></a></li>
            <li class="nav-item"><a class="nav-link" href="register.php"><i class="fas fa-user-circle"></i><span>Register</span></a></li>
            <li class="nav-item"><a class="nav-link" href="blank.php"><i class="fas fa-window-maximize"></i><span>Blank Page</span></a></li>
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>