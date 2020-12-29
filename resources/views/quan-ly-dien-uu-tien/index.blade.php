@extends('layouts.main')
@section('title', "Quản lý diện ưu tiên")
@section('style')
@endsection
@section('content')

<div class="m-content">
    <div id="preload" class="preload-container text-center" style="display: none">
      <img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
    </div>
    
    {{-- Modal thêm quản lý diện ưu tiên --}}
    <div class="modal fade show" id="modal-them-dien-uu-tien" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="POST" action="{{route('quan-ly-dien-uu-tien-store')}}">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Thêm diện ưu tiên</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                
                  @csrf
                <div class="form-group m-form__group row">
                  <label for="example-date-input" class="col-2 col-form-label">Tên diện ưu tiên</label>
                  <div class="col-10">
                    <input class="form-control m-input" name="ten_chinh_sach" required type="text" placeholder="Tên diện ưu tiên">
                  </div>
                </div>

                <div class="form-group m-form__group row">
                  <label for="example-date-input" class="col-2 col-form-label">Mức miễn giảm</label>
                  <div class="col-10">
                    <div class="input-group m-input-group m-input-group--square">
                      <input type="number" min="0" name="muc_mien_giam" max="100" class="form-control m-input" required placeholder="Mức miễn giảm" aria-describedby="basic-addon1">
                      <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">%</span></div>
                    </div>
                  </div>
                </div>
              
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn m-btn--square  btn-default"
                      data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn m-btn--square  btn-success">Thêm mới</button>
              </div>
          </div>
        </form>
        
      </div>
    </div>
  {{-- End Modal thêm --}}
  {{-- Modal sửa quản lý diện ưu tiên --}}
  <div class="modal fade show" id="modal-sua-dien-uu-tien" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form method="POST" id="FormSuaDienUuTien" action="">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa diện ưu tiên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="form-group m-form__group row">
                <label for="example-date-input" class="col-2 col-form-label">Tên diện ưu tiên</label>
                <div class="col-10">
                  <input class="form-control m-input" id="ten_chinh_sach_chinh_sua" name="ten_chinh_sach" required type="text" placeholder="Tên diện ưu tiên">
                </div>
              </div>
            
              <div class="form-group m-form__group row">
                <label for="example-date-input" class="col-2 col-form-label">Mức miễn giảm</label>
                <div class="col-10">
                  <div class="input-group m-input-group m-input-group--square">
                    <input type="number" min="0" id="muc_mien_giam_chinh_sua" name="muc_mien_giam" max="100" class="form-control m-input" required placeholder="Mức miễn giảm" aria-describedby="basic-addon1">
                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">%</span></div>
                  </div>
                </div>
              </div>
            
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn m-btn--square  btn-default"
                    data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn m-btn--square  btn-success">Chỉnh sửa</button>
            </div>
          </form>
        </div>
    </div>
  </div>
  {{-- End Modal sửa --}}
    <div class="row">
      <div class="col-sm-9">
        <div class="m-alert m-alert--outline m-alert--square m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert" id="ThongBaoXoaDienUuTien" style="display: none">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          </button>
          <strong>Hoàn thành!</strong> Đã xóa diện chính sách thành công.
        </div>
        @if(SESSION('ThongBaoDienUuTien'))
        <div class="m-alert m-alert--outline m-alert--square m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          </button>
          <strong>Hoàn thành!</strong> Đã thêm diện chính sách thành công.
        </div>
        @endif
        @if(SESSION('ThongBaoSuaDienUuTien'))
        <div class="m-alert m-alert--outline m-alert--square m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          </button>
          <strong>Hoàn thành!</strong> Đã sửa diện chính sách thành công.
        </div>
        @endif
      </div>
      <div class="col-sm-3 d-flex justify-content-end ">
        <button class="btn btn-success ml-2" data-toggle="modal" data-target="#modal-them-dien-uu-tien">Thêm mới</button>
        <button onclick="XoaListDienUuTien()" class="btn btn-success ml-3">Xóa</button>
      </div>
    </div>
    
    <div class="m-portlet mt-4">
      
      <div class="m-portlet__body row">
        <div class="col-md-12 table-responsive scoll-table">
            <table id="table-dien-uu-tien" class="table table-striped table-bordered m-table thong-tin-hoc-sinh-cua-lop">
              <thead>
                <tr align="center">
                  <th></th>
                  <th><b>Tên diện ưu tiên</b></th>
                  <th><b>Mức miến giảm (%)</b></th>
                  <th colspan="2"></th>
                  
                </tr>
              </thead>
              <thead class="filter">
                <tr>
                  <td style="width: 5%;">
                    <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
                      <input type="checkbox" onclick="checkAll(this)">
                      <span></span>
                    </label>
                  </td>
                  <td scope="row"></td>
                  <td scope="row"></td>
                  <td colspan="2"></td>
                </tr>
              </thead>
              <tbody id="show-data-hoc-sinh">
                @foreach ($data as $item)
                <tr id="dien-uu-tien-{{$item->id}}">
                  <th>
                    <label class="m-checkbox m-checkbox--bold m-checkbox--state-success">
                    <input type="checkbox" value="{{$item->id}}" class="checkboxDienUuTien" class="checkbox">
                      <span></span>
                    </label>
                  </th>
                  <td>{{$item->ten_chinh_sach}}</td>
                  <td style="text-align: right">{{$item->muc_mien_giam}}%</td>
                  <td align="center" style="cursor: pointer" onclick="SuaDienUuTien({{$item->id}})" data-toggle="modal" data-target="#modal-sua-dien-uu-tien">
                    <span> 
                    <i class="fa fa-pen-alt"></i>
                  </span>
                  </td>
                  <td align="center" style="cursor: pointer" onclick="XoaDienUuTien({{$item->id}})">
                  <span>
                    <i class="fa fa-trash-alt"></i>
                  </td>
                  </span>
                </tr>
                @endforeach
              </tbody>
            </table>
          
  
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

  var url_XoaMotDienUuTien = "{{route('quan-ly-dien-uu-tien-delete')}}"
  var url_GetMotDienUuTien = "{{route('quan-ly-dien-uu-tien-get-mot')}}"
  var url_SuaDienUuTien = "{{route('quan-ly-dien-uu-tien-edit', ['id'])}}"
  var url_XoaListDienUuTien = "{{route('quan-ly-dien-uu-tien-delete-list')}}"
  const checkAll = (e) => {
    $(e).parents('table').find('.checkboxDienUuTien').not(e).prop('checked', e.checked);
  };
  function SuaDienUuTien(id){
    var url_SuaDienUuTien_New = url_SuaDienUuTien.replace('id', id) 
    $('#FormSuaDienUuTien').attr('action', url_SuaDienUuTien_New)
    axios.post(url_GetMotDienUuTien, 
    {id:id}).then(function(response){
      var data = response.data
      $('#ten_chinh_sach_chinh_sua').val(data.ten_chinh_sach)
      $('#muc_mien_giam_chinh_sua').val(data.muc_mien_giam)
    })
  }
  function XoaDienUuTien(id){
      Swal.fire({
      title: 'Chắc chắn muốn xóa diện ưu tiên này?',
      text: "Bạn sẽ không thể khôi phục lại được!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: "Đóng",
      confirmButtonText: 'Xóa'
      
      }).then((result) => {
        if (result.value == true) {
          axios.post(url_XoaMotDienUuTien, {
            id : id
          })
          $('#dien-uu-tien-'+id).remove()
          $('#ThongBaoXoaDienUuTien').css('display', 'block')
        }
      })
  }

  const XoaListDienUuTien = () =>{
    let element_xoa = document.querySelectorAll('.checkboxDienUuTien')
    let danh_sach_xoa = []
    element_xoa.forEach(element => {
      if($(element).prop('checked')){
          danh_sach_xoa.push($(element).val());
      }
    })
    Swal.fire({
      title: 'Chắc chắn muốn xóa các diện ưu tiên này?',
      text: "Bạn sẽ không thể khôi phục lại được!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: "Đóng",
      confirmButtonText: 'Xóa'
      
      }).then((response) => {
        if (response.value == true) {
          axios.post(url_XoaListDienUuTien, danh_sach_xoa)
          danh_sach_xoa.forEach(el =>{
            $('#dien-uu-tien-'+el).remove()
          })
          $('#ThongBaoXoaDienUuTien').css('display', 'block')
        }
      })
    
}
</script>
@endsection