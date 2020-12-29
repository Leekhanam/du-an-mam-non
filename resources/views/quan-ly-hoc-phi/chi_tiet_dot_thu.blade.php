@extends('layouts.main') @section('title', "Quản lý khoản thu")
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<style>
    thead th,td {
        text-align: center;
        font-size: 12px
    }
     thead tr th{
        font-weight: bold !important
    }
    .quan_trong{
        font-weight: bold;
        color: red;
    }

    .dataTables_filter {
        display: none;
    }

    .chuc_nang i {
        cursor: pointer;
    }

    tbody td>.fa-check {
        color: #77d777
    }

    tbody td>.flaticon-circle {
        color: red
    }

    #form-add-khoan-thu label span {
        color: red
    }

    #form-edit-khoan-thu label span {
        color: red
    }
    .bat_buoc{
        color: red
    }
    .btn{
        font-family: Arial, Helvetica, sans-serif
    }
    /* .table{
        width: 120%;
  overflow-x: scroll !important;
    } */
    
</style>
<link href="{!! asset('vendors/perfect-scrollbar/css/perfect-scrollbar.css') !!}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="m-content">
    <!--Begin::Section-->
    <div class="row">
        <div class="col-xl-12">

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__body">
                    <div class="m-section m-section--last">
                        <div class="m-section__content">
                            <!--begin::Preview-->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="m-portlet__head justify-content-center">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title title_lap_dot_thu" data-toggle="modal"
                                                data-target="#modal_tao_dot_thu">
                                                <h3 class="m-portlet__head-text">
                                                    Đợt thu {{$dot_thu->thang_thu}}/{{$dot_thu->nam_thu}} -
                                                    {{$khoi_thu->ten_khoi}}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-demo">
                                        <div class="m-scrollable" data-scrollable="true" style="height: 400px">
                                        <div class="m-demo__preview">
                                            <div class="m-list-search">
                                                <div class="m-list-search__results">
                                                    @foreach ($dot_thu->ChiTietDotThuTien as $item)
                                                    <span
                                                        class="m-list-search__result-category m-list-search__result-category--first">
                                                        {{$item->ten_dot_thu}}
                                                    </span>
                                                    @foreach ($khoi_thu->LopHoc as $key => $chi_tiet_lop)
                                                    <div onclick="getThongTinDongTienLop({{$item->id}},{{$chi_tiet_lop->id}})"
                                                        class="m-list-search__result-item">
                                                        <span class="m-list-search__result-item-icon">
                                                            <label class="m-radio m-radio--state-success">
                                                                <input type="radio" name="example_2" value="1">{{$chi_tiet_lop->ten_lop}}
                                
                                                                <span></span>
                                                                
                                                            </label>
                                                            @if ($item->trang_thai_dong_tien[$key]['trang_thai'] == 1)
                                                            <button type="button" class="ml-4 btn m-btn m-btn--gradient-from-success m-btn--gradient-to-accent">{{$item->trang_thai_dong_tien[$key]['so_luong']}}</button>   
                                                            @else
                                                            <button type="button" class="ml-4 btn m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning">{{$item->trang_thai_dong_tien[$key]['so_luong']}}</button>
                                                            @endif
                                                        </span>
                                                     
                                                    </div>
                                                    @endforeach


                                                    @endforeach


                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="m-portlet__head d-flex justify-content-end">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <button type="button" id="button_chuyen_lop"
                                                    class="btn m-btn m-btn--gradient-from-success m-btn--gradient-to-accent mr-3"
                                                    onclick="changeValue()"
                                                    data-toggle="modal"
                                                    data-target="#thong_bao_theo_lop"
                                                    >Thông báo cho
                                                    PH</button>


                                                <button style="display: block;" type="button"
                                                    id="button_xep_lop_tu_dong" onclick="changeValue()"
                                                    data-toggle="modal" data-target="#dong_tien_theo_lop"
                                                    class="btn btn-secondary ">Học sinh đóng tiền</button>
                                            </div>
                                        </div>
                                    </div>
                                <div class="show_table table-responsive-xl m-scrollable m-scroller" data-scrollable="true" style="height: 400px;" >                     
                                 
                                </div>
                                </div>
                            </div>


                            <!--end::Preview-->

                        </div>
                    </div>
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div>
    <!--End::Section-->
