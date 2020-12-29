@extends('layouts.main')
@section('title', "Quản lý học sinh")
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
  #danh_sach_nam_hoc_session{
    display: none
  }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
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
                  <h3 class="m-portlet__head-text col-md-10">
                    Năm học: {{$namhoc->name}} <input type="hidden" name="" id="nam_hoc" value="{{$namhoc->id}}">
                  </h3>

                  @if ($namhoc->type == 1)
                  <span class="col-md-2"><i class="la la-plus " data-toggle="modal"
                      data-target="#modal-add-khoi"></i></span>
                  @endif


                  {{-- start modal add khối --}}
                  <div class="modal fade" id="modal-add-khoi" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
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
                                <span class="input-group-text" id="basic-addon3">Tên khối</span>
                              </div>
                              <input type="text" class="form-control" id="ten_khoi" name="ten_khoi"
                                aria-describedby="basic-addon3">

                            </div>
                            <div class="input-group-prepend">
                              <p class="error error-ten-khoi"></p>
                            </div>

                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Độ tuổi</span>
                              </div>
                              <select class="form-control m-input m-input--square" name="do_tuoi" id="do_tuoi">
                                <option value="">Chọn</option>
                                @foreach (config('common.do_tuoi') as $key => $item)
                                @if ($key == 0)
                                    @continue;
                                @endif
                                  <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                               
                                
                              </select>
                            </div>
                            <div class="input-group-prepend">
                              <p class="error error-do-tuoi"></p>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                          <span onclick="addKhoi()" class="btn btn-primary">Thêm</span>
                        </div>
                      </div>

                    </div>
                  </div>
                  {{-- end modal add khối --}}
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="m-portlet__body"> --}}

          <!--begin::Section-->
          <div
            class="m-accordion m-accordion--default m-accordion--solid m-accordion--section  m-accordion--toggle-arrow"
            id="" role="tablist">
            {{-- start modal sửa khối --}}
            <div class="modal fade" id="modal-sua-khoi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">

                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa khối</h5>
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
                        <input type="hidden" id="id_khoi_sua">
                        <input type="text" class="form-control" id="sua_ten_khoi" name="ten_khoi"
                          aria-describedby="basic-addon3">
                      </div>
                      <div class="input-group-prepend">
                        <p class="error error-update-ten-khoi"></p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <span onclick="capNhatKhoi()" class="btn btn-primary">Cập nhật</span>
                  </div>
                </div>

              </div>
            </div>
            {{-- end modal sửa khối  --}}
            {{-- start modal add lớp --}}
            <div class="modal fade" id="modal-add-lop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới lớp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="m-portlet__body">
                          <div class="form-group m-form__group">
                            <input type="hidden" id="khoi_id">
                            <label for="exampleInputEmail1">Tên lớp</label>
                            <input type="text" name="ten_lop" class="form-control m-input m-input--square" id="ten_lop"
                              placeholder="Nhập tên lớp">
                            <div class="input-group-prepend">
                              <p class="error error-ten-lop"></p>
                            </div>
                          </div>
                          <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Giáo viên chủ nhiệm</label>
                            <select style="width: 100%" class="form-control" name="giao_vien_cn" id="id_giao_vien_cn">
                              <option value="">Chọn giáo viên</option>
                              {{-- @foreach ($giao_vien as $item)
                              <option value={{ $item->id }}>{{ $item->ma_gv}}-{{$item->ten }}</option>
                              @endforeach --}}
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="m-portlet__body">

                          <div class="form-group m-form__group">
                            <label for="exampleInputPassword1">Giáo viên phụ</label>
                            <select style="width: 100%" disabled class="form-control m-select2" id="id_giao_vien_phu"
                              name="giao_vien_phu[]" multiple="multiple">
                              {{-- @foreach ($giao_vien as $item)
                              <option value={{ $item->id }}>{{ $item->ma_gv}}-{{ $item->ten }}</option>
                              @endforeach --}}
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <span onclick="addLop()" class="btn btn-primary">Thêm mới</span>
                  </div>
                </div>

              </div>
            </div>
            {{-- end modal add lớp  --}}

            {{-- start modal sửa lớp --}}
            <div class="modal fade" id="modal-cap-nhat-lop" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật lớp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="m-portlet__body">
                          <div class="form-group m-form__group">
                            <input type="hidden" id="sua_lop_id">
                            <label for="exampleInputEmail1">Tên lớp</label>
                            <input type="text" name="ten_lop" class="form-control m-input m-input--square"
                              id="sua_ten_lop" placeholder="Nhập tên lớp">
                            <div class="input-group-prepend">
                              <p class="error error-update-ten-lop"></p>
                            </div>
                          </div>
                          <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Giáo viên chủ nhiệm</label>
                            <select style="width: 100%" class="form-control" name="giao_vien_cn"
                              id="id_sua_giao_vien_cn">
                              <option value="">Chọn giáo viên chủ nhiệm</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="m-portlet__body">

                          <div class="form-group m-form__group">
                            <label for="exampleInputPassword1">Giáo viên phụ</label>
                            <select style="width: 100%" class="form-control m-select2" id="id_sua_giao_vien_phu"
                              name="giao_vien_phu[]" multiple="multiple">

                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <span onclick="suaLop()" class="btn btn-primary">Cập nhật</span>
                  </div>
                </div>

              </div>
            </div>
            {{-- end modal sửa lớp  --}}

            {{-- start modal xếp lớp --}}
            <div class="modal fade" id="modal-xep-lop-tu-dong" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xếp lớp tự động ( <span id="xep-lop-show-ten-lop">Tên
                        lớp</span> : <span id="xep-lop-show-sl-hs">0</span> học sinh )</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="m-portlet__body thong-tin-xep-lop">
                          <span class="m-section__sub">Tổng số sinh viên chưa có lớp: <span
                              style="color: green;font-weight: bold" class="so_hs"> 200 </span> ; Trong đó:
                            <span style="color: red;font-weight: bold" class="so_hs_nam">Nam: 100 </span> ;
                            <span style="color: blue;font-weight: bold" class="so_hs_nu">Nữ: 100 </span>
                            <input type="hidden" id="id_lop_xep">
                          </span>

                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="m-portlet__body ">
                          <table class="table table-bordered m-table ">
                            <thead>
                              <tr>
                                <th>Độ tuổi</th>
                                <th>Số lượng học sinh Nam</th>
                                <th>Số lượng học sinh Nữ</th>
                              </tr>
                            </thead>
                            <tbody id="hoc-sinh-chua-co-lop-theo-do-tuoi">
                              <tr>
                                <th scope="row">2</th>
                                <td>11</td>
                                <td>22</td>

                              </tr>
                              <tr>
                                <th scope="row">3</th>
                                <td>11</td>
                                <td>22</td>

                              </tr>
                              <tr>
                                <th scope="row">5</th>
                                <td>20</td>
                                <td>12</td>

                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="m-portlet__body">
                          <div class="form-group m-form__group">
                            <input type="hidden" id="sua_lop_id">
                            <label for="exampleInputEmail1">Số lượng học sinh nam</label>
                            <input type="number" name="ten_lop" class="form-control m-input m-input--square"
                              id="nhap_hoc_sinh_nam_chua_co_lop" value="0" min="0"
                              placeholder="Nhập số lượng học sinh nam">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="m-portlet__body">
                          <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Số lượng học sinh nữ</label>
                            <input type="number" name="ten_lop" class="form-control m-input m-input--square"
                              id="nhap_hoc_sinh_nu_chua_co_lop" value="0" min="0"
                              placeholder="Nhập số lượng học sinh nữ">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <span onclick="xepLop()" class="btn btn-primary">Xếp lớp</span>
                  </div>
                </div>

              </div>
            </div>
            {{-- end modal xếp lớp  --}}

            {{-- start modal chuyển lớp --}}
            <div class="modal fade" id="modal-chuyen-lop" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chuyển lớp </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">

                        <label for="exampleInputPassword1">Học sinh cần chuyển lớp</label>
                        <select style="width: 100%" class="form-control m-select2" id="hoc_sinh_can_chuyen"
                          name="hoc_sinh_can_chuyen[]" multiple="multiple">
                          <option value="">Chọn học sinh</option>
                        </select>

                      </div>
                      <div class="col-md-12 mt-4">

                        <label for="exampleInputEmail1">Chuyển đến lớp</label>
                        <select style="width: 100%" class="form-control" id="id_lop_chuyen">
                          <option>Chọn lớp chuyển đến</option>
                          @foreach ($namhoc->Khoi as $item)
                          <optgroup  age_khoi_lop="{{$item->do_tuoi}}" label="{{$item->ten_khoi}}">
                            @foreach ($item->LopHoc as $item1)
                            <option value="{{$item1->id}}">{{$item1->ten_lop}}</option>
                            @endforeach
                          </optgroup>
                          @endforeach

                        </select>

                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <span onclick="chuyenLop()" class="btn btn-primary">Chuyển lớp</span>
                  </div>
                </div>

              </div>
            </div>
            {{-- end modal chuyển lớp  --}}

            {{-- start modal chuyển lớp --}}
            <div class="modal fade" id="modal-di-hoc-lai" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">

                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="m-form__group form-group row">
                          <div class="col" style="color:#4CAF50"><b>Lý do: <span id="ly_do_thoi_hoc"></span></b></div>
                        </div>
                      </div>
                      <div class="col-md-12 mt-4">
                        <div class="m-form__group form-group row">
                          <label class="col-3 col-form-label" style="color:#4CAF50"><b>Đi học lại</b></label>
                          <div class="col-6">
                            <span class="m-switch m-switch--outline m-switch--success">
                              <label>
                                <input onchange="DiHocLai()" type="checkbox" name="">
                                <span></span>
                              </label>
                            </span>
                          </div>
                        </div>

                      </div>
                      <div class="col-md-12 mt-4" style="display: none" id="chon_lop_hoc_lai">
                        <div class="m-form__group form-group row">
                          <input type="hidden" id="id_hoc_sinh_nghi_hoc">
                          <label class="col-3 col-form-label" style="color:#4CAF50;"><b>Chọn lớp</b></label>
                          <div class="col-6">
                            <select class="form-control m-input" id="danh_sach_lop_hoc_lai">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button onclick="xacNhanDiHocLai()" style="display: none" id="xac_nhan_di_hoc_lai"
                      class="btn btn-primary">Xác nhận đi học lại</button>
                  </div>
                </div>

              </div>
            </div>
            {{-- end modal chuyển lớp  --}}
            <!--begin::Item-->
            <div id="danh_sach_khoi_lop">
              @foreach ($namhoc->Khoi as $item)
              <div class="m-accordion__item ">
                <div class="m-accordion__item-head collapsed" role="tab" id="tab{{$item->id}}_item_1_head"
                  data-toggle="collapse" href="#tab{{$item->id}}_item_1_body" aria-expanded="false">
                  <span class="m-accordion__item-mode "></span>&nbsp;&nbsp;&nbsp;&nbsp;
                  <span class="m-accordion__item-title">{{$item->ten_khoi}} ({{config('common.do_tuoi')[$item->do_tuoi]}})</span>
                  <div class="dropdown">
                    @if ($namhoc->type ==1)
                    <i style="cursor: pointer;font-size: 25px;" class="la la-ellipsis-v" id="dropdownMenuButton"
                      data-toggle="dropdown" aria-haspopup="true"></i>
                    @endif
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <span class="dropdown-item" data-toggle="modal" onclick="getDataSuaKhoi({{$item->id}})"
                        data-target="#modal-sua-khoi"><i class="flaticon-edit-1"></i> Sửa</span>
                      <span class="dropdown-item" onclick="deleteKhoi({{$item->id}})"><i
                          class="flaticon-delete"></i>Xóa</span>
                      <span class="dropdown-item" data-toggle="modal" onclick="getIdKhoi({{$item->id}})"
                        data-target="#modal-add-lop"><i class="flaticon-add"></i> Thêm lớp</span>
                    </div>
                  </div>
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
                              <li class="m-nav__item pl-4 lop_hoc" onclick="addColor(this)" id='lop_{{$lop_hoc->id}}'
                                style="cursor: pointer">
                                <span href="" class="m-nav__link">
                                  <span onclick="showHocSinhCuaLop({{$lop_hoc->id}})" class="m-nav__link-text "> <span
                                      class="ten_lop"> {{$lop_hoc->ten_lop}} </span>
                                    <span
                                      class="sl_hs_cua_lop">({{$namhoc->type ==1 ? $lop_hoc->tong_so_hoc_sinh : $lop_hoc->tong_so_hoc_sinh_lop_cu }})</span></span>
                                  <div class="dropdown">
                                    <i style="cursor: pointer;font-size: 25px;" class="la la-ellipsis-v"
                                      id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                      aria-expanded="false"></i>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      @if ($namhoc->type == 1)
                                      <span class="dropdown-item" data-toggle="modal" data-target="#modal-cap-nhat-lop"
                                        onclick="getDataCapNhatLop({{$lop_hoc->id}})"><i class="flaticon-edit-1"></i>
                                        Sửa</span>
                                      <span class="dropdown-item" onclick="deleteLop({{$lop_hoc->id}})"><i
                                          class="flaticon-delete"></i>Xóa</span>
                                      @endif
                                      <a target="_blank" href="{{ route('quan-ly-lop-show',['id'=>$lop_hoc->id]) }}"
                                        class="dropdown-item"><i class="flaticon-paper-plane"></i>Chi tiết</a>
                                    </div>
                                  </div>
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
            @if ($namhoc->type == 1)
            <div class="m-accordion__item" onclick="getDataHsChuaCoLop(0)">
              <div class="m-accordion__item-head collapsed" role="tab" id="hoc-sinh-chua-co-tuoi"
                data-toggle="collapse">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="m-accordion__item-title">Học sinh mới tuyển sinh (<span
                  id="hoc_sinh_moi_tuyen_sinh">{{$sl_hs_type[0]}}</span>)</span>
              </div>
            </div>
            <div class="m-accordion__item" onclick="getDataHsChuaCoLop(1)">
              <div class="m-accordion__item-head collapsed" role="tab" id="hoc-sinh-chua-co-tuoi"
                data-toggle="collapse">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="m-accordion__item-title">Học sinh đang theo học chưa có lớp (<span
                  id="hoc_sinh_dang_hoc_chua_co_lop">{{$sl_hs_type[1]}}</span>)</span>
              </div>
            </div>
            <div class="m-accordion__item" onclick="getDataHsChuaCoLop(2)">
              <div class="m-accordion__item-head collapsed" role="tab" data-toggle="collapse">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="m-accordion__item-title">Học sinh thôi học (<span
                    id="hoc_sinh_thoi_hoc">{{$sl_hs_type[2]}}</span>) </span>
              </div>
            </div>

            @endif
            <div class="m-accordion__item" onclick="getDataHsChuaCoLop(3)">
              <div class="m-accordion__item-head collapsed" role="tab" id="hoc-sinh-chua-co-tuoi"
                data-toggle="collapse">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="m-accordion__item-title">Học sinh tốt nghiệp ({{$sl_hs_type[3]}})</span>
              </div>
            </div>
          </div>
          <!--end::Section-->
          {{-- </div> --}}
        </div>
      </div>
      <div class="col-md-9 table-responsive scoll-table">
        <div class="m-portlet chuc-nang-lop">
          <div class="m-portlet__head d-flex justify-content-end">
            <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                @if ($namhoc->type == 1)
                <button type="button" style="display: none" id="button_chuyen_lop"
                  class="btn m-btn m-btn--gradient-from-success m-btn--gradient-to-accent mr-3" data-toggle="modal"
                  data-target="#modal-chuyen-lop" onclick="getDataHocSinhChuyen()">Chuyển lớp</button>

                <button type="button" style="display: none" id="button_xep_lop"
                  class="btn m-btn m-btn--gradient-from-success m-btn--gradient-to-accent mr-3" data-toggle="modal"
                  data-target="#modal-chuyen-lop" trang_thai_hoc_sinh = "" onclick="xepLopThuCong()">Xếp lớp</button>

                <button style="display: none" type="button" id="button_xep_lop_tu_dong"
                  onclick="showSlHocSinhChuaCoLop()" data-toggle="modal" data-target="#modal-xep-lop-tu-dong"
                  class="btn btn-secondary">Xếp
                  lớp tự động</button>
                @endif
              </div>
            </div>
          </div>
          <table id="table-hoc-sinh" class="table table-striped table-bordered m-table thong-tin-hoc-sinh-cua-lop">
            <thead>
              <tr>
                <th style="width: 5%;"><input type="checkbox" id="" onclick="checkAll(this)"></th>
                <th style="width: 10%;">Stt</th>
                <th style="width: 15%;">Mã học sinh</th>
                <th style="width: 20%;">Họ tên</th>
                <th style="width: 15%;">Ngày sinh</th>
                <th style="width: 15%;">Giới tính</th>
                <th>Chi tiết</th>
                <th id="fidel_thoi_hoc">Thôi học</th>
              </tr>
            </thead>
            <thead class="filter">
              <tr>
                <td scope="row"><input class="form-control search m-input  " type="hidden"></td>
                <td scope="row"><input class="form-control search m-input " type="hidden"></td>
                <td scope="row"><input class="form-control search m-input search-mahs" type="text"></td>
                <td scope="row"><input class="form-control search m-input search-ten" type="text"></td>
                <td scope="row"><input class="form-control search m-input search-ngaysinh" type="text"></td>
                <td scope="row">
                  <select class="form-control search m-input search-gioitinh m-input--square" id="exampleSelect1">
                    <option value="">Chọn</option>
                    <option>Nam</option>
                    <option>Nữ</option>
                  </select>
                </td>

                <td scope="row"><input class="search8" style="width: 70px;" type="hidden"></td>
                <td scope="row"><input class="search8" style="width: 70px;" type="hidden"></td>
                {{-- <td scope="row"><input class="search9" style="width: 70px;" type="text"></td> --}}
              </tr>
            </thead>
            <tbody id="show-data-hoc-sinh">
              {{-- @if (count($hocsinh)>0)
            @php
            $i = 1;
            @endphp
            @endif
            @foreach ($hocsinh as $item)
            <tr>
              <th><input class="checkbox" type="checkbox" id=""></th>
              <th scope="row">{{$i++}}</th>
              <td>{{$item->ma_hoc_sinh}}</td>
              <td>{{$item->ten}}</td>
              <td>{{$item->ngay_sinh}}</td>
              <td>{{ config('common.gioi_tinh')[$item->gioi_tinh] }}</td>
              <td><a class="btn btn-secondary style-button" href="{{route('quan-ly-hoc-sinh-edit',['id'=>1])}}">Cập
                  nhật</a>
                <a class="btn btn-secondary style-button" href="{{route('quan-ly-hoc-sinh-edit',['id'=>1])}}">Xóa</a>
              </td>
              </tr>
              @endforeach --}}

            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  const html_danh_sach_lop = $('#id_lop_chuyen').html();
  var dtable;
  $(document).ready( function () {
         dtable= $('#table-hoc-sinh').DataTable( {
        'paging': false,
        "aoColumnDefs": [
             { "bSortable": false, "aTargets": [ 0, 6 ] }, 
         ]
         }
    );
        $('.search-mahs').on('keyup change', function() {
        dtable
        .column(2).search(this.value)
        .draw();
        });
    
        $('.search-ten').on('keyup change', function() {
        dtable
        .column(3).search(this.value)
        .draw();
        });
        
        $('.search-gioitinh').on('change', function() {
        dtable
        .column(5).search(this.value)
        .draw();    
        });

        $('.search-ngaysinh').on('keyup change', function() {
        dtable
        .column(4).search(this.value)
        .draw();
        });
    });


