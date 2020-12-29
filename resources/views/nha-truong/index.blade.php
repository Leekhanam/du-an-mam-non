@extends('layouts.main')
@section('title', "Thêm thông tin nhà trường")
@section('style')
<style>
    .error {
        color: red;
        padding-left: 13rem;
    }

</style>
@endsection
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab" style="min-height: 550px">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-home-2"></i>
                            </span>
                            <h3 class="m-portlet__head-text m--font-brand">
                                THÔNG TIN TRƯỜNG
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <button
                                    class="m-portlet__nav-link btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--pill"
                                    data-toggle="modal" data-target="#m_modal_4">
                                    <i class="la la-pencil-square"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="col-9">
                        @if ($data)
                        <div class="m-widget13">
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    Tên trường:
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{ $data->name }}
                                </span>
                            </div>
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    Email:
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{ $data->email }}
                                </span>
                            </div>
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    Hotline:
                                </span>
                                <span class="m-widget13__text m-widget13__number-bolder m--font-brand">
                                    {{ $data->hotline }}
                                </span>
                            </div>
                            @foreach (json_decode($data->address) as $key => $item)
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    Địa chỉ {{ ++$key }}:
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{ $item }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @else
                            <i>Vui lòng thêm thông tin trường!</i>
                        @endif
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
<!--begin::Modal-->
<div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">THÔNG TIN TRƯỜNG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--begin::Form-->
                <form method="POST" action="{{ route('nha-truong.store')}}"
                    class="m-form m-form--fit m-form--label-align-right" style="padding-left: 20%;padding-right: 20%">
                    @csrf
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <input type="text" class="form-control m-input m-input--air m-input--pill"
                        placeholder="Tên trường" name="name" value="{{ old('name') ? old('name') : (isset($data->name) ? $data->name : '')}}">
                            @error('name')
                            <span class="pl-3 error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group m-form__group">
                            <input type="text" class="form-control m-input m-input--air m-input--pill"
                                placeholder="Email" name="email" value="{{ old('email') ? old('email') : (isset($data->email) ? $data->email : '')}}">
                            @error('email')
                            <span class="pl-3 error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group m-form__group">
                            <input type="text" class="form-control m-input m-input--air m-input--pill" onkeypress="return isNumberKey(event)" maxlength="20"
                                placeholder="Hotline" name="hotline" value="{{ old('hotline') ? old('hotline') : (isset($data->hotline) ? $data->hotline : '')}}">
                            @error('hotline')
                            <span class="pl-3 error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group m-form__group" id="input-address">
                            @if (old('address'))
                                @foreach (old('address') as $item)
                                    <div class="m--margin-bottom-25">
                                        <div class="input-group">
                                            <div class="m-input-icon m-input-icon--right">
                                                <input type="text" name="address[]"
                                                    class="form-control m-input m-input--air m-input--pill"
                                            placeholder="Địa chỉ" value="{{ $item }}">

                                                <span class="m-input-icon__icon m-input-icon__icon--right"
                                                    onclick="addInputAddress(this)">
                                                    <span><i style="cursor: pointer"
                                                            class="la la la-plus text-success"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif($data)
                                @foreach (json_decode($data->address) as $key => $item)
                                    <div class="m--margin-bottom-25">
                                        <div class="input-group">
                                            <div class="m-input-icon m-input-icon--right">
                                                <input type="text" name="address[]"
                                                    class="form-control m-input m-input--air m-input--pill"
                                                    placeholder="Địa chỉ" value="{{ $item }}">

                                                @if ($key == 0)
                                                    <span class="m-input-icon__icon m-input-icon__icon--right" onclick="addInputAddress(this)">
                                                        <span><i style="cursor: pointer" class="la la la-plus text-success"></i></span>
                                                    </span>
                                                @else
                                                    <span class="m-input-icon__icon m-input-icon__icon--right" onclick="removeElment(this)">
                                                        <span><i style="cursor: pointer" class="la la-close text-danger"></i></span>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else    
                                <div class="m--margin-bottom-25">
                                    <div class="input-group">
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" name="address[]"
                                                class="form-control m-input m-input--air m-input--pill"
                                        placeholder="Địa chỉ" value="">
                                            <span class="m-input-icon__icon m-input-icon__icon--right"
                                                onclick="addInputAddress(this)">
                                                <span><i style="cursor: pointer"
                                                        class="la la la-plus text-success"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @error('address[]')
                            <span class="pl-3 error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group m-form__group">
                            <center>
                                <button type="submit"
                                    class="btn m-btn--pill btn-accent m-btn m-btn--custom">Submit</button>
                            </center>
                        </div>

                    </div>
                </form>

                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
@endsection
@section('script')
<script>
    function addInputAddress() {
        let content = `<div class="m--margin-bottom-25">
                            <div class="input-group">
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" name="address[]" 
                                    class="form-control m-input m-input--air m-input--pill" placeholder="Địa chỉ">
                                    <span class="m-input-icon__icon m-input-icon__icon--right" onclick="removeElment(this)">
                                        <span><i style="cursor: pointer" class="la la-close text-danger"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>`;
        $('#input-address').append(content);
    }

    function removeElment(e) {
        console.log(e.parentElement.parentElement.parentElement.remove());
    }
    
    function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
    }
</script>
@if ($errors->count() > 0 || !$data)
<script>
    $('#m_modal_4').modal("show")
</script>
@endif
@endsection
