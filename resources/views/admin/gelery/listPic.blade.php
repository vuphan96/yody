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
                    <input type="checkbox" name="hinhanh" class="idpic-product" class="" value="{{$idpic}}"/>
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
