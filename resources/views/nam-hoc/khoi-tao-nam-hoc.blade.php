<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Khởi tạo Năm Học Đầu Tiên</title>
    <link rel="shortcut icon" type="image/x-icon"
        href="https://kidsonline.edu.vn/wp-content/themes/kids-online/assets/images/favicon.png" />
    {{--  style style  --}}
    @include('layouts._share.style')
    {{--  endstyle style  --}}
    <style>
        <style>.error {
            color: red;
        }

        #name-error,
        #StartDate-error,
        #EndDate-error {
            color: red;
        }

        .m-section {
            margin: 0px !important
        }

        .m-portlet.m-portlet--creative .m-portlet__head .m-portlet__head-caption .m-portlet__head-label.m-portlet__head-label--success {
            min-width: 400px;
            font-size: 1rem !important;
        }

        .m-portlet.m-portlet--creative {
            height: 115px;
        }

        .m-portlet.m-portlet--creative .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px
        }

        .item_link_nam:hover {
            left: 5px;
            box-shadow: 2px 3px 5px #000;
        }

        .item_link_nam_shadow {
            box-shadow: 2px 3px 5px #000 !important;
        }

    </style>
</head>

<body style="background-image: url({{ asset('assets/app/media/img//bg/bg-3.jpg')}});">

    <div class="m-content">
        <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            TẠO NĂM HỌC MỚI
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="logout()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="m-form m-form--fit m-form--label-align-right" id="form-ceate"
                        action="{{ route('nam-hoc.khoi-tao-dau-tien') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <label>Ngày bắt đầu năm học:</label>
                                    <input type="date"
                                        class="form-control m-input @error('start_date') is-invalid @enderror"
                                        name="start_date" id="StartDate" value="{{ old('start_date')}}"/>
                                    @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Ngày kết thúc năm học:</label>
                                    <input type="date"
                                        class="form-control m-input @error('end_date') is-invalid @enderror"
                                        name="end_date" id="EndDate" value="{{ old('end_date')}}"/>
                                    @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                Cất
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="logout()">
                                Hủy bỏ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--End::Section-->
    </div>
    <div id="loading"
        style="text-align: center;position: fixed;z-index: 500;width: 100vw;height: 100vh;background: #000;top: 0;left: 0;opacity:0.4;display:none;">
        <img src="{{ asset('images/loading1.gif')}}" style="width: 10%;height: auto;padding-top: 20%;">
    </div>


    {{--  script  --}}
    @include('layouts._share.script')
    {{--  endscript  --}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        function logout() {
            window.location.href = 'logout';
        }
        $(document).ready(function () {
            function monthDiff(dateFrom, dateTo) {
                return dateTo.getMonth() - dateFrom.getMonth() + 
                (12 * (dateTo.getFullYear() - dateFrom.getFullYear()))
            }
            let lists = $('.item_link_nam');
            $(lists[0]).addClass('bg-primary item_link_nam_shadow');
            jQuery.validator.addMethod("greaterThan", function (
                value,
                element,
                params
            ) {
                let d_start = new Date( $(params).val() );
                let d_end = new Date( value );
                if(isNaN(d_start.valueOf())){
                    return false;
                }
                if(isNaN(d_end.valueOf())){
                    return false;
                }

                if ( !!d_start.valueOf() ) {
                    year_start = d_start.getFullYear();
                    month_start = d_start.getMonth()+1;
                }

                if ( !!d_end.valueOf() ) {
                    year_end = d_end.getFullYear();
                    month_end = d_end.getMonth()+1;
                }   

                let count = monthDiff(new Date(year_start, month_start), new Date(year_end, month_end))
                if( count == 9 || count == 10){
                    return true;
                }
                return false;
            });

            jQuery.validator.addMethod("checkDate", function (
            value,
            element,
            params
            ) {
                let d_start = new Date( value );
                if(isNaN(d_start.valueOf())){
                    return false;
                }
                return params;
            });

            $("#form-ceate").validate({
                rules: {
                    start_date: {
                        required: true,
                        date: true,
                        checkDate: true
                    },
                    end_date: {
                        required: true,
                        date: true,
                        greaterThan: "#StartDate"
                    }
                },
                messages: {
                    start_date: {
                        required: "Hãy nhập thời gian bắt đầu năm học",
                        date: "Hãy nhập thời gian bắt đầu năm học hợp lệ",
                        checkDate: "Hãy nhập thời gian bắt đầu năm học hợp lệ",
                    },
                    end_date: {
                        required: "Hãy nhập thời gian kết thúc năm học",
                        date: "Hãy nhập thời gian kết thúc năm học hợp lệ",
                        greaterThan: "Hãy nhập thời gian kết thúc năm học theo đúng quy định"
                    }
                }
            });
        });
        $(window).on('load', function () {
            $('#m_modal_1').modal('show');
        });

    </script>
</body>

</html>
