@extends('layouts.main')
@section('title', 'Quản lý phân lớp cho học sinh')
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
        .m-portlet .m-portlet__body {
    padding: 1.2rem 1.2rem !important;
    
}
.box-left {
    width: 45%;
}
.box-right {
    width: 45%;
}
.box-center {
    width: 10%;
}

    </style>
    {{--
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    --}}
@endsection
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <!--begin::Portlet-->
                
                <!--end::Portlet-->
            </div>
        </div>
        
       
        <div class="m-portlet">
            
        </div>
        <div class="row">
            <div class="box-left">
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                   Danh sách lớp muốn xếp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group row">
                                            <label class="col-lg-4 col-form-label">Năm học:</label>
                                            <div class="col-lg-8">
                                                <select class="custom-select form-control">
													<option selected="">Open this select menu</option>
													<option value="1">One</option>
													<option value="2">Two</option>
													<option value="3">Three</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="" class="col-lg-4 col-form-label">Khối học:</label>
                                            <div class="col-lg-8">
                                                <select class="custom-select form-control">
													<option selected="">Open this select menu</option>
													<option value="1">One</option>
													<option value="2">Two</option>
													<option value="3">Three</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="" class="col-lg-4 col-form-label">Lớp học:</label>
                                            <div class="col-lg-8">
                                                <select class="custom-select form-control">
													<option selected="">Open this select menu</option>
													<option value="1">One</option>
													<option value="2">Two</option>
													<option value="3">Three</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="" class="col-lg-4 col-form-label">Sĩ số:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control m-input" type="text" value="Artisanal kale" id="example-text-input">
                                                
                                            </div>
                                        </div>
                                           
                                            
                                        
                                    </div>
                                    
                                </div>
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="m-portlet__body table-responsive">
                                            <table class="table m-table m-table--head-bg-success">
                                                <div class="col-12 form-group m-form__group d-flex justify-content-end">
                                                 
                                                   
                                                </div>
                                               
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="customCheck1"></th>
                                                        <th> Stt</th>
                                                        <th> Mã số học sinh</th>
                                                        <th> Tên học sinh</th>
                                                        <th> Tuổi</th>
                                                        
                                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($hoc_sinh as $item)
                                                    <tr>
                                                        <td><input type="checkbox" id=""></td>
                                                        <th scope="row">1</th>
                                                    <td>{{$item->ma_hoc_sinh}}</td>
                                                        <td>{{$item->ten}}</td>
                                                       
                                                        <td>
                                                            {{$item->tuoi}}
                                                        </td>
                                                 
                                                       
                                                      
                                                    </tr>
                                                    @endforeach
                                                   
                                               
                                    
                                                </tbody>
                                            </table>
                                      
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Section-->
                    </div>
                </div>
            </div>
            <div class="box-center">
                <button href="#" style="margin-top: 250%" class="btn btn-outline-success m-btn m-btn--icon m-btn--outline-2x m-btn--pill m-btn--air ml-3 btn-sm">
                    <span>
                        <i class="fa fa-arrow-right"></i>
                        <span>Di chuyển</span>
                    </span>
                </button>
                <button href="#" style="margin-top: 20%" class="btn btn-outline-warning m-btn m-btn--icon m-btn--outline-2x m-btn--pill m-btn--air ml-3 btn-sm">
                    <span>
                        <i class="fa fa-sync"></i>
                        <span>Lùi 1 bước</span>
                    </span>
                </button>
            </div>
            <div class="box-right">
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                   Danh sách lớp muốn vào
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group row">
                                            <label class="col-lg-4 col-form-label">Năm học:</label>
                                            <div class="col-lg-8">
                                                <select class="custom-select form-control">
													<option selected="">Open this select menu</option>
													<option value="1">One</option>
													<option value="2">Two</option>
													<option value="3">Three</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="" class="col-lg-4 col-form-label">Khối học:</label>
                                            <div class="col-lg-8">
                                                <select class="custom-select form-control">
													<option selected="">Open this select menu</option>
													<option value="1">One</option>
													<option value="2">Two</option>
													<option value="3">Three</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="" class="col-lg-4 col-form-label">Lớp học:</label>
                                            <div class="col-lg-8">
                                                <select class="custom-select form-control">
													<option selected="">Open this select menu</option>
													<option value="1">One</option>
													<option value="2">Two</option>
													<option value="3">Three</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-4 col-form-label">Sĩ số:</label>
                                            <div class="col-8">
                                                <input class="form-control m-input" type="text" value="Artisanal kale" id="example-text-input">
                                            </div>
                                        </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input" class="col-4 col-form-label">Ngày vào:</label>
                                                    <div class="col-8">
                                                        <input class="form-control m-input" type="text" value="Artisanal kale" id="example-text-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="m-portlet__body table-responsive">
                                        <table class="table m-table m-table--head-bg-success">
                                            <div class="col-12 form-group m-form__group d-flex justify-content-end">
                                             
                                               
                                            </div>
                                           
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="customCheck1"></th>
                                                    <th> Stt</th>
                                                    <th> Mã số học sinh</th>
                                                    <th> Tên học sinh</th>
                                                    <th> Tuổi</th>
                                                    
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($hoc_sinh as $item)
                                                <tr>
                                                    <td><input type="checkbox" id=""></td>
                                                    <th scope="row">1</th>
                                                <td>{{$item->ma_hoc_sinh}}</td>
                                                    <td>{{$item->ten}}</td>
                                                   
                                                    <td>
                                                        {{$item->tuoi}}
                                                    </td>
                                             
                                                   
                                                  
                                                </tr>
                                                @endforeach
                                               
                                           
                                
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Section-->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
<script>
    $('#customCheck1').click(() =>{
        $('#phan-lop').toggle(500)
    })
</script>
@endsection


