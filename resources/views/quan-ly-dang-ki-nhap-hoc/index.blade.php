@extends('layouts.main')
@section('title', "Quản lý đang kí nhập học")
@section('content')
<div class="m-content">
    <div class="m-portlet">
        <div class="row">
        <div class="col-12">
            <!--begin::Portlet-->
            
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
                <form method="GET" action="{{ route('quan-ly-dang-ky-nhap-hoc.index') }}">
                <div class="m-portlet__body">
                     <!-- @csrf	 -->
                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-4 col-form-label">Mã đơn đăng ký</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="ma_don" class="form-control m-input m-input--square" id="" placeholder="Tên học sinh">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-4 col-form-label">Số điện thoại đăng kí</label>
                                        <div class="col-lg-6">
                                            <input type="number" name="sdt_dk_sreach" class="form-control m-input m-input--square" id="" placeholder="Số điện thoại đăng ký">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-4 col-form-label">Tên học sinh</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="ten_sreach" class="form-control m-input m-input--square" id="" placeholder="Tên học sinh">
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                      
                    </div>
                        <div class="col-md-12 text-center">
                             <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    <!--end::Section-->
                </form>

                
            </div>

            <!--end::Portlet-->
        </div>
    </div>
    </div>
    
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
            <table class="table m-table m-table--head-bg-success">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Mã đơn</th>
                        <th>Họ tên</th>
                        <th>Ảnh</th>
                        <th>Ngày sinh</th>
                        <th>SĐT đăng kí</th>
                        <th>Tên bố</th>
                        <th>Tên mẹ</th>
                        <th>Tên người giám hộ</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                <!-- @if (count($all_hs_dang_ki)>0)
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1);
                    @endphp
                @endif -->

                    @foreach($all_hs_dang_ki as $hs)
                    <tr>
                        <th scope="row">1</th>
                        <td><b>{{$hs->ma_don}}</b></td>
                        <td>{{$hs->ten}}</td>
                        <td><img width="50px" class="img-thumbnail"  src="{{$hs->avatar}}"  alt=""></td>
                        <td>{{$hs->ngay_sinh}}</td>
                        <td>{{$hs->dien_thoai_dang_ki}}</td>
                        <td>{{$hs->ten_cha}}</td>
                        <td>{{$hs->ten_me}}</td>
                        <td>{{$hs->ten_nguoi_giam_ho}}</td>
                        <td><a href="{{route('edit-hs-dang-ky-nhap-hoc',['id'=>$hs->id  ])}}">Cập nhật</a></td>
                    </tr>
                    @endforeach
                 

                </tbody>
            </table>

            <div class="m-portlet__foot d-flex justify-content-end">
                {{ $all_hs_dang_ki->links() }}
            </div>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{!! asset('excel-js/js-form.js') !!}"></script>
<script src="{!! asset('page_size/page_size.js') !!}"></script>

<script>
    var routeImport = "{{route('import-bieu-mau-nhap-hoc-sinh')}}";


    $("#status-view").change(function(){  
    var url = new URL(window.location.href);
    var search_params = url.searchParams;
    search_params.set('status_view', $('#status-view').val());
    url.search = search_params.toString();
    var new_url = url.toString();
    window.location.href = new_url
  });


</script>

@endsection