</script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  const checkAll = (e) => {
    $(e).parents('table').find('.checkbox').not(e).prop('checked', e.checked);
  };
    axios.interceptors.request.use(function(config) {
    // Do something before request is sent
    $('#preload').show()
    return config;
  }, function(error) {
    // Do something with request error
    return Promise.reject(error);
  });

  axios.interceptors.response.use(function(response) {
    // Do something with response data
    $('#preload').hide()


    return response;
  }, function(error) {
    // Do something with response error
    $('#preload').hide()
    console.log('Error fetching the data');
    return Promise.reject(error);
  });
  //click add mau lop

var slHsCuaLop = 0;
const addColor = (e) =>{
  var list_element_lop = document.querySelectorAll('.lop_hoc')
  list_element_lop.forEach(element => {
    $(element).css('background','transparent')
  });
  $(e).css('background','#bafac8')
}

//start route khối
var url_create_khoi = "{{route('quan-ly-khoi-post_create')}}";
var url_find_khoi = "{{route('quan-ly-khoi-show')}}";
var url_update_khoi = "{{route('quan-ly-khoi-update')}}";
var url_destroy_khoi = "{{route('quan-ly-khoi-destroy')}}";
// end route khối

//start route lớp
var url_store_lop = "{{route('quan-ly-lop-phan-store')}}";
var url_get_data_lop = "{{route('quan-ly-lop-edit')}}";
var url_update_lop = "{{route('quan-ly-lop-update')}}";
var url_giao_vien_chua_co_lop = "{{route('quan-ly-giao-vien-chua-co-lop')}}";
var url_destroy_lop = "{{route('quan-ly-lop-destroy')}}";
var url_xep_lop_tu_dong = "{{route('quan-ly-lop-xep-lop-tu-dong')}}";


