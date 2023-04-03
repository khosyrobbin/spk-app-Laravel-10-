<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('kriteria.index') }}" class="nav-link"><i class="far fa-heart"></i><span>Kriteria</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('indikator.index') }}" class="nav-link"><i class="far fa-heart"></i><span>Indikator</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('beasiswa.index') }}" class="nav-link"><i class="far fa-heart"></i><span>Beasiswa</span></a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                        class="far fa-clone"></i><span>Multiple Dropdown</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a href="#" class="nav-link">Not Dropdown Link</a></li>
                    <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Hover
                            Me</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                            <li class="nav-item dropdown"><a href="#"
                                    class="nav-link has-dropdown">Link 2</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="#" class="nav-link">Link 3</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
