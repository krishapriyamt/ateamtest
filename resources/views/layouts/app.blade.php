<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>User Management</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/friendRequest.js') }}"></script>

</head>
<body>
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <!-- <img src="{{ asset('assets/img/logo/logo2.png') }}"> -->
                </div>
                <div class="sidebar-brand-text mx-3">User Management</div>
            </a>
            <hr class="sidebar-divider my-0">
             
                <li class="nav-item active">
                   
                </li>
              
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/user') }}"  >
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/myfriends') }}"   >
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Friends</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/getfriendrequest') }}"  >
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Requested List</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('/sendrequestlist') }}"  >
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Request Sent</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
            </ul>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="navbar-nav ml-auto">
                            
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if(Auth::user()->profile_image)
                                        @php $file = Auth::user()->profile_image; 
                                             $extension = explode('.',$file);
                                        @endphp
                                        <img class="img-profile rounded-circle" src="{{url('storage/profileImage/userphoto'.Auth::user()->id.'.'.$extension[1])}}" style="max-width: 60px">
                                    @else
                                        <img class="img-profile rounded-circle" src="https://via.placeholder.com/150" style="max-width: 60px">
                                    @endif
                                    <span class="ml-2 d-none d-lg-inline   small">{{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ url('/profile_edit') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    @yield('content')
                </div>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; 
                                <script> document.write(new Date().getFullYear()); </script>
                            </span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Page level custom scripts -->
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable(); // ID From dataTable
                //$('#dataTableHover').DataTable(); // ID From dataTable with Hover
                $(".datePicker").datepicker();
            });

         
        </script>
    </body>
</html>
