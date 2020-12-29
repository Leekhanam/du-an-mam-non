@extends('layouts.main')
@section('title', "Quản lý giáo viên")
@section('style')
<style>
    .paginate_button{
        /* background-color: red !important */
    }
    #myTable_filter{
        display: none;
    }
    
</style>
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="m-content">
    <div id="preload" class="preload-container text-center" style="display: none">
        <img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
      </div>
    <div class="m-portlet">
        
        <div class="m-portlet__body">
            
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-users"></i>Tất cả giáo viên (<span id="countAllGV">{{$countAllGV}}</span>)</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#m_tabs_3_2" onclick="GiaoVienChuaCoLop()"><i class="la la-user"></i>Giáo viên chưa có lớp ({{$countAllGVChuaCoLop}})</a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3" onclick="GiaoVienNghiDay()"><i class="la la-user-times"></i>Giáo viên thôi dạy (<span id="countAllGvTheoUserThoiDay">{{$countAllGvTheoUserThoiDay}}</span>)</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="m_tabs_3_1" role="tabpanel">
                    <div class="m-portlet__body table-responsive">
                        {{-- Thông báo --}}
                        <div id="thongbaokhoiphuc">
                       
                        </div>
                        <table id="myTable"  class="table table-striped- table-bordered table-hover table-checkable dataTable dtr-inline">
                            <thead>
                                <tr align="center">
                                    
                                    <th>STT</th>
                                    <th>Mã giáo viên</th>
                                    <th>Họ và tên</th>
                                    <th>Ảnh</th>
                                    <th>Khối</th>
                                    <th>Lớp</th>
                                    <th>Chức vụ</th>
                                    <th style="width:100px">Thôi dạy</th>
                                    <th style="width:100px">Chi tiết</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr align="center">
                                    
                                    <td scope="row"><input class="search1 form-control m-input" type="text" hidden></td>
                                    <td scope="row"><input class="search2 form-control m-input" style="width: 100px;" type="text"></td>
                                    <td scope="row"><input class="search3 form-control m-input" style="width: 100px;" type="text"></td>
                                    <td scope="row"><input class="search4 form-control m-input" type="text" hidden></td>
                                    <td scope="row"><input class="search5 form-control m-input" style="width: 100px;" type="text"></td>
                                    <td scope="row"><input class="search6 form-control m-input" style="width: 100px;" type="text"></td>
                                    <td scope="row">
                                        <select name="" id="" class="search7 form-control form-control-sm form-filter m-input" style="width: 100px">
                                            <option  value="">Chọn</option>
                                            <option  value="GV chính">GV chính</option>
                                            <option  value="GV phụ">GV phụ</option>
                                        </select>
                                    </td>
                                    <td scope="row"><input class=" form-control m-input" hidden style="width: 100px;"></td>
                                    <td scope="row"><input class=" form-control m-input" hidden style="width: 100px;"></td>
                                    
                                </tr>
                            </thead>
                            <tbody align="center">
                                @php
                                $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1)
                                @endphp
                                
                                @foreach ($data as $item)
                                <tr id="tr{{$item->id}}">
                                    
                                    <td scope="row">{{$i++}}</td>
                                    <td>{{$item->ma_gv}}</td>
                                    <td>{{$item->ten}}</td>
                                    @if ($item->anh == "")
                                    <td><img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png"
                                            height="75px" width="60px" alt=""></td>
                                    @else
                                    <td><img src="{{$item->anh}}" height="75px" width="60px" alt=""></td>
                                    @endif
                                    @if($item->ten_khoi == "")
                                    <td><span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">không có</span></td>
                                    @else
                                    <td>{{$item->ten_khoi}}</td>
                                    @endif
                                    @if($item->ten_lop == "")
                                    <td><span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">không có</span></td>
                                    @else
                                    <td>{{$item->ten_lop}}</td>
                                    @endif
                                    <td>
                                        @if($item->type == 0)<span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">không có</span> @endif
                                        @if($item->type == 1)GV chính @endif
                                        @if($item->type == 2)GV phụ @endif
                                        
                                    </td>
                                    <td>
                                        <a href="#" onclick="ThoiDay({{$item->id}})" class="btn btn-outline-dark m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                            <i class="fa fa-user-lock"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{route('quan-ly-giao-vien-edit', ['id' => $item->id])}}" class="btn btn-outline-dark m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                            <i class="fa fa-pen-alt"></i>
                                        </a>
                                    </td>
                                    

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                    <div class="m-portlet__body table-responsive alert_gv_chua_xep_lop">
                        <table id="myTable2"  class="table table-striped- table-bordered table-hover table-checkable dataTable dtr-inline table_chua_xep_lop">
                            <thead>
                                <tr align="center">
                                    
                                    <th>STT</th>
                                    <th>Mã giáo viên</th>
                                    <th>Họ và tên</th>
                                    <th>Ảnh</th>
                                    
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr align="center">
                                    
                                    <td scope="row"><input class="search_1 form-control m-input" type="text" hidden></td>
                                    <td scope="row"><input class="search_2 form-control m-input" style="width: 100px;" type="text"></td>
                                    <td scope="row"><input class="search_3 form-control m-input" style="width: 100px;" type="text"></td>
                                    <td scope="row"><input class="search_4 form-control m-input" type="text" hidden></td>
                                    
                                    
                                   
                                    <td scope="row"><input class=" form-control m-input" hidden></td>
                                    
                                </tr>
                            </thead>
                            <tbody id="giao-vien-chua-co-lop" align="center">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                    <div class="m-portlet__body table-responsive alert_thongbao">
                        
                        <table id="myTable3"  class="table table-striped- table-bordered table-hover table-checkable dataTable dtr-inline table_nghi_day">
                            <thead>
                                <tr align="center">
                                   
                                    <th>STT</th>
                                    <th>Mã giáo viên</th>
                                    <th>Họ và tên</th>
                                    <th>Ảnh</th>
                                    <th>Khôi phục</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr align="center">
                                   
                                    <td scope="row"><input class="search_1 form-control m-input" type="text" hidden></td>
                                    <td scope="row"><input class="search_2 form-control m-input" style="width: 100px;" type="text"></td>
                                    <td scope="row"><input class="search_3 form-control m-input" style="width: 100px;" type="text"></td>
                                    <td scope="row"><input class="search_4 form-control m-input" type="text" hidden></td>
                                    <td scope="row"><input class=" form-control m-input" hidden></td>
                                    <td scope="row"><input class=" form-control m-input" hidden></td>
                                    
                                </tr>
                            </thead>
                            <tbody id="giao-vien-thoi-day" align="center">
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
      
    </div>