// end route lớp

//start route hoc sinh
var url_get_hs_lop = "{{route('quan-ly-lop-show-data-hoc-sinh')}}";
var url_get_field_hoc_sinh_type = "{{route('quan-ly-lop-show-data-hoc-sinh-type',['id'])}}";
var url_get_hs_chua_co_lop = "{{route('quan-ly-hoc-sinh-chua-co-lop')}}";
var url_chuyen_lop = "{{route('quan-ly-hoc-sinh-chuyen-lop')}}";
var url_thoi_hoc = "{{route('quan-ly-hoc-sinh-thoi-hoc')}}";
var url_get_hoc_sinh_tot_nghiep = "{{route('hoc_sinh_tot_nghiep_theo_nam',['id'])}}";

var url_get_thong_tin_thoi_hoc = "{{route('get-thong-tin-hoc-sinh-thoi-hoc')}}"
var url_xac_nhan_hoc_sinh_di_hoc_lai = "{{route('xac-nhan-hoc-sinh-di-hoc-lai')}}"

//end route hoc sinh

// start crud khối
const addKhoi = () => {
 
    axios.post(url_create_khoi, {
      'ten_khoi': $('#ten_khoi').val(),
      'do_tuoi': $('#do_tuoi').val(),
      'nam_hoc_id': $('#nam_hoc').val()
    })
    .then(function (response) {
      console.log(response.data)
      $('#danh_sach_khoi_lop').append(`
      <div class="m-accordion__item">
        <div class="m-accordion__item-head collapsed" role="tab" id="tab${response.data}_item_1_head" data-toggle="collapse" href="#tab${response.data}_item_1_body" aria-expanded="false">
                <span class="m-accordion__item-mode "></span>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="m-accordion__item-title">${$('#ten_khoi').val()} (${$('#do_tuoi option:selected').text()} tuổi)</span>  
                <div class="dropdown">
                  <i style="cursor: pointer;font-size: 25px;" class="la la-ellipsis-v" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true"></i>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <span class="dropdown-item" data-toggle="modal" onclick="getDataSuaKhoi(${response.data})"
                      data-target="#modal-sua-khoi"><i class="flaticon-edit-1"></i> Sửa</span>
                    <span class="dropdown-item" onclick="deleteKhoi(${response.data})"><i class="flaticon-delete"></i> Xóa</span>
                    <span class="dropdown-item" data-toggle="modal"  data-target="#modal-add-lop" onclick="getIdKhoi(${response.data})"><i class="flaticon-add"></i>Thêm lớp</span>
                  </div>
                </div>
            </div>
            <div class="m-accordion__item-body collapse" id="tab${response.data}_item_1_body" role="tabpanel" aria-labelledby="tab${response.data}_item_1_head" >
                <div class="">
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--left"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav">                               
                                    </ul>
                                    <!--end::Nav-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      `)
      $('#modal-add-khoi').modal('hide')
      Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Thêm khối thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
        
                    )
    })
    .catch(function (error) {
      $('.error').html('')
      $('.error-do-tuoi').html(error.response.data.errors.do_tuoi)
      $('.error-ten-khoi').html(error.response.data.errors.ten_khoi)
    });
};

