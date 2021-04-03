<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll">
            <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true"
                data-slide-speed="200">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="row">
                            <div class="sidebar-userpic"> Huyền Bon
                                <img src="assets/img/dp.jpg" class="img-responsive" alt=""></div>
                        </div>
                        <div class="profile-usertitle">
                            <div class="sidebar-userpic-name"> </div>
                            <div class="profile-usertitle-job"> </div>
                        </div>
                        <div class="sidebar-userpic-btn">
                            <a class="tooltips" href="user_profile.html" data-placement="top"
                                data-original-title="Profile">
                                <i class="material-icons">person_outline</i>
                            </a>
                            <a class="tooltips" href="login.html" data-placement="top" data-original-title="Logout">
                                <i class="material-icons">input</i>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="menu-heading">
                    <span>-- Main</span>
                </li>
                <li class="nav-item start active">
                    <a href=" {{route("admin.index")}}" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">Trang chủ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="material-icons">album</i>
                        <span class="title">Hóa đơn</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="view_booking.html" class="nav-link ">
                                <span class="title">Danh sách Hóa đơn</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="material-icons">business_center</i>
                        <span class="title">Hợp đồng</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="view_booking.html" class="nav-link ">
                                <span class="title">Danh sách hợp đồng</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="material-icons">vpn_key</i>
                        <span class="title">Phòng</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="all_rooms.html" class="nav-link ">
                                <span class="title">Danh sách Phòng</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="material-icons">group</i>
                        <span class="title">Khách hàng</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{route("customer.view")}}" class="nav-link ">
                                <span class="title">Danh sách khách hàng</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="material-icons">store</i>
                        <span class="title">Dịch vụ</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{route("service.view")}}" class="nav-link ">
                                <span class="title">Danh sách dịch vụ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("service.view")}}" class="nav-link ">
                                <span class="title">Dịch vụ điện</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("service.view")}}" class="nav-link ">
                                <span class="title">Dịch vụ nước</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>