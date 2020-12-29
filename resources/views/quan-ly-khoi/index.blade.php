@extends('layouts.main')
@section('title', "Quản lý khối")
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Bộ lọc
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">Khối</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" name="loai_hinh" id="loai_hinh">
                                                <option value="0" selected>Chọn khối</option>
                                                @foreach ($khoi as $item)
                                                <option value={{$item->id}}>{{$item->ten_khoi}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end::Section-->
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div>
    <section class="action-nav d-flex align-items-center justify-content-between mt-4 mb-4">
        <div class="col-lg-6 ">

        </div>
        <div class="col-lg-6 " style="text-align: right">
            <button type="button" class="btn btn-info .bg-info" data-toggle="modal" data-target="#exampleModal">Thêm mới</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{route('quan-ly-khoi-post_create')}}" method="post">
                        @csrf   
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm khối</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"  id="basic-addon3">Tên khối</span>
                                    </div>
                                    <input type="text" class="form-control" name="ten_khoi" id="basic-url" aria-describedby="basic-addon3">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"  id="basic-addon3">Độ tuổi</span>
                                    </div>
                                    <input type="number" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="do_tuoi">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
    <div class="m-portlet">
        <div class="m-portlet__body table-responsive">
            <table class="table m-table m-table--head-bg-success">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Tên khối</th>
                        <th>Độ tuổi</th>
                        <th>Số lớp</th>
                        <th>Số học sinh</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1 
                    @endphp
                    @foreach ($khoi as $item)
                    
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$item->ten_khoi}}</td>
                        <th>{{$item->do_tuoi}}</th>
                        <td>{{$item->tong_lop_hoc}}</td>
                        <td>{{$item->tong_hoc_sinh}}</td>
                        <td>
                            <button type="button" class="btn btn-info .bg-info" data-toggle="modal" data-target="#Khoi{{$item->id}}">Cập nhật</button>
                            <button type="button" onclick="xoa_khoi({{$item->id}})" class="btn btn-danger">Xóa</button>
                        </td>
                        
                    </tr>
                   
                    @endforeach
                </tbody>
            </table>
        </div>
    @foreach ($khoi as $value)
    <div class="modal fade" id="Khoi{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{route('quan-ly-khoi-store', ['id' => $value->id])}}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập nhật khối</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">Tên khối</span>
                                    </div>
                                <input type="text" name="ten_khoi" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{$value->ten_khoi}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">Độ tuổi</span>
                                    </div>
                                <input type="text" name="do_tuoi" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{$value->do_tuoi}}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@if(SESSION('thong_bao'))
<script>
Swal.fire({
  title: 'Thực hiện thành công',
  showClass: {
    popup: 'animate__animated animate__fadeInDown'
  },
  hideClass: {
    popup: 'animate__animated animate__fadeOutUp'
  }
})

</script>
@endif
<script>
    var urLinkDestroy = "{{route('quan-ly-khoi-destroy')}}";
    function xoa_khoi(id){
        Swal.fire({
                title: 'Bạn có chắc chắn xóa ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa',
                cancelButtonText: "Đóng"
            }).then((result) => {
                if (result.value) {
                    axios.post(urLinkDestroy,{
                        id: id
                }).then(function(response){
                        location.reload()
                    })
                }
            })
    }
    </script>
@endsection


