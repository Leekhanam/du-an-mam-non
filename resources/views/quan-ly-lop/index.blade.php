@extends('layouts.main')
@section('title', 'Quản lý lớp')
@section('style')
<style>
    .m-table th,
    td {
        text-align: center;
    }

    .m-table ul li {
        list-style: none;
    }

    .js-example-basic-single {
        padding-right: 20px;
    }

    .select2-selection__arrow {
        margin-left: 30px;
    }
</style>
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="m-content">
    <div id="preload" class="preload-container text-center" style="display: none">
        <img id="gif-load" src="https://cdn.bihama.vn/static/core/images/test.gif" alt="">
    </div>
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
                            <form action="" method="get">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group m-form__group row">
                                            <label class="col-lg-3 col-form-label">Khối</label>
                                            <div class="col-lg-9">
                                                <select class="form-control" name="khoi" id="khoi">
                                                    <option value=>Chọn khối</option>
                                                    @foreach ($khoi as $item)
                                                    <option @if(isset($params['khoi']))
                                                        {{$params['khoi'] == $item->id?'selected':''}} @endif
                                                        value={{ $item->id }}>{{ $item->ten_khoi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group m-form__group row">
                                            <label for="" class="col-lg-3 col-form-label">Tên lớp</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control m-input"
                                                    @if(isset($params['keyword'])) value="{{$params['keyword']}}" @endif
                                                    placeholder="Nhập mã hoặc tên ngành nghề" name="keyword">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Tìm kiếm</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!--end::Section-->
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div>
    <section class="action-nav d-flex align-items-center justify-content-between mt-4 mb-4">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-6 " style="text-align: right">
            <a href="{{ route('quan-ly-lop-create') }}" data-toggle="modal" data-target="#m_select2_modal"
                class="btn btn-info .bg-info">Thêm
                mới</a>
        </div>
    </section>
    <div class="m-portlet">
        <div class="m-portlet__body table-responsive">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Thành Công!</strong> {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <table class="table m-table m-table--head-bg-success">
                <div class="col-12 form-group m-form__group d-flex justify-content-end">
                    <label class="col-lg-2 col-form-label">Kích thước:</label>
                    <div class="col-lg-2">
                        <select class="form-control" id="page-size">
                            @foreach(config('common.paginate_size.list') as $size)
                            <option @if(isset($params['page_size']) && $params['page_size']==$size) selected @endif
                                value="{{$size}}">
                                {{$size}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <thead>
                    <tr>
                        <th> Stt</th>
                        <th> Tên lớp</th>
                        <th> Sĩ số</th>
                        <th> Giáo viên chủ nhiệm</th>
                        <th> Khối</th>
                        <th>Thông tin</th>
                        <th colspan="2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($lop)>0)
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1);
                    @endphp
                    @endif
                    @foreach ($lop as $item)
                    <tr class="lop">
                        <th scope="row">{{ $i++}}</th>
                        <td>{{ $item->ten_lop }}</td>
                        <td>{{ $item->tong_so_hoc_sinh }}</td>
                        <td>
                            @if ($item->giao_vien_chu_nhiem != null)
                            {{ $item->giao_vien_chu_nhiem->ten }}
                            @else
                            {{ 'Chưa có giáo viên' }}
                            @endif

                        </td>
                        
                        <td>
                            @if ($item->Khoi != null)
                            {{ $item->Khoi['ten_khoi'] }}
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-light" href="{{ route('quan-ly-lop-show', ['id' => $item->id]) }}">Chi
                                tiết</a>
                        </td>
                        <td><a href="{{ route('quan-ly-lop-edit',['id'=>$item->id]) }}" class="btn btn-primary mr-3">Cập
                                nhật</a>
                            <button class="btn btn-danger" onclick="deleteLop({{$item->id}},this)">Xóa</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="m-portlet__foot d-flex justify-content-end">
                {{ $lop->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{!! asset('page_size/page_size.js') !!}"></script>
<script>
    async function deleteLop(id,e){
    var routeDelete = "{{ route('quan-ly-lop-destroy') }}"
      await swal("Bạn có chắc chắn muốn xóa ?", {
        buttons: ["Hủy", "Đồng ý"],
        }).then( result =>{
            
         if(result != null){
		$('#preload').css('display','block')

            axios.post(routeDelete, {
                'id':id
            })
            .then(function (response) {
                $('#preload').css('display','none')
                swal({
                title: "Xóa thành công",
                icon: "success",
                });
               window.location.reload()
            })
            .catch(function (error) {
                console.log(error);
            });
         }
        });
        
    }
</script>
@endsection