@extends('layouts.main')
@section('title', "Quản lý sức khỏe")
@section('style')
<style>
  .thong-tin-hoc-sinh-cua-lop {
    font-size: 11px
  }

  .thong-tin-hoc-sinh-cua-lop th,
  .thong-tin-hoc-sinh-cua-lop td {
    padding: 0.22rem !important;
  }

  .search {
    padding: 0.35rem 0.8rem !important;
    height: 25px;
  }

  .style-button {
    padding: 0.45rem 1.15rem;
  }

  .thong-tin-hoc-sinh-cua-lop thead th {
    border: 1px solid #f4f5f8 !important;
  }

  th[rowspan='2'] {
    text-align: center;
    line-height: 50px;
  }

  .btn {
    font-family: Arial, Helvetica, sans-serif
  }

  .scoll-table {
    height: 440px;
    overflow: auto;
  }

  .bottom {
    position: fixed;
    bottom: 50px;
  }

  table.dataTable thead td {
    border-bottom: 1px solid #d1cccc;
  }

  #table-hoc-sinh_wrapper>.row:first-child {
    display: none;
  }

  .danh-sach-khoi-lop .m-accordion__item-title,
  .m-accordion__item-mode,
  .m-dropdown__content ul li span {
    color: black;
    font-size: 12px !important;
  }

  .danh-sach-khoi-lop .m-accordion__item {
    color: black;

    border-bottom: 1px solid #eee5e5 !important;
    margin-bottom: 0rem !important
  }

  .la-plus {
    font-size: 20px;
    font-weight: bold;
    color: #19be19;
    cursor: pointer;
  }

  .m-accordion .m-accordion__item .m-accordion__item-head {
    padding: 0.5rem 1rem;
  }

  .collapsed {
    position: relative;
  }

  .la-ellipsis-v:hover .dropdown__wrapper {
    display: block !important;
  }

  .m-nav .m-nav__item>.m-nav__link .m-nav__link-text {
    width: 85% !important;
  }

  .m-accordion .m-accordion__item {
    overflow: visible !important;
  }

  .m-accordion .m-accordion__item .m-accordion__item-head {
    overflow: visible !important;
  }

  .chuc-nang-lop {
    margin-bottom: 0px !important;
  }

  .thong-tin-xep-lop {
    padding: 0.2rem 2.2rem !important
  }

  .error {
    color: red;
  }

  .lop_hoc .m-nav__link {
    padding: 5px 0px !important
  }

  .lop_hoc .m-nav__link-text {
    padding-left: 23px !important;
  }
