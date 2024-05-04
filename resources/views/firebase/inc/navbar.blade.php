
<nav class="sb-topnav navbar navbar-expand navbar-light" style="background-color: #7d52a0; color: white;">
    <a class="navbar-brand ps-3" href="index.html" style="font-family: 'Montserrat', sans-serif; color: white;">GraDian</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" style='color: white;' id="sidebarToggle" href="#!"><i class="fas fa-bars fa-lg"></i></button>
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style='color: white;'><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" style="background-color:  white; font-size:0.9375rem;  font-family: 'Open Sans', sans-serif;"  id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Home</div>
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house" style="color: #b89bd7;"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Menu Penyiraman</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-droplet blue-icon"></i></div>
                            Penyiraman Air
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/penyiraman">Monitoring dan Controlling Penyiraman Air</a>
                                <a class="nav-link" href="/riwayatsiram">Data Suhu dan Kelembapan</a>
                                <a class="nav-link" href="/riwayatpenyiraman">Histori Penyiraman Air</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-droplet negative-icon"></i></div>
                            Penyiraman Pestisida
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/obat">Controlling Penyiraman Pestisida dan Fungisida</a>
                                <a class="nav-link" href="/riwayatobat">History Penyiraman Pestisida dan Fungisida</a>
                                <a class="nav-link" href="/jadwal">Penjadwalan Penyiraman Pestisida dan Fungisida</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Menu Penyinaran</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts3">
                            <div class="sb-nav-link-icon"><i class="fas fa-lightbulb sinar"></i></div>
                            Penyinaran UV
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/penyinaran">Monitoring dan Controlling Penyinaran UV</a>
                                <a class="nav-link" href="/riwayatldr">Data Intensitas Cahaya</a>
                                <a class="nav-link" href="/riwayatpenyinaran">Histori Penyinaran UV</a>
                            </nav>
                        </div>
                    </div>
                </div> 
            </nav>
        </div>
        <div id="layoutSidenav_content" style="background-color: #f8f9fa">