</div>


     {{-- modal gửi thông báo theo khối --}}
     <div class="modal fade" id="thong_bao_theo_lop" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gửi thông báo (<span id="ten_dot_thu"></span>)</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" id="form_gui_thong_bao_theo_lop" method="post">
                    <div class="modal-body">
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Chọn học sinh <span
                                    class="bat_buoc">*</span></label>
                            <select name="danh_sach_hoc_sinh[]" multiple style="width: 100%;" id="danh_sach_hoc_sinh" class="form-control m-input m-input--square"
                                id="exampleSelect1">
                                {{-- @foreach ($nam_hoc_moi->Khoi as $item)
                                <option value="{{$item->id}}">{{$item->ten_khoi}}
                                </option>
                                @endforeach --}}
                            </select>
                        </div>
                        <input type="hidden" name="id_lop_chon" value="lop_id" id="id_lop_chon">
                        <input type="hidden" name="id_dot_chon" value="dot_id" id="id_dot_chon">

                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Thông báo thu tiền <span
                                        class="bat_buoc">*</span></label>
                                <select name="trang_thai_thong_bao" class="form-control m-input m-input--square"
                                    id="exampleSelect1">
                                    <option value="1">Thông báo thu tiền</option>
                                    <option value="2">Thông báo hủy thu tiền</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Dư kiến thu từ ngày
                                    <span class="bat_buoc">*</span></label>
                                <input name="ngay_bat_dau" type="date" class="form-control m-input"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Đến ngày <span
                                        class="bat_buoc">*</span></label>
                                <input name="ngay_ket_thuc" type="date" class="form-control m-input"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Đóng</button>
                        <button type="button" onclick="GuiThongBaoTheoLop()"
                            class="btn btn-primary">Gửi thông báo</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    {{-- end thông báo theo khối--}}

       {{-- modal hoàn thành học phí --}}
       <div class="modal fade" id="dong_tien_theo_lop" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hoàn thành học phí</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" id="form_dong_hoc_phi_theo_lop" method="post">
                    <div class="modal-body">
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Chọn học sinh <span
                                    class="bat_buoc">*</span></label>
                            <select name="danh_sach_hoc_sinh[]" multiple style="width: 100%;" id="danh_sach_hoc_sinh_dong_tien" class="form-control m-input m-input--square"
                                id="exampleSelect1">
                                {{-- @foreach ($nam_hoc_moi->Khoi as $item)
                                <option value="{{$item->id}}">{{$item->ten_khoi}}
                                </option>
                                @endforeach --}}
                            </select>
                        </div>
                        <input type="hidden" name="id_lop_chon" id="id_lop_chon_dong_tien">
                        <input type="hidden" name="id_dot_chon" id="id_dot_chon_dong_tien">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Đóng</button>
                        <button type="button" onclick="DaDongTien()"
                            class="btn btn-primary">Đã Đóng Tiền</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    {{-- end hoàn thành học phí--}}