</style>
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> --}}
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="m-content">
  <div id="preload" class="preload-container text-center" style="display: none">
    <img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
  </div>
  <div class="m-portlet">
    <div class="m-portlet__body row ">
      <div class="col-md-3 danh-sach-khoi-lop">
        <div class="m-portlet m-portlet--full-height">
          <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                <div class="row">
                  <h4 class="m-portlet__head-text col-md-10">
                    Năm học: {{$namhoc->name}} <input type="hidden" name="" id="nam_hoc" value="{{$namhoc->id}}">
                  </h4>
                  
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="m-portlet__body"> --}}
            {{-- Modal năm học --}}
            <div class="modal fade show" id="modal-kiem-tra" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kết quả kiểm tra đợt mới nhất</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="noi-dung-ket-qua-kiem-tra">
                         Đang kiểm tra ... 
                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-dismiss="modal">Đóng</button>

                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal năm học --}}
          <!--begin::Section-->
          <div
            class="m-accordion m-accordion--default m-accordion--solid m-accordion--section  m-accordion--toggle-arrow"
            id="" role="tablist">
            <!--begin::Item-->
            <div id="danh_sach_khoi_lop">
              @foreach ($namhoc->Khoi as $item)
              <div class="m-accordion__item ">
                <div class="m-accordion__item-head collapsed" role="tab" id="tab{{$item->id}}_item_1_head"
                  data-toggle="collapse" href="#tab{{$item->id}}_item_1_body" aria-expanded="false">
                  <span class="m-accordion__item-mode "></span>&nbsp;&nbsp;&nbsp;&nbsp;
                  <span class="m-accordion__item-title">{{$item->ten_khoi}} ({{config('common.do_tuoi')[$item->do_tuoi]}})</span>
                </div>
                <div class="m-accordion__item-body collapse" id="tab{{$item->id}}_item_1_body" role="tabpanel"
                  aria-labelledby="tab{{$item->id}}_item_1_head">
                  <div class="">
                    <div class="m-dropdown__wrapper">
                      <span class="m-dropdown__arrow m-dropdown__arrow--left"></span>
                      <div class="m-dropdown__inner">
                        <div class="m-dropdown__body">
                          <div class="m-dropdown__content">
                            <ul class="m-nav">
                              @foreach ($item->LopHoc as $lop_hoc)
                              <li class="m-nav__item pl-4 lop_hoc"  onclick="addColor(this)" id='lop_{{$lop_hoc->id}}'
                                style="cursor: pointer">
                                <span href="" class="m-nav__link" onclick="showHocSinhCuaLop({{$lop_hoc->id}}, {{$dot_id_gan_nhat}})">
                                  <span class="m-nav__link-text "> <span
                                      class="ten_lop"> {{$lop_hoc->ten_lop}} </span>
                                    </span>
                                </span>
                              </li>
                              @endforeach


                            </ul>

                            <!--end::Nav-->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
           
          </div>
          <!--end::Section-->
          {{-- </div> --}}
        </div>
      </div>
      {{-- Modal Sức Khỏe --}}
      <div class="modal fade show" id="ShowChiTietSucKhoe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Chi tiết sức khỏe</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-row" id="showChiTietSucKhoeCuaHocSinh">
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
              
            </div>
          </div>
        </div>
      </div>
      {{-- EndModal Sức Khỏe --}}

      {{-- Modal Xóa Sức Khỏe --}}
      <div class="modal fade" id="modal-xoa-dot-kham-suc-khoe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="exampleModalLabel">Lưu ý: Chỉ có thể xóa đợt mà chưa lớp nào đã nhập dữ liệu</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body" id="content-modal-xoa-dot">
              Đang kiểm tra
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
              
            </div>
          </div>
        </div>
      </div>
      {{-- EndModal Xóa Sức Khỏe --}}

      <div class="modal fade show" id="modal-them-dot-kham-suc-khoe" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới đợt khám sức khỏe</h5>
                  
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
              </div>
              
            <form method="POST" id="FormThemDotKhamSucKhoe" action="#">
              @csrf
              <div class="modal-body">
                <div class="form-group m-form__group row">
                  <label for="example-date-input" class="col-2 col-form-label">Tên đợt</label>
                  <div class="col-10">
                    <input class="form-control m-input name-field" name="ten_dot" required type="text" placeholder="Điền đợt khám sức khỏe">
                  </div>
                </div>

                <div class="form-group m-form__group row">
                  <label for="example-date-input" class="col-2 col-form-label">Thời gian</label>
                  <div class="col-10">
                    <input class="form-control m-input" name="thoi_gian" required type="date" id="example-date-input">
                  </div>
                </div>
              </div>
          <div class="modal-footer">
            <button type="button" class="btn m-btn--square  btn-danger"
              data-dismiss="modal" onclick="kiemtrasuckhoe()" data-toggle="modal"
              data-target="#modal-kiem-tra">Kiểm tra</button>
            <button type="submit" id="add_sk" class="btn m-btn--square  btn-primary">Thêm mới</button>
          </div>
        </form>
        </div>
      </div>
      </div>
      <div class="col-md-9 table-responsive scoll-table">
        <div class="row mb-3">
          @if($nam_hoc_moi_nhat == $nam_hoc_hien_tai)
          <div class="col-md-6">
          @else 
          <div class="col-md-8">
          @endif
            <input type="number" id="lop_id_hien_tai" hidden class="ml-3">
          <select class="form-control m-input select2" name="option" id="dot-kham-suc-khoe">
            @foreach($getAllDotKhamSucKhoe as $item)
            <option value={{$item->id}} disabled
            {{($item->id == $dot_id_gan_nhat) ? 'selected' : ''}}
              >{{$item->ten_dot}} - {{date("d/m/Y", strtotime($item->thoi_gian))}} {{($item->id == $dot_id_gan_nhat) ? '(mới nhất)' : ''}}</option>
            @endforeach
            @if(count($getAllDotKhamSucKhoe) == 0)
              <option value="0" disabled selected>Không có dữ liệu</option>
            @endif
          </select>
        </div>
        @if($nam_hoc_moi_nhat == $nam_hoc_hien_tai)
        <div class="col-md-4">
          <button type="submit" class="btn btn-outline-brand" data-toggle="modal"
          data-target="#modal-them-dot-kham-suc-khoe">Thêm đợt khám sức khỏe mới</button>
        </div>
        <div class="col-md-2">
          <button type="submit" onclick="ShowModalXoaDot()" class="btn btn-outline-danger" data-toggle="modal"
          data-target="#modal-xoa-dot-kham-suc-khoe">Xóa đợt</button>
        </div>
        @endif
        </div>  
          <table id="table-hoc-sinh" class="table table-striped table-bordered m-table thong-tin-hoc-sinh-cua-lop   ">
            <thead>
              <tr align="center">
                
                <th style="width: 10%;">Số thứ tự</th>
                <th style="width: 15%;">Mã học sinh</th>
                <th style="width: 20%;">Họ tên</th>
                <th style="width: 15%;">Ngày sinh</th>
                <th style="width: 15%;">Giới tính</th>
                <th>Chiều cao (cm)</th>
                <th id="fidel_thoi_hoc">Cân nặng (kg)</th>
                <th>Chức năng</th>
              </tr>
            </thead>
            <thead class="filter">
              <tr>
                
                <td scope="row"><input class="form-control search m-input " type="hidden"></td>
                <td scope="row"><input class="form-control search m-input search-mahs" type="text"></td>
                <td scope="row"><input class="form-control search m-input search-ten" type="text"></td>
                <td scope="row"><input class="form-control search m-input search-ngaysinh" type="text"></td>
                <td scope="row" style="width:100px">
                  <select  class="form-control search m-input search-gioitinh m-input--square" id="exampleSelect1">
                    <option value="">Chọn</option>
                    <option>Nam</option>
                    <option>Nữ</option>
                  </select>
                </td>

                <td scope="row"><input class="search8" style="width: 70px;" type="hidden"></td>
                <td scope="row"><input class="search8" style="width: 70px;" type="hidden"></td>
                <td scope="row"><input class="search9" style="width: 70px;" type="hidden"></td>
              </tr>
            </thead>
            <tbody id="show-data-hoc-sinh" align="center">
            </tbody>
          </table>
        

      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@if(SESSION('ThongBaoThemDot'))