const getDataSuaKhoi = (id) =>{
  axios.post(url_find_khoi, {
      'id': id,
    })
    .then(function (response) {
      $('#id_khoi_sua').val(response.data.id)
      $('#sua_ten_khoi').val(response.data.ten_khoi)
      $('#sua_do_tuoi').val(response.data.do_tuoi)
     
    })
    .catch(function (error) {
      console.log(error);
    });
};

const capNhatKhoi = (id) =>{
  axios.post(url_update_khoi, {
      'id':$('#id_khoi_sua').val(),
      'ten_khoi': $('#sua_ten_khoi').val(),
      'do_tuoi': $('#sua_do_tuoi').val(),
    })
    .then(function (response) {
     var id_box_khoi_update = 'tab'+$('#id_khoi_sua').val()+'_item_1_head'
     var testgetid = $(`#${id_box_khoi_update}`).find('.m-accordion__item-title').html(`${response.data.ten_khoi} (${response.data.do_tuoi+" tuổi"})`)
     $('#modal-sua-khoi').modal('hide')
     Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Cập nhật thành công!',
          showConfirmButton: false,
          timer: 1500
      }).then(
          
          )
    })
    .catch(function (error) {
      $('.error-update-ten-khoi').html(error.response.data.errors.ten_khoi)
      console.log(error);
    });
};