</div>
@endsection
@section('script')
<script src="{!! asset('assets/demo/custom/crud/forms/widgets/bootstrap-switch.js') !!}" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $('.select2').select2();
    });
    var url_chi_tiet_gv = "{{route('quan-ly-giao-vien-edit', ['id'])}}"
    var url_get_all_giao_vien_chua_co_lop= "{{route('quan-ly-get-all-giao-vien-chua-lop')}}"
    var url_destroy_gv = "{{route('quan-ly-giao-vien-destroy')}}"
    var url_get_lop_theo_khoi = "{{route('quan-ly-giao-vien-get-lop-theo-khoi')}}"
    var url_get_all_giao_vien_nghi_day = "{{route('quan-ly-giao-vien-nghi-day')}}"
    var url_thoi_day_cho_giao_vien = "{{route('quan-ly-giao-vien-thoi-day-cho-giao-vien')}}"
    var url_khoi_phuc_giao_vien = "{{route('quan-ly-giao-vien-khoi-phuc-thoi-day')}}"
    
    $("#khoi").change(function(){
        $('#preload').css('display','block')
        axios.post(url_get_lop_theo_khoi, {
            id:  $("#khoi").val(),
        }).then(function(response){
            var data_html = '<option value="0" selected  >Chọn lớp</option>'
            response.data.forEach(element => {
                data_html+=`<option value="${element.id}" >${element.ten_lop}</option>`
            });
        $('#preload').css('display','none')
        $('#lop').html(data_html)
        }).catch(function (error) {
            console.log(error);
        });
    })
    if(localStorage.getItem('thongbao')){
        var thongbao = 
        `<div class="m-alert m-alert--outline m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </button>
            <strong>Khôi phục thành công!</strong> Giáo viên đã được khôi phục lại và hiện tại chưa được xếp lớp
        </div>`
        $('#thongbaokhoiphuc').html(thongbao)
        localStorage.removeItem('thongbao')
    }
</script>
<script>
$(document).ready( function () {
    var dtable = $('#myTable').DataTable(
        {
        "aoColumnDefs": [
            { 
                "bSortable": false,
                // // "aTargets": [ 0, 7],
                // "lengthChange": false
                
                
            }, 
         ]
         }
    );
    $('.search1').on('keyup change', function() {
    dtable
    .column(0).search(this.value)
    .draw();
    });

    $('.search2').on('keyup change', function() {
    dtable
    .column(1).search(this.value)
    .draw();
    });

    $('.search3').on('keyup change', function() {
    dtable
    .column(2).search(this.value)
    .draw();
    });

    $('.search4').on('keyup change', function() {
    dtable
    .column(3).search(this.value)
    .draw();
    });
    $('.search5').on('keyup change', function() {
    dtable
    .column(4).search(this.value)
    .draw();
    });

    $('.search6').on('change', function() {
    dtable
    .column(5).search(this.value)
    .draw();
    });

    $('.search7').on('keyup change', function() {
    dtable
    .column(6).search(this.value)
    .draw();
    });

    $('.search8').on('keyup change', function() {
    dtable
    .column(7).search(this.value)
    .draw();
    });

});
$(".dataTable").on("draw.dt", function (e) {                    
    setCustomPagingSigns.call($(this));
}).each(function () {
    setCustomPagingSigns.call($(this)); // initialize
});