<script>
  const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Thêm đợt mới thành công'
})
                
</script>
@endif
@if(SESSION('ThongBaoThemDotLoi'))
<script>
  //swal("Thêm đợt thất bại!","Thời gian đợt phải nằm trong phạm vi thời gian của năm học hiện tại","error")
  Swal.fire({
  icon: 'error',
  title: 'Thất bại',
  text: 'Thời gian đợt phải nằm trong phạm vi thời gian của năm học hiện tại'
})  
</script>
@endif
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{-- <script src="path/to/chartjs/dist/Chart.js"></script> --}}
<script>
  const html_danh_sach_lop = $('#id_lop_chuyen').html();
  var dtable;
  // $(document).ready( function () {
  //   dataTable()   
  //   });

   
    function dataTable(){
      dtable= $('#table-hoc-sinh').DataTable( 
           {
        'paging': false,
        "aoColumnDefs": [
             { "bSortable": false, "aTargets": [ 0,1,2,3,4,5,6,7] }, 
         ]
         }
    );
        $('.search-mahs').on('keyup change', function() {
        dtable
        .column(1).search(this.value)
        .draw();
        });
    
        $('.search-ten').on('keyup change', function() {
        dtable
        .column(2).search(this.value)
        .draw();
        });
        
        $('.search-gioitinh').on('change', function() {
        dtable
        .column(4).search(this.value)
        .draw();    
        });

        $('.search-ngaysinh').on('keyup change', function() {
        dtable
        .column(3).search(this.value)
        .draw();
        });
        // $('#table-hoc-sinh').parents('div.dataTables_wrapper').first().hide();
    } 