const deleteKhoi = (id) =>{
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
        axios.post(url_destroy_khoi,{
            'id': id
          }).then(function(response){
        var id_box_khoi_update = 'tab'+id+'_item_1_head'
        $(`#${id_box_khoi_update}`).parents('.m-accordion__item').remove();
        Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Xóa thành công!',
              showConfirmButton: false,
              timer: 1500
          }).then(
          
              )
      })
      }
  })
};
// end crud khối

// start show học sinh theo lớp
var gioi_tinh = {!! json_encode(config('common.gioi_tinh')) !!}
const showHocSinhCuaLop = (id) => {

  axios.post(url_get_hs_lop, {
      'id': id,
      'nam_hoc':$('#nam_hoc').val()
    })
    .then(function (response) {
      // console.log(gioi_tinh.1)
      var html_thong_tin_hs = "";
      var i = 1;
      var trang_thai_nam_hoc = response.data.type_namhoc
      response.data.hoc_sinh_cua_lop.forEach(element => {
        var route_chi_tiet_hoc_sinh = "{{route('quan-ly-hoc-sinh-edit',['id'])}}"
        var route_chi_tiet_hoc_sinh_new = route_chi_tiet_hoc_sinh.replace('id',element.id)
        var html_thoi_hoc = ''
        if (trang_thai_nam_hoc == 1) {
           html_thoi_hoc = `<i style='color:blue' onclick="setThoiHoc(${element.id},${id})" class="fab fa-expeditedssl"></i>`
        }
        
        html_thong_tin_hs+=`
        <tr>
              <th><input class="checkbox" type="checkbox" id_hs="${element.id}"></th>
              <th scope="row">${i++}</th>
              <td>${element.ma_hoc_sinh}</td>
              <td>${element.ten}</td>
              <td>${element.ngay_sinh}</td>
              <td>${Object.values(gioi_tinh)[element.gioi_tinh]}</td>
              <td style="text-align: center;"> <a  href="${route_chi_tiet_hoc_sinh_new}"><i class="flaticon-paper-plane"></i></a>
              </td>
              <td style="text-align: center;cursor: pointer;"> ${html_thoi_hoc}
              </td>  
            </tr>
        `
      });
      dtable.destroy();
     $('#show-data-hoc-sinh').html(html_thong_tin_hs);
    
    dtable= $('#table-hoc-sinh').DataTable( {
        'paging': false,
        "aoColumnDefs": [
             { "bSortable": false, "aTargets": [ 0, 6 ] }, 
         ]
         }
    );
        $('.search-mahs').on('keyup change', function() {
        dtable
        .column(2).search(this.value)
        .draw();
        });
    
        $('.search-ten').on('keyup change', function() {
        dtable
        .column(3).search(this.value)
        .draw();
        });
        
        $('.search-gioitinh').on('change', function() {
        dtable
        .column(5).search(this.value)
        .draw();    
        });

        $('.search-ngaysinh').on('keyup change', function() {
        dtable
        .column(4).search(this.value)
        .draw();
        });
        $('#button_xep_lop_tu_dong').css('display','block')
        $('#button_chuyen_lop').css('display','block')
        $('#button_xep_lop').css('display','none')
        $('#hoc_sinh_can_chuyen').attr('disabled',false)
        // console.log($('#button_xep_lop_tu_dong').css())
        $('#id_lop_xep').val(id)
        slHsCuaLop = response.data.hoc_sinh_cua_lop.length
    })
    .catch(function (error) {
      console.log(error);
    });
};


const getDataHsChuaCoLop = (type) =>{
  if(type == 3){
    var url_get_field_hoc_sinh_type_new = url_get_hoc_sinh_tot_nghiep.replace('id',$('#nam_hoc').val())
  }else{
    var url_get_field_hoc_sinh_type_new = url_get_field_hoc_sinh_type.replace('id',type)
  }

  axios.get(url_get_field_hoc_sinh_type_new)
    .then(function (response) {
      if(type==2){ 
        $('#fidel_thoi_hoc').html('Lý do')
      }
      var html_thong_tin_hs = "";
      var i = 1;
      response.data.forEach(element => {
        var route_chi_tiet_hoc_sinh = "{{route('quan-ly-hoc-sinh-edit',['id'])}}"
        var route_chi_tiet_hoc_sinh_id = route_chi_tiet_hoc_sinh.replace('id',element.id)
        html_thong_tin_hs+=`
        <tr>
              <th><input class="checkbox" type="checkbox" age="${element.age}" id_hs="${element.id}"></th>
              <th scope="row">${i++}</th>
              <td>${element.ma_hoc_sinh}</td>
              <td>${element.ten}</td>
              <td>${element.ngay_sinh}</td>
              <td>${Object.values(gioi_tinh)[element.gioi_tinh]}</td>
              <td style="text-align: center;"> <a target="_blank"  href="${route_chi_tiet_hoc_sinh_id}"><i class="flaticon-paper-plane"></i></a>
              </td>
              <td style="text-align: center;">
              `
              if(type==2){ 
                html_thong_tin_hs+=`<span data-toggle="modal" data-target="#modal-di-hoc-lai" style="cursor: pointer;" onclick="diHocLai(${element.id})" ><i class="fab fa-stack-exchange"></i></span>`
              }
          html_thong_tin_hs+=  `
              </td>
        </tr>
        `
      });
      dtable.destroy();
     $('#show-data-hoc-sinh').html(html_thong_tin_hs);
    
      dtable= $('#table-hoc-sinh').DataTable( {
          'paging': false,
          "aoColumnDefs": [
              { "bSortable": false, "aTargets": [ 0, 6 ] }, 
          ]
          }
      );
        $('.search-mahs').on('keyup change', function() {
        dtable
        .column(2).search(this.value)
        .draw();
        });
    
        $('.search-ten').on('keyup change', function() {
        dtable
        .column(3).search(this.value)
        .draw();
        });
        
        $('.search-gioitinh').on('change', function() {
        dtable
        .column(5).search(this.value)
        .draw();    
        });

        $('.search-ngaysinh').on('keyup change', function() {
        dtable
        .column(4).search(this.value)
        .draw();
        });
        $('#button_xep_lop_tu_dong').css('display','none')
        $('#button_chuyen_lop').css('display','none')
        if(type==1){ 
          $('#button_xep_lop').attr('trang_thai_hoc_sinh',1)
          $('#button_xep_lop').css('display','block')
      }
      if(type==0){ 
        $('#button_xep_lop').attr('trang_thai_hoc_sinh',0)
          $('#button_xep_lop').css('display','block')
      }
        $('#id_lop_xep').val(0)
        
    })
    .catch(function (error) {
      console.log(error);
    });
}
// end show học sinh theo lớp
// start quản lý lớp crud
$('#id_giao_vien_cn').select2();
$('#id_giao_vien_phu').select2();
$('#id_giao_vien_cn').change(() => {
    var id_giao_vien_cn = $('#id_giao_vien_cn').val()
    if (id_giao_vien_cn > 0) {
        $('#id_giao_vien_phu').removeAttr('disabled')
        var list_giao_vien_phu = document.querySelectorAll('#id_giao_vien_phu option')
        list_giao_vien_phu.forEach(element => {
            $(element).removeAttr('disabled')
            if (id_giao_vien_cn == $(element).val()) {
                $(element).attr('disabled', true)
                $("#id_giao_vien_phu").select2("destroy");
                $("#id_giao_vien_phu").select2();
                $("#id_giao_vien_phu").select2().val('').trigger('change');
            }
        })
    } else {
        $("#id_giao_vien_phu").select2().val('').trigger('change');
        $('#id_giao_vien_phu').attr('disabled', true)
    }
});

