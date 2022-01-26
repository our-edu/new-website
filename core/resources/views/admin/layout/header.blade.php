<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Education Automatic Payment </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('admin/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('admin/')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/')}}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
@include('sweetalert::alert')

<!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">الرئيسيه</a>
            </li>

        </ul>

        <!-- Right navbar links -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{asset('admin/')}}/index3.html" class="brand-link">
            <img src="{{asset('admin/')}}/logo/logo.svg" alt="Our Edu" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Our Education</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="{{route('articles.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                المقالات
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('books.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                الكتب
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('events.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                الانشطه والفاعليات
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('videos.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                الفيديوهات
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('galleries.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                الصور
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('researches.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                الدراسات والبحوث
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('pages.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                الملف الشخصي
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('ContactUs')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                اتصل بنا
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('unisharp.lfm.show')."?type=image"}}"  class="nav-link" target="_blank">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                             معرض الصور
                            </p>
                        </a>
                    </li>


                    <br>



                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <button  class="nav-link btn-link btn-flat btn-warning ">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                              Log Out
                            </p>
                        </button>
                        </form>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>