</script>
<script>
  var url_SucKhoeTheoNam = "{{route('quan-ly-suc-khoe-index', ['id'])}}"
  var url_ShowSucKhoeHocSinh = "{{route('quan-ly-suc-khoe-show-sk-hs')}}"
  var url_ShowChiTietSucKhoe = "{{route('quan-ly-suc-khoe-show-chi-tiet')}}"
  var url_KiemTraDotMoiNhat = "{{route('quan-ly-suc-khoe-kiem-tra-dot-moi-nhat')}}"
  var url_showChiTietLop = "{{route('quan-ly-lop-show', ['id'])}}"
  $(document).ready(function(){
        $('.select2').select2();
    })
    $('#table-hoc-sinh').css('display', 'none');
    const addColor = (e) => {
        var list_element_lop = document.querySelectorAll('.lop_hoc')
        list_element_lop.forEach(element => {
            $(element).css('background', 'transparent')
        });
        $(e).css('background', '#bafac8')
    }
    var check = false;
    function showHocSinhCuaLop(lop_id, dot_id_gan_nhat){
      
      if(check){
        dtable.destroy();
      
      }
      check=true
      $('#lop_id_hien_tai').val(lop_id)
      $('#preload').css('display', 'block');
      $("#dot-kham-suc-khoe").select2('destroy'); 
      var disabled_sk = $('#dot-kham-suc-khoe option')
      for (const key in disabled_sk) {
        if (disabled_sk.hasOwnProperty(key)) {
          const element = disabled_sk[key];
         $(element).removeAttr('disabled')
          
        }
      }
      $("#dot-kham-suc-khoe").select2(); 
        var dot_suc_khoe_hien_tai = $('#dot-kham-suc-khoe').val()
        axios.post(url_ShowSucKhoeHocSinh, {lop_id:lop_id, dot_id_gan_nhat:dot_suc_khoe_hien_tai})
        .then(function(response){
          
          $('#table-hoc-sinh').css('display', 'block');
          var html_show = "";
          var i = 1;
          response.data.forEach(element => {
            if(element.gioi_tinh == 0){
              element.gioi_tinh = "Nam"
            }
            else{
              element.gioi_tinh = "Nữ"
            }
            var date = new Date(element.ngay_sinh),
            yr = date.getFullYear(),
            month = Number(date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()),
            day = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
            newDate = day + '-' + (month+1) + '-' + yr;
            html_show+=`
            <tr>
              <th scope="row">${i++}</th>
              <td>${element.ma_hoc_sinh}</td>
              <td>${element.ten}</td>
              <td>${newDate}</td>
              <td>${element.gioi_tinh}</td>
              <td>${element.chieu_cao}</td>
              <td>${element.can_nang}</td>
              <td><i style="cursor: pointer" class="la la-eye" onclick="ShowChiTietSucKhoe(${element.hoc_sinh_id})" data-toggle="modal" data-target="#ShowChiTietSucKhoe"></i></td>  
            </tr>
            `
          })
          $('#show-data-hoc-sinh').html(html_show);
          $('#preload').css('display', 'none');
          dataTable()
        })
    }

    function ShowChiTietSucKhoe(hoc_sinh_id){
      $('#preload').css('display', 'block');
      axios.post(url_ShowChiTietSucKhoe , {
        hoc_sinh_id:hoc_sinh_id
      }).then(function(response){
        //
        var i = 1;
        var html_modal = 
        `
        <div class="col-md-12 mb-3">
          <label for="validationTooltip01"><b>Học sinh:</b> ${response.data[0].ten}</label>
        </div>
        <div class="col-md-12 mb-3">
          <label for="validationTooltip01"><b>Mã học sinh:</b> ${response.data[0].ma_hoc_sinh}</label>
        </div>
        <div class="col-md-12 mb-3">
          <div class="row">
							<div class="col-lg-6">

								<!--begin::Portlet-->
								<div class="m-portlet m-portlet--tab">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
													Biểu đồ chiều cao (cm)
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">
										<canvas id="myChart" width="200" height="200"></canvas>
									</div>
								</div>

								<!--end::Portlet-->
							</div>
							<div class="col-lg-6">

								<!--begin::Portlet-->
								<div class="m-portlet m-portlet--tab">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
													Biểu đồ cân nặng (kg)
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">
                    <canvas id="myChart2" width="200" height="200"></canvas>
										
									</div>
								</div>

								<!--end::Portlet-->
							</div>
						</div>
        
        </div>
        <div class="col-md-12 mb-3">
          <table class="table m-table m-table--head-bg-success table-bordered">
          <thead>
               <tr>
                   <th>Số thứ tự</th>
                   <th>Đợt</th>
                   <th>Thời gian</th>
                   <th>Lớp</th>
                   <th>Chiều cao (cm)</th>
                   <th>Cân nặng (kg)</th>
               </tr>
          </thead>
          <tbody>
        `
        var labels_chart = []
        var data_chart = []
        var data_chart2 = []
        var backgroundColor_ChieuCao = []
        var backgroundColor_CanNang = []
        response.data.forEach(element => {

          var date = new Date(element.thoi_gian),
            yr = date.getFullYear(),
            month = Number(date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()),
            day = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
            newDate = day + '-' + (month+1) + '-' + yr;

          
          html_modal += 
          `
          <tr>
               <th scope="row">${i++}</th>
               <td>${element.ten_dot}</td>
               <td>${newDate}</td>
               <td>${element.ten_lop}</td>
               <td>${element.chieu_cao}</td>
               <td>${element.can_nang}</td>
          </tr>
           
           
          `

          //Chart
          labels_chart.unshift(element.ten_dot)
          data_chart.unshift(element.chieu_cao)
          data_chart2.unshift(element.can_nang)
          backgroundColor_ChieuCao.unshift('rgba(255, 99, 132, 0.2)')
          backgroundColor_CanNang.unshift('rgba(75, 192, 192, 0.2)')
        })
        html_modal += 
        `
        </tbody></table></div>
        `
        $('#showChiTietSucKhoeCuaHocSinh').html(html_modal);
        //Biểu đồ
       
        var ctx = document.getElementById('myChart');
        var ctx2 = document.getElementById('myChart2');
        //Chiều cao
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels_chart,
                datasets: [{
                    label: 'Chiều cao',
                    data: data_chart,
                    backgroundColor: backgroundColor_ChieuCao,
                    borderColor: backgroundColor_ChieuCao,
                    borderWidth: 1
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        //Cân nặng
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: labels_chart,
                datasets: [{
                    label: 'Cân nặng',
                    data: data_chart2,
                    backgroundColor: backgroundColor_CanNang,
                    borderColor: backgroundColor_CanNang,
                    borderWidth: 1
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        $('#preload').css('display', 'none');
        $('#ShowChiTietSucKhoe').modal('show');
        
      })
    }

    $('#dot-kham-suc-khoe').change(function(){
      var DotSucKhoe = Number($('#dot-kham-suc-khoe').val())
      var LopId = Number($('#lop_id_hien_tai').val())
      showHocSinhCuaLop(LopId, DotSucKhoe)
      // dataTable()
    })

    $("#select-nam").change(function(){
       $('#select_display').css('display', 'block')
       var id = $("#select-nam").val();
       var url_moi = url_SucKhoeTheoNam.replace('id',id)
       window.location.href = url_moi;
       
    })
    function kiemtrasuckhoe(){
     axios.post(url_KiemTraDotMoiNhat)
     .then(function(response){
       var html = ""
       
      if(response.data.data2.length == 0){
        var html = 
        `<div class="col-md-12">
          <label><b style="color:green">Tất cả các lớp đã được nhập dữ liệu</b></label>
        </div>`
      }
      else{
        html+= 
        `
        
        <div class="row">
          <div class="col-lg-12">
          <label><b>Danh sách các lớp chưa nhập dữ liệu</b></label>
        </div>
        `
        
        response.data.data2.forEach(element =>{
          var url_showChiTietLop_new = url_showChiTietLop.replace('id', element.id)
          html += 
          `<div class="col-lg-3">
          <label><b>
          <a target="_blank" href="${url_showChiTietLop_new}">${element.ten_lop}</a>
          </b></label>
          </div> `
        })
      }
      html+=`</div>`
      $('#noi-dung-ket-qua-kiem-tra').html(html)
     })
      
    }

    //thêm sức khỏe
    var url_ThemDotKhamSucKhoe = "{{route('quan-ly-suc-khoe-them-dot-kham')}}"
    $(document).ready(function(){
            $('#add_sk').on('click', function(){
              
                Swal.fire({
                    title: 'Có chắc chắn thêm mới đợt sức khỏe ?',
                    text: "Thời gian phải lớn hơn thời gian của đợt gần nhất",
                    footer: '<i style="color:red">Các lớp chưa được thêm từ đợt trước sẽ tự động là 0</i>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: "Đóng"
                }).then((result) => {
                    if (result.value) {
                      $('#preload').css('display', 'block');
                      var formElement = document.getElementById('FormThemDotKhamSucKhoe')
                      // var request = new XMLHttpRequest();
                      // request.open("POST", url_ThemDotKhamSucKhoe);
                      // request.send(new FormData(formElement))
                      // request.onload = function () {
                      // var data = request.response[0];
                      // };
                      var formData = new FormData(formElement)
                      axios.post(url_ThemDotKhamSucKhoe, formData)
                      .then(function(response){
                        

                        //Lỗi
                        $('#preload').css('display', 'none');
                        if(response.data == "Lỗi"){
                          
                          Swal.fire({
                          icon: 'error',
                          title: 'Thất bại',
                          text: 'Thời gian đợt phải nằm trong phạm vi thời gian của năm học hiện tại'
                          })
                          
                        }
                        //Lỗi Ngày
                        if(response.data == "Lỗi Ngày"){
                          
                          Swal.fire({
                          icon: 'error',
                          title: 'Thất bại',
                          text: 'Thời gian phải lớn hơn đợt mới nhất'
                          })
                          
                        }
                        //Hoàn thành
                        if(response.data == "Hoàn Thành"){
                            const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                          })
                          Toast.fire({
                            icon: 'success',
                            title: 'Thêm đợt mới thành công'
                          })
                          location.reload()
                        }

                      })
                      
                    }
                })
                return false;
            });
        });
    var url_ShowModalXoaDot = "{{route('quan-ly-suc-khoe-show-xoa-dot')}}"
    function ShowModalXoaDot(){
      $('#preload').css('display', 'block');
      axios.post(url_ShowModalXoaDot)
      .then(function(response){
        if(response.data.length > 0){
        var htmlXoa = `
        <div class="col-md-12 mb-3">
          <table class="table m-table m-table--head-bg-success table-bordered">
          <thead align="center">
               <tr>
                   <th>Số thứ tự</th>
                   <th>Đợt</th>
                   <th>Thời gian</th>
                   <th>Chức năng</th>
               </tr>
          </thead>
          <tbody align="center">
        `
        var stt = 1
        response.data.forEach(element => {
          var date = new Date(element.thoi_gian),
            yr = date.getFullYear(),
            month = Number(date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()),
            day = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
            newDate = day + '-' + (month+1) + '-' + yr;
          htmlXoa += `
          <tr>
            <td>${stt++}</td>
            <td>${element.ten_dot}</td>
            <td>${newDate}</td>
            <td><a href="#" onclick="XoaDot(${element.id})"><i class="fa fa-trash-alt"></i></a></td>
          </tr>
          `
          
          
        })
        htmlXoa += 
          `
          </tbody>
          </table>
          </div>
          `
        $('#content-modal-xoa-dot').html(htmlXoa)
          $('#preload').css('display', 'none');
      }
      else{
        var htmlXoa = `Không tìm thấy đợt nào cả !`
        $('#content-modal-xoa-dot').html(htmlXoa)
        $('#preload').css('display', 'none');
      }
      })
    }
    var url_XoaDot = "{{route('quan-ly-suc-khoe-xoa-dot')}}"
    function XoaDot(id){
     
        Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa đợt này',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Đóng'
        }).then((result) => {
        if (result.isConfirmed) {
          axios.post(url_XoaDot, {id:id})

          Swal.fire(
            'Hoàn thành',
            'Đã xóa thành công',
            'success'
          )
          location.reload()
        }
      })
    }
</script>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endsection