const getIdKhoi = (id) => {
  var html_giao_vien=""
  axios.get(url_giao_vien_chua_co_lop)
  .then(function (response) {
  response.data.forEach(element => {
  html_giao_vien+=`
    <option value="${element.id}">${element.ten}</option>
  `
  });
  $('#id_giao_vien_cn').append(html_giao_vien)
  $('#id_giao_vien_phu').append(html_giao_vien)

  
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });
  $('#khoi_id').val(id)
};
const addLop = () =>{
  axios.post(url_store_lop, {
      'khoi_id': $('#khoi_id').val(),
      'ten_lop': $('#ten_lop').val(),
      'giao_vien_cn': $('#id_giao_vien_cn').val(),
      'giao_vien_phu': $('#id_giao_vien_phu').val()
    })
    .then(function (response) {
      $('#modal-add-lop').modal('hide')
     
      var id_box_khoi_them_lop = 'tab'+$('#khoi_id').val()+'_item_1_body'
      console.log(id_box_khoi_them_lop)
      var route_chi_tiet_lop ="{{ route('quan-ly-lop-show',['id']) }}"
      var route_chi_tiet_lop_id =route_chi_tiet_lop.replace('id',response.data.id)
      $(`#${id_box_khoi_them_lop}`).find('ul').append(`
      <li class="m-nav__item pl-4 lop_hoc" onclick="addColor(this)" id='lop_${response.data.id}' style="cursor: pointer">
        <span href="" class="m-nav__link">
          <span onclick="showHocSinhCuaLop(${response.data.id})" class="m-nav__link-text ten_lop">${response.data.ten_lop}
            <span class="sl_hs_cua_lop">(0)</span></span>
          <div class="dropdown">
            <i style="cursor: pointer;font-size: 25px;" class="la la-ellipsis-v" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <span class="dropdown-item" data-toggle="modal" data-target="#modal-cap-nhat-lop" onclick="getDataCapNhatLop(${response.data.id})"><i class="flaticon-edit-1"></i> Sửa</span>
              <span class="dropdown-item" onclick="deleteLop(${response.data.id})"><i class="flaticon-delete"></i>Xóa</span>
              <a target="_blank" href="${route_chi_tiet_lop_id}" class="dropdown-item"><i class="flaticon-paper-plane"></i>Chi tiết</a>
            </div>
          </div>
        </span>
      </li>
      `)
      $('#khoi_id').val('')
        $('#ten_lop').val('')
        $('#id_giao_vien_cn').val('').trigger("change")
        $('#id_giao_vien_phu').val('').trigger("change")
      Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Tạo lớp mới thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                )

        
    })
    .catch(function (error) {
      $('.error-ten-lop').html(error.response.data.errors.ten_lop)
     
    });
};

//start show data lop edit 
$('#id_sua_giao_vien_cn').select2();
    $('#id_sua_giao_vien_phu').select2();
    $('#id_sua_giao_vien_cn').change(() => {
        var id_sua_giao_vien_cn = $('#id_sua_giao_vien_cn').val()
        var danh_sach_giao_vien_phu = $('#id_sua_giao_vien_phu').val()
        var pos = danh_sach_giao_vien_phu.indexOf(id_sua_giao_vien_cn);
        danh_sach_giao_vien_phu.splice(pos, 1);
        $('#id_sua_giao_vien_phu').val(danh_sach_giao_vien_phu).trigger("change");
            $('#id_sua_giao_vien_phu').removeAttr('disabled')
            var list_giao_vien_phu = document.querySelectorAll('#id_sua_giao_vien_phu option')
            list_giao_vien_phu.forEach(element => {
                $(element).removeAttr('disabled')
                if (id_sua_giao_vien_cn == $(element).val()) {
                    $(element).attr('disabled', true)
                    $("#id_sua_giao_vien_phu").select2("destroy");
                    $("#id_sua_giao_vien_phu").select2();
                }
            })
});

const getDataCapNhatLop = (id) =>{
  axios.post(url_get_data_lop, {
      'id': id,
    })
    .then(function (response) {
      console.log(response.data)
      $('#sua_ten_lop').val(response.data.lop.ten_lop)
      $('#sua_lop_id').val(response.data.lop.id)
      
      $('#id_sua_giao_vien_cn').append(htmlGiaoVien(1,response.data.giao_vien_phu,response.data.giao_vien_cn,response.data.giao_vien))
      $('#id_sua_giao_vien_phu').html(htmlGiaoVien(2,response.data.giao_vien_phu,response.data.giao_vien_cn,response.data.giao_vien))
      
    })
    .catch(function (error) {
      console.log(error);

    });
};

const htmlGiaoVien = (type,giao_vien_phu,giao_vien_cn,giao_vien) =>{
      var html_giao_vien_cn = '';
      var html_giao_vien_phu = '';
      var html_giao_vien = '';
      var select_cn = '';
      var select_phu = '';

      if(type==1){
        select_cn = 'selected'
      }else{
        select_phu = 'selected'
      }
      giao_vien_phu.forEach(element => {
        html_giao_vien_phu+=`
        <option ${select_phu} value="${element.id}">${element.ten}</option>
        `
      });

      giao_vien.forEach(element => {
        html_giao_vien+=`
        <option value="${element.id}">${element.ten}</option>
        `
      });
      if(giao_vien_cn == null){
        html_giao_vien_cn_phu =+html_giao_vien_phu+html_giao_vien
      }else{
        html_giao_vien_cn_phu =`<option ${select_cn} value="${giao_vien_cn.id}">${giao_vien_cn.ten}</option>`+html_giao_vien_phu+html_giao_vien

      }


      return html_giao_vien_cn_phu;
};
// end show data lop edit

