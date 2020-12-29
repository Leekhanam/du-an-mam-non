
//get lop by khoi
$("#khoi").change(function() {
    $('#preload').css('display','block')
    axios.post(url_get_lop_theo_khoi, {
        id: $("#khoi").val(),
    }).then(function(response) {
        var data_html = '<option value="" selected  >Chọn</option>'
        response.data.forEach(element => {
            data_html += `<option value="${element.id}" >${element.ten_lop}</option>`
        });

        $('#lop').html(data_html)
        $('#preload').css('display','none')
    }).catch(function(error) {
        console.log(error);
    });
})
//get maqh theo matp
$("#ho_khau_thuong_tru_matp").change(function() {
    $('#preload').css('display','block')
    axios.post(url_get_maqh_by_matp, {
        matp: $("#ho_khau_thuong_tru_matp").val()
    }).then(function(response) {
        var data_maqh_html = '<option value="" selected  >Chọn</option>'
        response.data.forEach(element => {
            data_maqh_html += `<option value="${element.maqh}" >${element.name}</option>`
        });
        $("#ho_khau_thuong_tru_maqh").html(data_maqh_html)
        $('#preload').css('display','none')
    }).catch(function(error) {
        console.log(error);
    });
})

$("#noi_o_hien_tai_matp").change(function() {
    $('#preload').css('display','block')
    axios.post(url_get_maqh_by_matp, {
        matp: $("#noi_o_hien_tai_matp").val()
    }).then(function(response) {
        var data_maqh_html = '<option value="" selected  >Chọn</option>'
        response.data.forEach(element => {
            data_maqh_html += `<option value="${element.maqh}" >${element.name}</option>`
        });
        $("#noi_o_hien_tai_maqh").html(data_maqh_html)
        $('#preload').css('display','none')
    }).catch(function(error) {
        console.log(error);
    });
})
//get xaid theo maqh
$("#ho_khau_thuong_tru_maqh").change(function() {
    $('#preload').css('display','block')
    axios.post(url_get_xaid_by_maqh, {
        maqh: $("#ho_khau_thuong_tru_maqh").val()
    }).then(function(response) {
        var data_xaid_html = '<option value="" selected  >Chọn</option>'
        response.data.forEach(element => {
            data_xaid_html += `<option value="${element.xaid}" >${element.name}</option>`
        });
        $("#ho_khau_thuong_tru_xaid").html(data_xaid_html)
        $('#preload').css('display','none')
    }).catch(function(error) {
        console.log(error);
    });
})
$("#noi_o_hien_tai_maqh").change(function() {
    $('#preload').css('display','block')
    axios.post(url_get_xaid_by_maqh, {
        maqh: $("#noi_o_hien_tai_maqh").val()
    }).then(function(response) {
        var data_xaid_html = '<option value="" selected  >Chọn</option>'
        response.data.forEach(element => {
            data_xaid_html += `<option value="${element.xaid}" >${element.name}</option>`
        });
        $("#noi_o_hien_tai_xaid").html(data_xaid_html)
        $('#preload').css('display','none')
    }).catch(function(error) {
        console.log(error);
    });
})
//anh_gv
function showModal() {
    document.getElementById('anh_gv').click();
}
