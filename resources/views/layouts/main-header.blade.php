        <!--=================================
 header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="#"><img src="{{ asset('assets/home/imgs/logo.png') }}"
                        alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-icon-dark.png"
                        alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>

            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">


                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-language"></i>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">



                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a rel="alternate"class="dropdown-item" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach


                    </div>
                </li>
                @if (auth()->guard('admin')->check())
                    <li class="nav-item dropdown mr-30">
                        <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('images/admins/' . Auth::user()->img) }}" alt="avatar">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                                        <span>{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <a class="dropdown-item" href="{{ route('Adminlogout') }}"><i
                                    class="text-danger ti-unlock"></i>{{ __('Logout') }}</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown mr-30">
                        <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('images/doctors/' . Auth::user()->img) }}" alt="avatar">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                                        <span>{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('doctor.profile.index') }}"><i
                                    class="text-warning ti-user"></i>الملف الشخصي</a>
                            <a class="dropdown-item" href="{{ route('doctor.logout') }}"><i
                                    class="text-danger ti-unlock"></i>{{ __('Logout') }}</a>
                        </div>
                    </li>
                @endif

            </ul>
        </nav>

        <!--=================================
 header End-->
