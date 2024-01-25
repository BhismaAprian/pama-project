        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a href="/" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-144-layout"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                    @auth
                    <li class="nav-label">Managemen</li>
                    
                        <li><a href="{{ route('rooms.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-077-menu-1"></i>
                                <span class="nav-text">Room Management</span>
                            </a>
                        </li>
                        <li><a href="{{ route('attributes.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-settings-2"></i>
                                <span class="nav-text">Attribut Management</span>
                            </a>
                        </li>
                    @endauth


                    <li class="nav-label">Peminjaman</li>
                    <li><a href="{{ route('reservation.index') }}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-044-file"></i>
                            <span class="nav-text">Pinjam Ruangan</span>
                        </a>
                    <li><a href="{{ route('history.index') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-049-copy"></i>
                        <span class="nav-text">History Pinjaman</span>
                    </a>

                    
                </ul>
                <div class="copyright">
                    <p><strong>Pama Admin Dashboard</strong> © 2024 All Rights Reserved</p>
                    <p class="fs-12">Made with <span class="heart"></span> by DexignZone</p>
                </div>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