const suaLop = () =>{
  axios.post(url_update_lop, {
      'lop_id': $('#sua_lop_id').val(),
      'ten_lop': $('#sua_ten_lop').val(),
      'giao_vien_cn': $('#id_sua_giao_vien_cn').val(),
      'giao_vien_phu': $('#id_sua_giao_vien_phu').val()
    })
    .then(function (response) {
      var id_box_lop = 'lop_'+$('#sua_lop_id').val()
      $(`#${id_box_lop}`).find('.ten_lop').html($('#sua_ten_lop').val())
      $('#modal-cap-nhat-lop').modal('hide')
    })
    .catch(function (error) {
      $('.error-update-ten-lop').html(error.response.data.errors.ten_lop)
    });
};


const deleteLop = (id) =>{
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
        axios.post(url_destroy_lop,{
            'id': id
          }).then(function(response){
        var id_box_lop_update = 'lop_'+id
        $(`#${id_box_lop_update}`).remove();
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Xóa thành công!',
        showConfirmButton: false,
        timer: 1500
    }).then(
        )
      })
      }
  })
};
// end quản lý lớp crud

//start xếp lớp cho sinh viên
const showSlHocSinhChuaCoLop = () =>{
  axios.post(url_get_hs_chua_co_lop,
    {
      id:  $('#id_lop_xep').val()
    }
  )
  .then(function (response) {
    $('.so_hs_nam').html('Nam: '+response.data.hoc_sinh_nam_chua_co_lop)
    $('.so_hs_nu').html('Nữ: '+response.data.hoc_sinh_nu_chua_co_lop)
    $('.so_hs').html(response.data.hoc_sinh_nu_chua_co_lop+response.data.hoc_sinh_nam_chua_co_lop)
    $('#xep-lop-show-ten-lop').html(response.data.ten_lop) 
    $('#xep-lop-show-sl-hs').html(response.data.tong_so_hs) 
    var html_chua_co_lop_theo_tuoi = '';
    response.data.data_hs_chua_co_lop.forEach(element => {
        html_chua_co_lop_theo_tuoi += ` <tr> <th scope="row">${element.do_tuoi}</th> <td>${element.nam}</td> <td>${element.nu}</td> </tr> `
    });
    $("#hoc-sinh-chua-co-lop-theo-do-tuoi").html(html_chua_co_lop_theo_tuoi)
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });
};
$('#hoc_sinh_can_chuyen').select2()
// $('#id_lop_chuyen').select2()
const xepLop = () =>{
  axios.post(url_xep_lop_tu_dong,{
    'id_lop' : $('#id_lop_xep').val(),
    'sl_hs_nam' : $('#nhap_hoc_sinh_nam_chua_co_lop').val(),
    'sl_hs_nu' : $('#nhap_hoc_sinh_nu_chua_co_lop').val()
  })
  .then(function (response) {
    $('#hoc_sinh_moi_tuyen_sinh').html(`${response.data.sl_hs_moi_tuyen_sinh}`)
    $('#hoc_sinh_dang_hoc_chua_co_lop').html(`${response.data.sl_hs_dang_hoc_chua_co_lop}`)
    showHocSinhCuaLop($('#id_lop_xep').val())
    var component_lop = 'lop_'+$('#id_lop_xep').val()
    $(`#${component_lop}`).find('.sl_hs_cua_lop').html(`(${response.data.sl_hs_cua_lop})`)
    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Xếp lớp thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                   
                    )
        $('#modal-xep-lop-tu-dong').modal('hide')
  })
  .catch(function (error) {
    if (error.response.status == 422) {
      Swal.fire({
        icon: 'error',
        text: `Số lượng học sinh ${error.response.data.gioi_tinh} chỉ còn lại ${error.response.data.sl_hs_con_lai} học sinh`,
      }) 
    }else{
      Swal.fire({
        icon: 'error',
        text: `Số lượng học sinh bạn nhập không hợp lệ`,
      })
    }
   

  })
  .then(function () {
   

    // always executed
  });
};
//end xếp lớp cho sinh viên

const getDataHocSinhChuyen = () =>{
  axios.post(url_get_hs_lop, {
      'id': $('#id_lop_xep').val(),
      'nam_hoc':$('#nam_hoc').val()
    })
  .then(function (response) {
    var html_danh_sach_hs="";
    var html_danh_sach_lop="<option value=''>Chọn lớp chuyển đến</option>";
    response.data.hoc_sinh_cua_lop.forEach(element => {
      html_danh_sach_hs+=`
      <option value="${element.id}">${element.ma_hoc_sinh}-${element.ten}</option>
      `
    });
    response.data.danh_sach_lop.forEach(element => {
      html_danh_sach_lop+=`
      <option value="${element.id}">${element.ten_lop}</option>
      `
    });
    $('#hoc_sinh_can_chuyen').html(html_danh_sach_hs)
    $('#id_lop_chuyen').html(html_danh_sach_lop)
    var hoc_sinh_muon_xep =[];
    var check = document.querySelectorAll(".checkbox");
    for (let index = 0; index < check.length; index++) {
        if (check[index].checked) {
            console.log(check[index])
            id_hoc_sinh_can_chuyen = check[index].getAttribute("id_hs");
            hoc_sinh_muon_xep.push(id_hoc_sinh_can_chuyen)
        }
    }
    $('#hoc_sinh_can_chuyen').val(hoc_sinh_muon_xep).trigger("change")
  })
  .catch(function (error) {
    console.log(error);
  });
 
};

