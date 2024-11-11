<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->

                    <li>
                        <a href="{{ route('dashboard') }}"><i class="ti-home"></i><span
                                class="right-nav-text">{{ __('Dashboard') }}</span></a>
                    </li>


                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title"> {{ __('Components') }} </li>
                    <li>
                        <a href="{{ route('schedules.index') }}"><i class="ti-calendar"></i><span
                                class="right-nav-text">{{ __('Schedule') }}</span> </a>
                    </li>
                    <li>
                        <a href="{{ route('Admincontact.index') }}"><i class="fa fa-comment"></i><span
                                class="right-nav-text">{{ __('Contacts') }}</span> </a>
                    </li>

                    <li>
                        <a href="{{ route('adminServices.index') }}"><i class="ti-briefcase"></i><span
                                class="right-nav-text">{{ __('Services') }}</span></a>
                    </li>

                    <li>
                        <a href="{{ route('adminReservations.index') }}"><i class="ti-shopping-cart-full"></i><span
                                class="right-nav-text">{{ __('Reservations') }}</span></a>
                    </li>

                    <li>
                        <a href="{{ route('AdminStatus.index') }}"><i class="ti-user"></i><span
                                class="right-nav-text">{{ __('User Statuses') }}</span></a>
                    </li>
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title"> {{ __('Users') }} </li>

                    <li>
                        <a href="{{ route('admins.index') }}"><i class="ti-user"></i><span
                                class="right-nav-text">{{ __('Admins') }}</span></a>
                    </li>


                    <li>
                        <a href="{{ route('doctors.index') }}"><i class="ti-user"></i><span
                                class="right-nav-text">{{ __('Doctors') }}</span></a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span
                                class="right-nav-text">{{ __('Users') }}</span></a>
                    </li>



                </ul>
                </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
