<div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{route('dashboard')}}" class="text-white">PPDB</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{route('dashboard')}}" class="text-white">PPDB</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ request()->is('dashboard*') ? 'active' : ''}}">
                            <a href="{{ route('dashboard')}}" class="text-white">
                                <i class="fas fa-fire"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="menu-header">Master</li>

                        <li class="{{ request()->is('siswa*') ? 'active' : ''}}">
                            <a href="{{ route('siswa.index')}}" class="text-white">
                                <i class="fas fa-boxes"></i>
                                <span>siswa</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('jurusan*') ? 'active' : ''}}">
                            <a href="{{ route('jurusan.index') }}" class="text-white">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>jurusan</span>
                            </a>
                        </li>

                       

                        <li class="menu-header">Setting</li>

                        <li class="{{ request()->is('user*') ? 'active' : ''}}">
                            <a href="#" class="text-white">
                                <i class="fas fa-boxes"></i>
                                <span>User</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('setting*') ? 'active' : ''}}">
                            <a href="#" class="text-white">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Setting</span>
                            </a>
                        </li>

                </aside>
            </div>