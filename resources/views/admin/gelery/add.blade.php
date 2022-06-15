@extends('templates.admin.master')
@section('main-content')
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form method="post" action="javascript:void(0)" entype="multipart/form-data"
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Xin chào &nbsp;
                    <span style="font-weight: 700; color:black !important ;">phan hoàng vũ&nbsp;</span>
                    <img class="img-profile rounded-circle"
                        src="https://anhdep123.com/wp-content/uploads/2020/05/hinh-dai-dien-nam.jpg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="/admin/auth/logout.php" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>

    </nav>
    <!-- End of Topbar -->
    <div class="container-fluid">
         <!-- Page Heading -->
        <div class="wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Thêm slide hình ảnh  sản phẩm</h1>
            </div>


                    <form action="" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="file" name="picture[]" accept="image/*" class="form-control" placeholder="Chọn ảnh"  multiple required/>
                                <p class="help is-danger">{{ $errors->first('picture') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info">Up ảnh</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Hình ảnh sản phẩm</h4>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2 text-right" >
                            <button type="button" class="btn btn-info" id="delete-pic-ajax">Xóa hình ảnh</button>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="table-responsive" id="list-picture">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr >
                                        <th width="120px" class="text-center">ID</th>
                                        <th >Tên sản phẩm</th>
                                        <th width="140px" class="text-center">Hình ảnh</th>
                                        <th width="180px" class="text-center">
                                            <div class="checkbox" >
                                                <input  type="checkbox" name="hinhanh" id="checkall" class="" value=""/>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($objGelerys as $item)
                                    @php
                                        $pic = $item->picture;
                                        $namePro = $item->Product->name;
                                        $idpic = $item->id;
                                    @endphp
                                    <tr  class="gradeX" >
                                        <td class="text-center">{{$idpic}}</td>
                                        <td >{{$namePro}}</td>
                                        <td class="text-center" ><img src="storage/files/{{$pic}}" alt="" width="100px"></td>
                                        <td class="text-center">
                                            <div class="checkbox">
                                                <input type="checkbox" name="hinhanh" class="idpic-product" class="" value="{{$idpic}}" />
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- phân trang  -->
                            <!-- dừng -->
                            <div class="row">
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        {{$objGelerys->appends(request()->all())->links()}}
                                    </div>
                                </div>
                            </div>
                        <!-- kết thúc phân trang -->
                      </div>
                    </div>
                    </form>

        </div>

    </div>
    <script>
        $('#checkall').change(function(){
            if(this.checked){
                $("#dataTables-example input").each(function(){
                    $(this).attr('checked',true);
                })
            }else{
                $("#dataTables-example input").each(function(){
                    $(this).attr('checked',false);
                })
            }
        });
        $('#delete-pic-ajax').click(function(){
            $("#dataTables-example > tbody input:checked").each(function(){
                var _idpic = $(this).val();
                var _idPro = '{{$id}}';
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    type: "post",
                    url: "{{Route('admin.gelery.delete',['id'=>$id])}}",
                    data: {
                        idpic:_idpic,
                        _token:_token,
                        idpro:_idPro
                    },
                    success: function (data) {
                        // console.log(data);
                        $('#list-picture').html(data);
                    },
                    error:function(data){
                        console.log('Đã có lỗi xảy ra');
                    },
                });
            });
        });
    </script>
    <br>
    @endsection
