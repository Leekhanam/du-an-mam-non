
$(document).ready(function () {
    $(document).pjax('a', '#pjax-container')
    // does current browser support PJAX
    if ($.support.pjax) {
        $.pjax.defaults.timeout = 1000; // time in milliseconds
    }

});