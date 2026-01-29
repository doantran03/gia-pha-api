<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">THÀNH VIÊN</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMembers" aria-expanded="false" aria-controls="collapseMembers">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Thành viên
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseMembers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('members.index') }}">Tất cả thành viên</a>
                        <a class="nav-link" href="{{ route('members.create') }}">Thêm thành viên</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">BÀI VIẾT</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePosts" aria-expanded="false" aria-controls="collapsePosts">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Bài viết
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePosts" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('posts.index') }}">Tất cả bài viết</a>
                        <a class="nav-link" href="{{ route('posts.create') }}">Thêm bài viết</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">SỰ KIỆN</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEvents" aria-expanded="false" aria-controls="collapseEvents">
                    <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                    Sự kiện
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseEvents" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('events.index') }}">Tất cả sự kiện</a>
                        <a class="nav-link" href="{{ route('events.create') }}">Thêm sự kiện</a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>