const chuyenLop = () =>{
  axios.post(url_chuyen_lop, {
      'lop_id_chuyen': $('#id_lop_chuyen').val(),
      'lop_id': $('#id_lop_xep').val(),
      'id_hs_chuyen_lop':$('#hoc_sinh_can_chuyen').val(),
      'trang_thai_hoc_sinh':$('#button_xep_lop').attr('trang_thai_hoc_sinh')
    })
  .then(function (response) {
    $('#modal-chuyen-lop').modal('hide')
    
    var component_lop_chuyen = 'lop_'+$('#id_lop_chuyen').val()
    $(`#${component_lop_chuyen}`).find('.sl_hs_cua_lop').html(`(${response.data.sl_hs_cua_lop_chuyen_den})`)
    if($('#id_lop_xep').val() != 0){
      var component_lop = 'lop_'+$('#id_lop_xep').val()
      $(`#${component_lop}`).find('.sl_hs_cua_lop').html(`(${response.data.sl_hs_cua_lop_hien_tai})`)
      showHocSinhCuaLop($('#id_lop_xep').val())
    }else{
      if ($('#button_xep_lop').attr('trang_thai_hoc_sinh')==1) {
        getDataHsChuaCoLop(1)
        $('#hoc_sinh_dang_hoc_chua_co_lop').html(`${response.data.sl_hs_cua_lop_hien_tai}`)   
      }else{
        getDataHsChuaCoLop(0)
        $('#hoc_sinh_moi_tuyen_sinh').html(`${response.data.sl_hs_cua_lop_hien_tai}`)   
      }
      
      // getDataHsChuaCoLop(0)
     
    }
 
    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Chuyển lớp thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                   
                    )
  })
  .catch(function (error) {
    console.log(error);
  });
};

const setThoiHoc = (id,id_lop) =>{
  Swal.fire({
  title: 'Bạn có chắc chắn cho học sinh này thôi học?',
  text: "Lý do cho học sinh thôi học!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Tôi đồng ý!',
  input: 'text',
}).then((result) => {
  if(result.value){
    axios.post(url_thoi_hoc,{
      'id' : id,
      'ly_do_thoi_hoc' : result.value
    })
  .then(function (response) { 
    var slHs = showHocSinhCuaLop(id_lop)
    var component_lop = 'lop_'+$('#id_lop_xep').val()
    $(`#${component_lop}`).find('.sl_hs_cua_lop').html(`(${slHsCuaLop-1})`)
    var slHocSinhThoiHoc = Number($('#hoc_sinh_thoi_hoc').html())
    $('#hoc_sinh_thoi_hoc').html(slHocSinhThoiHoc+1)
    $('#modal-xep-lop-tu-dong').modal('hide')
    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Xác nhận cho học sinh thôi học!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                   
                    )
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  }
})
};

const diHocLai = (id) =>{
  axios.post(url_get_thong_tin_thoi_hoc,{
      'id' : id
    })
  .then(function (response) { 
    $('#id_hoc_sinh_nghi_hoc').val(id)
   $('#ly_do_thoi_hoc').html(response.data.ly_do_thoi_hoc)
   var html_lop_hoc_lai_cua_hoc_sinh = '';
   response.data.lop_hoc.forEach(element => {
    html_lop_hoc_lai_cua_hoc_sinh+=
    `<option value = "${element.id}">${element.ten_lop}</option>` 
   });
   $('#danh_sach_lop_hoc_lai').html(html_lop_hoc_lai_cua_hoc_sinh)
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
};

const DiHocLai = ()=>{
  $("#chon_lop_hoc_lai").fadeToggle();
  $("#xac_nhan_di_hoc_lai").fadeToggle();
};

const xacNhanDiHocLai = () =>{
  var id_hs_nghi_hoc = $('#id_hoc_sinh_nghi_hoc').val()
  var lop_chon_hoc_lai = $('#danh_sach_lop_hoc_lai').val()

  axios.post(url_xac_nhan_hoc_sinh_di_hoc_lai,{
      'id_hs_nghi_hoc' : id_hs_nghi_hoc,
      'lop_chon_hoc_lai' : lop_chon_hoc_lai
    })
  .then(function (response) { 
    var element_id_hs = `[id_hs*=${id_hs_nghi_hoc}]`
    $('#modal-di-hoc-lai').modal('hide')
  
    $(`${element_id_hs}`).parents('tr').remove()
    console.log(lop_chon_hoc_lai)
    var component_lop = 'lop_'+lop_chon_hoc_lai
    var sl_hs_hien_tai = $(`#${component_lop}`).find('.sl_hs_cua_lop').html()
    console.log(sl_hs_hien_tai)
    var sl_cat_chuoi = Number(sl_hs_hien_tai.slice(1,3));
    $(`#${component_lop}`).find('.sl_hs_cua_lop').html(`(${sl_cat_chuoi+1})`)
    var slHocSinhThoiHoc = Number($('#hoc_sinh_thoi_hoc').html())
    $('#hoc_sinh_thoi_hoc').html(slHocSinhThoiHoc-1)
    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Xác nhận cho học sinh đi học lại thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                   
                    )
    
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  }) 
};

const xepLopThuCong = () => {
 var trang_thai_hoc_sinh = $('#button_xep_lop').attr('trang_thai_hoc_sinh')
    var url_get_field_hoc_sinh_type_new = url_get_field_hoc_sinh_type.replace('id', trang_thai_hoc_sinh)
    axios.get(url_get_field_hoc_sinh_type_new)
        .then(function(response) {
          var html_danh_sach_hs="";
          response.data.forEach(element => {
            html_danh_sach_hs+=`
            <option value="${element.id}">${element.ma_hoc_sinh}-${element.ten}</option>
            `
          });
          $('#hoc_sinh_can_chuyen').html(html_danh_sach_hs)
          $('#hoc_sinh_can_chuyen').attr('disabled',true)
                var hoc_sinh_muon_xep = [];
                var check = document.querySelectorAll(".checkbox");
                var age = 0
                for (let index = 0; index < check.length; index++) {
                console.log(check[index].getAttribute("age"))

                    if (check[index].checked) {
                      if(hoc_sinh_muon_xep.length == 0){
                        age = check[index].getAttribute("age")
                      }

                      if(age != check[index].getAttribute("age")){
                        Swal.fire({
                          icon: 'error',
                          text: 'Học sinh bạn chọn không cùng độ tuổi vui lòng kiểm tra lại'
                        }).then(function () {
                          $('#modal-chuyen-lop').modal('hide')
                        })
                        
                      }
                      id_hoc_sinh_can_chuyen = check[index].getAttribute("id_hs");
                      hoc_sinh_muon_xep.push(id_hoc_sinh_can_chuyen)
                    }
                }
                $('#hoc_sinh_can_chuyen').val(hoc_sinh_muon_xep).trigger("change")
                $('#id_lop_chuyen').html(html_danh_sach_lop)
                $("#id_lop_chuyen").children("optgroup").hide();
                $(`[age_khoi_lop=${age}]`).css('display','block')
        })
        .catch(function(error) {
            console.log(error)
        });
};




</script>
@endsection
