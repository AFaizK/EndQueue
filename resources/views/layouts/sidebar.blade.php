<!--**********************************
    Sidebar start
***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li class="menu-title">ENDQUEUE</li>
            <li><a href="/dashboard">
                    <div class="menu-icon">
                        <img src="../assets/images/dashboard.png" width="24" height="24" alt="">
                    </div>
                    <span class="nav-text ml-2">Dashboard</span>
                </a>
            </li>
            </li>
            <li><a href="/pengunjung">
                    <div class="menu-icon">
                        <img src="../assets/images/user1.png" width="24" height="24" alt="">
                    </div>
                    <span class="nav-text ml-2">Pengunjung</span>
                </a>
            </li>
            </li>
            <li><a href="/instansi">
                    <div class="menu-icon">
                        <img src="../assets/images/company.png" width="24" height="24" alt="">
                    </div>
                    <span class="nav-text ml-2">Instansi</span>
                </a>
            </li>
            </li>
            <li><a href="/layanan">
                    <div class="menu-icon">
                        <img src="../assets/images/customer-service.png" width="24" height="24" alt="">
                    </div>
                    <span class="nav-text ml-2">Layanan</span>
                </a>
            </li>
            </li>
            <li><a href="/antrian">
                    <div class="menu-icon">
                        <img src="../assets/images/queue.png" width="24" height="24" alt="">
                    </div>
                    <span class="nav-text ml-2">Report antrian</span>
                </a>
            </li>
            </li>
            @role('Super Admin')
                <li><a href="/user">
                        <div class="menu-icon">
                            <img src="../assets/images/user.png" width="24" height="24" alt="">
                        </div>
                        <span class="nav-text ml-2">User</span>
                    </a>
                </li>
            @endrole


            </li>

        </ul>
    </div>
</div>

<!--**********************************
    Sidebar end
***********************************-->
