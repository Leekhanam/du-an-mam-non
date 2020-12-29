@extends('layouts.main')
@section('title', 'Cập nhật lớp học')
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">

            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Cập nhật lớp
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right row" method="POST"
                    action="{{ route('quan-ly-lop-update',['id'=>$lop->id]) }}">
                    @csrf
                    <input type="hidden" value="{{$lop->id}}" name="lop_id">
                    <div class="col-md-6">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Tên lớp</label>
                                <input type="text" name="ten_lop" class="form-control m-input m-input--square"
                                    value="{{$lop->ten_lop}}" id="exampleInputPassword1" placeholder="Nhập tên lớp">
                                    @error('ten_lop')
                                    <div class="alert alert-danger mt-2 alert-dismissible fade show" role="alert">
                                        {{ $message }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @enderror
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputPassword1">Khối</label>
                                <select class="form-control" name="khoi" id="khoi">
                                    <option value=>Chọn khối</option>
                                    @foreach ($khoi as $item)
                                    <option {{ $item->id == $lop->Khoi->id ? 'selected' : '' }} value={{ $item->id }}>
                                        {{ $item->ten_khoi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Giáo viên chủ nhiệm</label>
                                <select style="width: 100%" class="form-control" name="giao_vien_cn"
                                    id="id_giao_vien_cn">
                                    <option selected value="{{ 
                                    $lop->giao_vien_chu_nhiem !=null?$lop->giao_vien_chu_nhiem->id:''
                                    }}">
                                        {{   $lop->giao_vien_chu_nhiem !=null? $lop->giao_vien_chu_nhiem->ma_gv.'-'.$lop->giao_vien_chu_nhiem->ten:'' }}
                                    </option>
                                    @foreach ($giao_vien as $item)
                                    <option value={{ $item->id }}>{{ $item->ma_gv}}-{{ $item->ten }}</option>
                                    @endforeach
                                    @foreach ($lop->giao_vien_phu as $item)
                                    <option value={{ $item->id }}>{{ $item->ma_gv}}-{{ $item->ten }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputPassword1">Giáo viên phụ</label>
                                <select style="width: 100%" class="form-control m-select2" id="id_giao_vien_phu"
                                    name="giao_vien_phu[]" multiple="multiple">
                                    <option disabled value="{{ 
                                        $lop->giao_vien_chu_nhiem !=null?$lop->giao_vien_chu_nhiem->id:''
                                        }}">
                                        {{   $lop->giao_vien_chu_nhiem !=null? $lop->giao_vien_chu_nhiem->ten:'' }}
                                    </option>
                                    @foreach ($lop->giao_vien_phu as $item)
                                    <option selected value={{ $item->id }}>{{ $item->ma_gv}}-{{ $item->ten }}</option>
                                    @endforeach
                                    @foreach ($giao_vien as $item)
                                    <option value={{ $item->id }}>{{ $item->ma_gv}}-{{ $item->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="m-form__actions">
                            <button type="button" class="btn btn-light">Hủy</button>
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $('#id_giao_vien_cn').select2();
        $('#id_giao_vien_phu').select2();

        $('#id_giao_vien_cn').change(() => {
            var id_giao_vien_cn = $('#id_giao_vien_cn').val()
            var danh_sach_giao_vien_phu = $('#id_giao_vien_phu').val()
            var pos = danh_sach_giao_vien_phu.indexOf(id_giao_vien_cn);
            danh_sach_giao_vien_phu.splice(pos, 1);
            $('#id_giao_vien_phu').val(danh_sach_giao_vien_phu).trigger("change");
                $('#id_giao_vien_phu').removeAttr('disabled')
                var list_giao_vien_phu = document.querySelectorAll('#id_giao_vien_phu option')
                list_giao_vien_phu.forEach(element => {
                    $(element).removeAttr('disabled')
                    if (id_giao_vien_cn == $(element).val()) {
                        $(element).attr('disabled', true)
                        $("#id_giao_vien_phu").select2("destroy");
                        $("#id_giao_vien_phu").select2();
                    }
                })
            
         
        });

</script>
@endsection