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
        
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#reports" role="button" aria-expanded="false" aria-controls="collapseExample" class="dropdown-toggle"><i class="fas fa-table"></i><span> Reporting</span></a>
                <div class="collapse" id="nonCurrentAssets">
                    <ul class="navbar-nav text-light" id="reports">
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-plus"></i> Make a report</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-eye"></i> View previous reports</a></li>                        
                    </ul>
                </div>
             </li>             

            <li class="nav-item"><a class="nav-link" href="#"><i class="far fa-user-circle"></i><span> Stock usage</span></a></li>
            
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>