@endsection
@section('script')
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{!! asset('vendors/perfect-scrollbar/dist/perfect-scrollbar.js') !!}" type="text/javascript"></script>
<script>
    $(document).ready( function () {
    $("body").addClass('m-aside-left--minimize m-brand--minimize')
    $("#danh_sach_hoc_sinh").select2()
    $("#danh_sach_hoc_sinh_dong_tien").select2()
    $('#danh_sach_nam_hoc_session').hide()
    
});


    const checkAll = (e) => {
        $(e).parents('table').find('.checkbox').not(e).prop('checked', e.checked);
    };
    const url_tao_dot_thu = "{{route('get-chi-tiet-dot-thu-theo-lop')}}";
    const url_gui_thong_bao_theo_lop = "{{route('gui-thong-bao-theo-lop')}}";
    const url_dong_hoc_phi_theo_lop = "{{route('dong-hoc-phi-theo-lop')}}";
    const route_huy_thu_tien = "{{route('huy-thu-tien',['id','chi_tiet_dot'])}}"

    const getThongTinDongTienLop =(dot,lop) =>{
        $('#id_lop_chon').val(lop)
        $('#id_dot_chon').val(dot)
        $('#id_lop_chon_dong_tien').val(lop)
        $('#id_dot_chon_dong_tien').val(dot)
     
    axios.post(url_tao_dot_thu,{
            'id_dot' : dot,
            'id_lop' : lop,
        }).then(function (response) {
            html_tieu_de= `
            <div class="">     
            <table class="table ">
            <thead>
            <tr>
                <th scope="row">
                    <label class="m-checkbox m-checkbox--success">
                        <input onclick ="checkAll(this)" type="checkbox"> 
                        <span></span>
                    </label>
                </th>
                <th>Thứ tự</th>
                <th>Mã học sinh</th>
                <th>Họ tên </th>
                <th>Tổng tiền</th>
            `

                response.data.khoan_thu_trong_dot.forEach(element => {
                    html_tieu_de+=`
                    <th>${element.ten_khoan_thu}</th>
                    `
                });

            html_tieu_de+=`
                <th>Đóng tiền</th>
                <th>Thông báo</th>
                <th>Hủy thu tiền</th>
                <th>Hóa đơn</th>
            </tr>
        </thead>
            `

            html_chi_tiet = '<tbody>'
            var thu_tu =1;
            response.data.khoan_thu_hoc_sinh.forEach(element => {
                var route_chi_tiet_hoc_sinh = "{{route('quan-ly-hoc-sinh-edit',['id'])}}"
                var route_chi_tiet_hoc_sinh_new = route_chi_tiet_hoc_sinh.replace('id',element.chi_tiet_hoc_sinh.id)
                if(element.trang_thai == 1){
                    html_trang_thai =`<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_chi_tiet${element.id}">Đã đóng</button>`
                }else{
                    html_trang_thai ='<i class="flaticon-circle"></i>'
                }

                if(element.thong_bao == 1){
                    html_thong_bao ='<i class="fa fa-check"></i>'
                }else{
                    html_thong_bao ='<i class="flaticon-circle"></i>'
                }


                html_chi_tiet +=`          
                    <tr>
                        <td scope="row">
                            <label  class="m-checkbox m-checkbox--success">
                                <input id_hs="${element.chi_tiet_hoc_sinh.id}" class="checkbox" type="checkbox"> 
                                <span></span>
                            </label>
                        </td>
                        <td scope="row">${thu_tu++}</td>
                        <td><a target="_blank"  href="${route_chi_tiet_hoc_sinh_new}">${element.chi_tiet_hoc_sinh.ma_hoc_sinh}</a></td>
                        <td>${element.chi_tiet_hoc_sinh.ten}</td>
  
                        <td class='quan_trong'>${element.so_tien_phai_dong.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")}</td>
                        `
                        var route_xuat_pdf_id ='' 
                        var route_xuat_pdf =''
                          response.data.khoan_thu_trong_dot.forEach(khoan_thu => { 
                                var check = 0;
                                route_xuat_pdf_id = "{{route('xuat-hoa-don-pdf',['id','chi_tiet_dot'])}}"
                                route_xuat_pdf = route_xuat_pdf_id.replace('id',element.chi_tiet_hoc_sinh.id).replace('chi_tiet_dot',dot)
  
                                // route_xuat_pdf = route_xuat_pdf_id.replace('id',khoan_thu.id)
                            element.chi_tiet_khoan_thu_hoc_sinh.forEach(chi_tiet_khoan_thu => {      
                                // console.log(khoan_thu.id, chi_tiet_khoan_thu.id_khoan_thu)
                                if(khoan_thu.id != chi_tiet_khoan_thu.id_khoan_thu){
                                    check++
                                }else{
                                    var so_tien = chi_tiet_khoan_thu.so_tien
                                }

                                if(check == element.chi_tiet_khoan_thu_hoc_sinh.length){
                                    html_chi_tiet +=` <td scope="row">0</td>`
                                }else if(khoan_thu.id == chi_tiet_khoan_thu.id_khoan_thu){
                                    html_chi_tiet +=`
                                         <td>${chi_tiet_khoan_thu.so_tien.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")}</td>
                                    `
                                } 
                            });
                        })
                        // console.log(element.nguoi_thu)
                        html_chi_tiet+=`
                        <td>${html_trang_thai}</td>
                        <td>${html_thong_bao}</td>
                        <td><input  class="btn m-btn--square" onclick="huyThuTien(${element.chi_tiet_hoc_sinh.id},${dot})"  btn-danger" type="reset" value="Hủy"></td>
                        <td><a target="_blank" href="${route_xuat_pdf}"><i class="flaticon-technology"></i></a></td>
                         </tr>

                         <div id="modal_chi_tiet${element.id}" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Thông tin thu</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<p>Người thu :${element.nguoi_thu} </p>
                                        <p>Thời gian thu tiền : ${element.thoi_gian_thu_tien}</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				
									</div>
								</div>

                            </div>
                            </div>

                        `
                    
            });
            html_chi_tiet+=`
                    </tbody>
                      </table>
                      </div>
                        `
             
            $('.show_table').html(html_tieu_de+html_chi_tiet)
            
            $('#ten_dot_thu').html(response.data.dot_thu.ten_dot_thu)

            getDanhSachHocSinhGuiThongBao(response.data.khoan_thu_hoc_sinh)
            })
            .catch(function (error) {
                console.log(error);
            })
    };

    const changeValue = () =>{
        var danh_sach_hoc_sinh =[]
        var check = document.querySelectorAll(".checkbox");
        for (let index = 0; index < check.length; index++) {
            if (check[index].checked) {
                id_hoc_sinh = check[index].getAttribute("id_hs");
                danh_sach_hoc_sinh.push(id_hoc_sinh)
            }
        }
        $('#danh_sach_hoc_sinh').val(danh_sach_hoc_sinh).trigger("change")
        $('#danh_sach_hoc_sinh_dong_tien').val(danh_sach_hoc_sinh).trigger("change")      
    }

    const GuiThongBaoTheoLop = () =>{
        let myForm = document.getElementById('form_gui_thong_bao_theo_lop');
        let formData = new FormData(myForm);
        axios.post(url_gui_thong_bao_theo_lop,formData)
            .then(function (response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Gửi thông báo thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                    ()=> location.reload()
                    )
            })
            .catch(function (error) {
                Swal.fire({
                    icon: 'error',
                    text: `Thời gian không hợp lệ`,
                }) 
            })
            .then(function () {
                // always executed
            });  
    };

    const getDanhSachHocSinhGuiThongBao =(data)=>{
        let html_danh_sach_hoc_sinh = `<option value = "0">Tất cả</option>`
        let html_danh_sach_hoc_sinh_dong_tien =''
        data.forEach(element => {
            html_danh_sach_hoc_sinh+=`
            <option value = "${element.chi_tiet_hoc_sinh.id}">${element.chi_tiet_hoc_sinh.ma_hoc_sinh+'-'+element.chi_tiet_hoc_sinh.ten}</option>
            `
            html_danh_sach_hoc_sinh_dong_tien+=`
            <option value = "${element.chi_tiet_hoc_sinh.id}">${element.chi_tiet_hoc_sinh.ma_hoc_sinh+'-'+element.chi_tiet_hoc_sinh.ten}</option>
            `
        });

        $('#danh_sach_hoc_sinh').html(html_danh_sach_hoc_sinh)
        $('#danh_sach_hoc_sinh_dong_tien').html(html_danh_sach_hoc_sinh_dong_tien)

        // $('#danh_sach_dot').html(html_danh_sach_dot)

    };
    
    const DaDongTien = () =>{
        let myForm = document.getElementById('form_dong_hoc_phi_theo_lop');
        let formData = new FormData(myForm);
        axios.post(url_dong_hoc_phi_theo_lop,formData)
            .then(function (response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Học sinh đóng tiền thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                    ()=> location.reload()
                )
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });  
    };

    const huyThuTien = (id_hs,dot)=>{
        Swal.fire({
            title: 'Bạn có hủy kết quả thu tiền học sinh này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý !'
            }).then((result) => {
                if(result.isConfirmed){
                    route_huy_thu_tien_id =  route_huy_thu_tien.replace('id',id_hs).replace('chi_tiet_dot',dot);
                    axios.get(route_huy_thu_tien_id)
                        .then(function (response) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Huy kết quả thu tiền thành công!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(
                                ()=> location.reload()
                            )
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });  
            }})
      
    };
</script>
@endsection
