<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}
    <style>
        body {
            font-size: 12px
        }

        .container {
            width: 700px;
            box-sizing: border-box;
            overflow: hidden;
        }

        table {
            width: 100%;
        }

        .TableData {
            background: #ffffff;
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            border: thin solid #d3d3d3;
        }

        .TableData TH {
            text-align: center;
            font-weight: bold;
            color: #000;
            border: solid 1px #ccc;
            padding: 10px;
        }

        .TableData TR {
            height: 24px;
            border: thin solid #d3d3d3;
        }

        .TableData TR TD {
            padding: 15px;
            border: thin solid #d3d3d3;
            text-align: center
        }

        .in_dam {
            color: red !important
        }
        .footer{
            width: 100%;
            text-align: center
        }

        .footer>i{
           font-size: 5px !important
        }

        .right{
            width: 30%;
            float: right;
        }
        .left{
            width: 30%;
            float: left;
        }

    </style>
</head>

<body style="font-family: Dejavu Sans">
    <div class="container">
        <div class="header">
            <h2 style="text-align: center">Hóa Đơn Đóng Tiền
                <br />
                -------oOo-------
               
            </h2>
            <p style="text-align: center"> ({{$thong_tin_dot_thu->ten_dot_thu}}-{{$thong_tin_dot_thu->ThangThuTien->thang_thu}}/{{$thong_tin_dot_thu->ThangThuTien->nam_thu}})</p>
            <p style="text-align: right"> Ngày........Tháng........năm........</p>
        </div>

        <div class="thong_tin">
        <p>Đơn vị thu tiền: <b>{{$thong_tin_truong->name}}</b></p>
            <p>Địa chỉ: <b>{{json_decode($thong_tin_truong->address)[0]}}</b></p>
            <p>Số điện thoại: <b>{{$thong_tin_truong->hotline}}</b>
            </p>
            <p>Thông tin người nộp :</p>
            <p>Họ tên học sinh : <b>{{$thong_tin_hoc_sinh->ten}}</b> 
            </p>
            <p>Họ tên người nộp tiền :
                .............................................................................................................................................
            </p>
            <p>Địa chỉ:
                ....................................................................................................................................................................
            </p>
        </div>

        <div class="thong_tin">
            <table class="TableData">
                <tr>
                    <th>Stt</th>
                    <th>Khoản thu</th>
                    <th>Đơn vị tính</th>
                    <th>Số tiền</th>
                    <th>Miễn giảm</th>
                    <th>Thành tiền</th>
                </tr>
                @php
                    $i =1
                @endphp
                    @foreach ($chi_tiet_dong_tien as $item)
                    <tr>
                    <td>{{$i++}}</td>
                        <td>{{$item->KhoanThu->ten_khoan_thu}}</td>
                        <td>{{config('common.don_vi_tinh')[$item->KhoanThu->don_vi_tinh]}}</td>
                        <td>{{number_format($item->KhoanThu->muc_thu)}}</td>
                        <td>
                            {{-- $item-> --}}
                            @if (count($danh_sach_mien_giam)>0)
                                @if ($item->KhoanThu->mac_dinh==2)
                                    {{$item['phan_tram_mien_giam']}}%
                                @elseif ($item['phan_tram_mien_giam']>0)
                                    {{$item['phan_tram_mien_giam']}}%
                                @endif
                            @endif
                           
                        </td>
                        <td>{{number_format($item->so_tien)}}</td>
                    </tr>
                    @endforeach
                <tr>
                    <th colspan="4"></th>
                    <th class="in_dam">Tổng tiền</th>
                    <th class="in_dam">{{number_format($thu_tien_hoc_sinh['so_tien_phai_dong'])}}</th>
                </tr>
                <tr>
                    <th style="text-align: left" colspan="6">Số tiền bằng chữ: </th>
                </tr>
            </table>
        </div>

        <div class="footer">
            <div class="left">
                <p>Người nộp tiền</p>
                <i>(Ký, ghi rõ họ tên)</i>
            </div>
            <div class="right">
                <p>Người thu tiền</p>
                <i>(Ký, đóng dấu, ghi rõ họ tên)</i>
            </div>
        </div>
        <p style="clear:both;margin-bottom:15px;margin-top:32px"></p>
    </div>
</body>

</html>