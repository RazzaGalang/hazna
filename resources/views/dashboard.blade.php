<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-text mx-3">TokoBuku!</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Dashboard</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Product</h6>
                        </div>
                        <div class="card-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('berhasilhapus'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{session('berhasilhapus')}}
                                </div>
                            @endif

                            @if (session('berhasiltambah'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('berhasiltambah')}}
                                </div>
                            @endif

                            @if (session('berhasiledit'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{session('berhasiledit')}}
                                </div>
                            @endif


                            <a href="#" data-toggle="modal" data-target="#tambahProduct">
                                <button class="btn btn-success">
                                    Add Product
                                </button>
                            </a><p></p>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Product Description</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $product as $index => $p)
                                        <tr>
                                            <td>{{$p -> product_id}}</td>
                                            <td>{{$p -> product_name}}</td>
                                            <td>{{$p -> description}}</td>
                                            <td>{{$p -> price}}</td>
                                            <td>{{$p -> image}}</td>
                                            <td>
                                                <center>
                                                    <a href="#" data-toggle="modal" data-target="#editProduct{{$p->product_id}}" class="btn btn-warning btn-circle btn-sm">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                    </a>

                                                    <a href="#" data-toggle="modal" data-target="#hapusProduct{{$p ->product_id}}" class="btn btn-danger btn-circle btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>

                                        <!-- Hapus Modal-->
                                        <div class="modal fade" id="hapusProduct{{$p -> product_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Select "Delete" below if you are ready to delete the selected product.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <a class="btn btn-danger" href="dashboard/delete/{{$p ->product_id}}">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Modal-->
                                        <div class="modal fade" id="editProduct{{$p -> product_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>

                                                    <form action="/dashboard/edit/{{$p -> product_id}}" method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="label_name" class="form-label">Product Name</label>
                                                                <input type="text" class="form-control @error('add_product_name') is-invalid @enderror" name="add_product_name" placeholder="Enter the product name" value="{{ old('add_product_name', $p -> product_name)}}">
                                                                @error('add_product_name')
                                                                    <span class = "invalid-feedback">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="label_desc" class="form-label">Product Description</label>
                                                                <textarea class="form-control @error('add_description') is-invalid @enderror" name="add_description" rows="5">{{ old('add_description',  $p -> description)}}</textarea>
                                                                @error('add_description')
                                                                    <span class = "invalid-feedback">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="label_price" class="form-label">Price</label>
                                                                <input type="text" class="form-control @error('add_price') is-invalid @enderror" name="add_price" placeholder="Enter the product price" value="{{ old('add_price', $p -> price)}}">
                                                                @error('add_price')
                                                                    <span class = "invalid-feedback">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="label_image" class="form-label">Product Image</label>
                                                                <input type="file" class="form-control @error('add_image') is-invalid @enderror" name="add_image" value="{{ old('add_image', $p -> image)}}">
                                                                @error('add_image')
                                                                    <span class = "invalid-feedback">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-success" type="submit">Add Product</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <a href="{{ route('logout')}}" 
                        onclick="event.preventDefault();
                        this.closest('form').submit();"
                        class="btn btn-danger">
                        Logout    
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Modal-->
    <div class="modal fade" id="tambahProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="/dashboard/add" method="GET" enctype="multipart/form-data>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="label_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('add_product_name') is-invalid @enderror" name="add_product_name" placeholder="Enter the product name" value="{{ old('add_product_name')}}">
                            @error('add_product_name')
                                <span class = "invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="label_desc" class="form-label">Product Description</label>
                            <textarea class="form-control @error('add_description') is-invalid @enderror" name="add_description" rows="5">{{ old('add_description')}}</textarea>
                            @error('add_description')
                                <span class = "invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="label_price" class="form-label">Price</label>
                            <input type="text" class="form-control @error('add_price') is-invalid @enderror" name="add_price" placeholder="Enter the product price" value="{{ old('add_price')}}">
                            @error('add_price')
                                <span class = "invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="label_image" class="form-label">Product Image</label>
                            <input type="file" class="form-control @error('add_image') is-invalid @enderror" name="add_image" value="{{ old('add_image')}}">
                            @error('add_image')
                                <span class = "invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

</body>

</html>