// this should work with standard datatables styling - li.previous/li.next
function setCustomPagingSigns() {
    var wrapper = this.parent();
    wrapper.find("li.previous > a").text("<");
    wrapper.find("li.next > a").text(">");          
}

//  - a.previous/a.next
function setCustomPagingSigns() {
    var wrapper = this.parent();
    wrapper.find("a.previous").text("<");
    wrapper.find("a.next").text(">");           
}

// this one works with complex headers example, bootstrap style
function setCustomPagingSigns() {
    var wrap = this.closest(".dataTables_wrapper");
    var lastrow= wrap.find("div.row:nth-child(3)");
    lastrow.find("li.previous>a").text("<");
    lastrow.find("li.next>a").text(">");    
}
const checkAll = (e) => {
    $(e).parents('table').find('.checkbox').not(e).prop('checked', e.checked);
  };
function GiaoVienChuaCoLop(){
    $('#preload').css('display', 'block');
    axios.post(url_get_all_giao_vien_chua_co_lop).then(function(response){
        var data = response.data
        var html = ""
        var i = 1
        if(data.length > 0){
            data.forEach(element => {
                url_chi_tiet_gv_new = url_chi_tiet_gv.replace('id', element.id) 
                if(element.type == 1){
                    element.type = "GV chính"
                }
                else{
                    element.type = "GV phụ"
                }
                html+=
                `
                <tr>
            
                <td>${i++}</td>
                <td>${element.ma_gv}</td>
                <td>${element.ten}</td>
                <td><img src="${element.anh}" height="75px" width="60px" alt=""></td>
            
                <td>
                <a href="${url_chi_tiet_gv_new}" class="btn btn-outline-dark m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                <i class="fa fa-pen-alt"></i>
                </a>
                </td>
                </tr>
                
                `
            })
            $('#giao-vien-chua-co-lop').html(html);
        }
        $('#preload').css('display', 'none');
    })
}
function GiaoVienNghiDay(){
    $('#preload').css('display', 'block');
    axios.post(url_get_all_giao_vien_nghi_day).then(function(response){
        var data = response.data
        var html = ""
        var i = 1
    if(data.length > 0){
        data.forEach(element => {
            url_chi_tiet_gv_new = url_chi_tiet_gv.replace('id', element.id)
            if(element.type == 1){
                element.type = "GV chính"
            }
            else{
                element.type = "GV phụ"
            }
            
            
            html+=
            `
            <tr>

            <td>${i++}</td>
            <td>${element.ma_gv}</td>
            <td>${element.ten}</td>
            <td><img src="${element.anh}" height="75px" width="60px" alt=""></td>
            <td>	
                <a href="#" onclick="ThayDoiTrangThaiGV(${element.id})" class="btn btn-outline-dark m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                    <i class="fa fa-lock-open"></i>
                </a>
            </td>
            <td>
                <a href="${url_chi_tiet_gv_new}" class="btn btn-outline-dark m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                <i class="fa fa-pen-alt"></i>
                </a>
            </td>
            </tr>
            
            `
        })
        $('#giao-vien-thoi-day').html(html);
    }
    
        $('#preload').css('display', 'none')
    })
    
}
function ThoiDay(id){
    Swal.fire({
  title: 'Thôi dạy?',
  text: "Bạn có chắc chắn thôi dạy giáo viên này ?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Thôi dạy',
  cancelButtonText: "Đóng"
}).then((result) => {
  if (result.value == true) {
    axios.post(url_thoi_day_cho_giao_vien, {gv_id: id})
    var countAllGV = Number($('#countAllGV').text()) - 1
    var countAllGvTheoUserThoiDay = Number($('#countAllGvTheoUserThoiDay').text()) + 1
    $('#countAllGV').html(countAllGV)
    $('#countAllGvTheoUserThoiDay').html(countAllGvTheoUserThoiDay)
    $('#tr'+id).remove();
  }
})
}

function ThayDoiTrangThaiGV(id){
    Swal.fire({
        title: 'Khôi phục lại ?',
        text: "Bạn có chắc chắn khôi phục lại giáo viên này ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Khôi phục',
        cancelButtonText: "Đóng"
    }).then((result) => {
        if (result.value) {
            $('#preload').css('display','block')
                axios.post(url_khoi_phuc_giao_vien,{
                    id: id
            }).then(function(response){
                localStorage.setItem('thongbao', '1')
                location.reload()
            })
        }
    })
}
</script>
@if(SESSION('thong_bao'))
<script>
    Swal.fire({
    position: 'top-center',
    icon: 'success',
    title: 'Thêm mới giáo viên và cấp tài khoản thành công!',
    showConfirmButton: false,
    timer: 1500
    })
</script>
@endif
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> 
@endsection
