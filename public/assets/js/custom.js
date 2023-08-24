(function ($) {
    "use strict";
    // ______________ PAGE LOADING
    $(window).on("load", function (e) {
        $("#global-loader").fadeOut("slow");
    })
    //Color-Theme
    $(document).on("click", "a[data-theme]", function () {
        $("head link#theme").attr("href", $(this).data("theme"));
        $(this).toggleClass('active').siblings().removeClass('active');
    });
    // ______________Full screen
    $(document).on("click", ".fullscreen-button", function toggleFullScreen() {
        $('.fullscreen-button').addClass('fullscreen-button');
        if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            }
        } else {
            $('html').removeClass('fullscreen-button');
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    })
    // ______________ BACK TO TOP BUTTON
    $(window).on("scroll", function (e) {
        if ($(this).scrollTop() > 0) {
            $('#back-to-top').fadeIn('slow');
        } else {
            $('#back-to-top').fadeOut('slow');
        }
    });
    $(document).on("click", "#back-to-top", function (e) {
        $("html, body").animate({
            scrollTop: 0
        }, 0);
        return false;
    });
    // ______________ COVER IMAGE
    $(".cover-image").each(function () {
        var attr = $(this).attr('data-bs-image-src');
        if (typeof attr !== typeof undefined && attr !== false) {
            $(this).css('background', 'url(' + attr + ') center center');
        }
    });
    // ______________Quantity Cart Increase & Descrease
    $(function () {
        $('.add').on('click', function () {
            var $qty = $(this).closest('div').find('.qty');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal)) {
                $qty.val(currentVal + 1);
            }
        });
        $('.minus').on('click', function () {
            var $qty = $(this).closest('div').find('.qty');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal) && currentVal > 0) {
                $qty.val(currentVal - 1);
            }
        });
    });
    // ______________Chart-circle
    if ($('.chart-circle').length) {
        $('.chart-circle').each(function () {
            let $this = $(this);
            $this.circleProgress({
                fill: {
                    color: $this.attr('data-bs-color')
                },
                size: $this.height(),
                startAngle: -Math.PI / 4 * 2,
                emptyFill: '#edf0f5',
                lineCap: 'round'
            });
        });
    }
    // __________MODAL
    // showing modal with effect
    $('.modal-effect').on('click', function (e) {
        e.preventDefault();
        var effect = $(this).attr('data-bs-effect');
        $('#modaldemo8').addClass(effect);
    });
    // hide modal with effect
    $('#modaldemo8').on('hidden.bs.modal', function (e) {
        $(this).removeClass(function (index, className) {
            return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
        });
    });
    // ______________ CARD
    const DIV_CARD = 'div.card';
    // ___________TOOLTIP
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    // __________POPOVER
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
    // By default, Bootstrap doesn't auto close popover after appearing in the page
    $(document).on('click', function (e) {
        $('[data-toggle="popover"],[data-original-title]').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                (($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false // fix for BS 3.3.6
            }
        });
    });
    // ______________ Toast
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl)
    })
    $("#liveToastBtn").click(function () {
        $('.toast').toast('show');
    })
    // ______________ FUNCTION FOR REMOVE CARD
    $(document).on('click', '[data-bs-toggle="card-remove"]', function (e) {
        let $card = $(this).closest(DIV_CARD);
        $card.remove();
        e.preventDefault();
        return false;
    });
    // ______________ FUNCTIONS FOR COLLAPSED CARD
    $(document).on('click', '[data-bs-toggle="card-collapse"]', function (e) {
        let $card = $(this).closest(DIV_CARD);
        $card.toggleClass('card-collapsed');
        e.preventDefault();
        return false;
    });
    // ______________ CARD FULL SCREEN
    $(document).on('click', '[data-bs-toggle="card-fullscreen"]', function (e) {
        let $card = $(this).closest(DIV_CARD);
        $card.toggleClass('card-fullscreen').removeClass('card-collapsed');
        e.preventDefault();
        return false;
    });
    //Input file-browser
    $(document).on('change', '.file-browserinput', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    }); // We can watch for our custom `fileselect` event like this
    //______File Upload
    $('.file-browserinput').on('fileselect', function (event, numFiles, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }
    });
    // ______________Accordion Style
    $(document).on("click", '[data-bs-toggle="collapse"]', function () {
        $(this).toggleClass('active').siblings().removeClass('active');
    });
})(jQuery);
function replay() {
    let replayButtom = document.querySelectorAll('.reply a')
    // Creating Div
    let Div = document.createElement('div')
    Div.setAttribute('class', "comment mt-5 d-grid")
    // creating textarea
    let textArea = document.createElement('textarea')
    textArea.setAttribute('class', "form-control")
    textArea.setAttribute('rows', "5")
    textArea.innerText = "Your Comment";
    // creating Cancel buttons
    let cancelButton = document.createElement('button');
    cancelButton.setAttribute('class', "btn btn-danger");
    cancelButton.innerText = "Cancel";
    let buttonDiv = document.createElement('div')
    buttonDiv.setAttribute('class', "btn-list ms-auto mt-2")
    // Creating submit button
    let submitButton = document.createElement('button');
    submitButton.setAttribute('class', "btn btn-success ms-3");
    submitButton.innerText = "Submit";
    // appending text are to div
    Div.append(textArea)
    Div.append(buttonDiv);
    buttonDiv.append(cancelButton);
    buttonDiv.append(submitButton);
    replayButtom.forEach((element, index) => {
        element.addEventListener('click', () => {
            let replay = $(element).parent()
            replay.append(Div)
            cancelButton.addEventListener('click', () => {
                Div.remove()
            })
        })
    })
}
replay()
function like() {
    let like = document.querySelectorAll('.like')
    like.forEach((element, index) => {
        element.addEventListener('click', () => {
            let likeText = $(element).children()
            console.log(Number(likeText[0].childNodes[2]))
            // likeText.innerText++
        })
    })
}
like()
//Email Inbox
jQuery(document).ready(function ($) {
    $(".clickable-row").click(function () {
        window.location = $(this).data("href");
    });
});
/*off canvas Style*/
$('.off-canvas').on('click', function () {
    $('body').addClass('overflow-y-scroll');
    $('body').addClass('pe-0');
});
$('.layout-setting').on("click", function (e) {
    if (document) {
        $('body').toggleClass('dark-mode');
        $('body').removeClass('transparent-mode');
    } else {
        $('body').removeClass('dark-mode');
        $('body').removeClass('transparent-mode');
        $('body').addClass('light-mode');
    }
});
//######## SWITCHER STYLES ######## //
// Sidemenu layout Styles //
// ***** Icon with Text *****//
// $('body').addClass('icontext-menu');
// $('body').addClass('sidenav-toggled');
// if(document.querySelector('.icontext-menu').firstElementChild.classList.contains('login-img') !== true){
// icontext();
// }
// ***** Icon Overlay ***** //
// $('body').addClass('icon-overlay');
// $('body').addClass('sidenav-toggled');
// ***** closed-leftmenu ***** //
// $('body').addClass('closed-leftmenu');
// $('body').addClass('sidenav-toggled')
// ***** hover-submenu ***** //
// $('body').addClass('hover-submenu');
// $('body').addClass('sidenav-toggled')
// if(document.querySelector('.hover-submenu').firstElementChild.classList.contains('login-img') !== true){
// hovermenu();
// }
// ***** hover-submenu style 1 ***** //
// $('body').addClass('hover-submenu1');
// $('body').addClass('sidenav-toggled')
// if(document.querySelector('.hover-submenu1').firstElementChild.classList.contains('login-img') !== true){
// hovermenu();
// }
/******** *Header-Position Styles Start* ********/
// $('body').addClass('fixed-layout');
// $('body').addClass('scrollable-layout');
/******* Full Width Layout Start ********/
// $('body').addClass('layout-fullwidth');
// $('body').addClass('layout-boxed');
/******* Header Styles ********/
// $('body').addClass('header-light');
// $('body').addClass('color-header');
// $('body').addClass('dark-header');
// $('body').addClass('gradient-header');
/******* Menu Styles ********/
// $('body').addClass('light-menu');
// $('body').addClass('color-menu');
// $('body').addClass('dark-menu');
// $('body').addClass('gradient-menu');
/******* Theme Style ********/
// $('body').addClass('light-mode');
// $('body').addClass('dark-mode');
// $('body').addClass('transparent-mode');
/******* RTL VERSION *******/
// $('body').addClass('rtl');
$(document).ready(function () {
    let bodyRtl = $('body').hasClass('rtl');
    if (bodyRtl) {
        $('body').addClass('rtl');
        $("html[lang=en]").attr("dir", "rtl");
        $('body').removeClass('ltr');
        localStorage.setItem("rtl", "True");
        $("head link#style").attr("href", $(this));
        (document.getElementById("style").setAttribute("href", "../assets/plugins/bootstrap/css/bootstrap.rtl.min.css"));
        var carousel = $('.owl-carousel');
        $.each(carousel, function (index, element) {
            // element == this
            var carouselData = $(element).data('owl.carousel');
            carouselData.settings.rtl = true; //don't know if both are necessary
            carouselData.options.rtl = true;
            $(element).trigger('refresh.owl.carousel');
        });
    }
});
/******* Navigation Style *******/
// ***** Horizontal Click Menu ***** //
// $('body').addClass('horizontal');
$(document).ready(function () {
    let bodyhorizontal = $('body').hasClass('horizontal');
    if (bodyhorizontal) {
        $('body').addClass('horizontal');
        $(".main-content").addClass("hor-content");
        $(".main-content").removeClass("app-content");
        $(".main-container").addClass("container");
        $(".main-container").removeClass("container-fluid");
        $(".app-header").addClass("hor-header");
        $(".hor-header").removeClass("app-header");
        $(".app-sidebar").addClass("horizontal-main")
        $(".main-sidemenu").addClass("container")
        $('body').removeClass('sidebar-mini');
        $('body').removeClass('sidenav-toggled');
        $('body').removeClass('horizontal-hover');
        $('body').removeClass('default-menu');
        $('body').removeClass('icontext-menu');
        $('body').removeClass('icon-overlay');
        $('body').removeClass('closed-leftmenu');
        $('body').removeClass('hover-submenu');
        $('body').removeClass('hover-submenu1');
        localStorage.setItem("horizantal", "True");
        // $('#slide-left').addClass('d-none');
        // $('#slide-right').addClass('d-none');
        $('#slide-left').removeClass('d-none');
        $('#slide-right').removeClass('d-none');
        if (document.querySelector('.horizontal').firstElementChild.classList.contains('login-img') !== true) {
            document.querySelector('.horizontal .side-menu').style.flexWrap = 'nowrap'
            menuClick();
            checkHoriMenu();
            responsive();
        }
    } else {
    }
});
// ***** Horizontal Hover Menu ***** //
// $('body').addClass('horizontal-hover');
$(document).ready(function () {
    function light() {
        if (document.querySelector('body').classList.contains('light-mode')) {
            $('#myonoffswitch3').prop('checked', true);
            $('#myonoffswitch6').prop('checked', true);
        }
    }
    light();
    let bodyhorizontal = $('body').hasClass('horizontal-hover');
    if (bodyhorizontal) {
        let li = document.querySelectorAll('.side-menu li')
        li.forEach((e, i) => {
            e.classList.remove('is-expanded')
        })
        var animationSpeed = 300;
        // first level
        var parent = $("[data-bs-toggle='sub-slide']").parents('ul');
        var ul = parent.find('ul:visible').slideUp(animationSpeed);
        ul.removeClass('open');
        var parent1 = $("[data-bs-toggle='sub-slide2']").parents('ul');
        var ul1 = parent1.find('ul:visible').slideUp(animationSpeed);
        ul1.removeClass('open');
        $('body').addClass('horizontal-hover');
        $('body').addClass('horizontal');
        $(".main-content").addClass("hor-content");
        $(".main-content").removeClass("app-content");
        $(".main-container").addClass("container");
        $(".main-container").removeClass("container-fluid");
        $(".app-header").addClass("hor-header");
        $(".app-header").removeClass("app-header");
        $(".app-sidebar").addClass("horizontal-main")
        $(".main-sidemenu").addClass("container")
        $('body').removeClass('sidebar-mini');
        $('body').removeClass('sidenav-toggled');
        $('body').removeClass('default-menu');
        $('body').removeClass('icontext-menu');
        $('body').removeClass('icon-overlay');
        $('body').removeClass('closed-leftmenu');
        $('body').removeClass('hover-submenu');
        $('body').removeClass('hover-submenu1');
        // $('#slide-left').addClass('d-none');
        // $('#slide-right').addClass('d-none');
        $('#slide-left').removeClass('d-none');
        $('#slide-right').removeClass('d-none');
        if (document.querySelector('.horizontal-hover').firstElementChild.classList.contains('login-img') !== true) {
            document.querySelector('.horizontal-hover .side-menu').style.flexWrap = 'nowrap'
            HorizontalHovermenu();
            checkHoriMenu();
            responsive();
        }
    } else {
    }
});
/******* Transparent Bg-Image Style *******/
// Bg-Image1 Style
// $('body').addClass('bg-img1');
// $('body').addClass('transparent-mode');
// Bg-Image2 Style
// $('body').addClass('bg-img2');
// $('body').addClass('transparent-mode');
// Bg-Image3 Style
// $('body').addClass('bg-img3');
// $('body').addClass('transparent-mode');
// Bg-Image4 Style
// $('body').addClass('bg-img4');
// $('body').addClass('transparent-mode');
function resetData() {
    $('#myonoffswitch3').prop('checked', true);
    $('#myonoffswitch6').prop('checked', true);
    $('#myonoffswitch1').prop('checked', true);
    $('#myonoffswitch9').prop('checked', true);
    $('#myonoffswitch10').prop('checked', false);
    $('#myonoffswitch11').prop('checked', true);
    $('#myonoffswitch12').prop('checked', false);
    $('#myonoffswitch13').prop('checked', true);
    $('#myonoffswitch14').prop('checked', false);
    $('#myonoffswitch15').prop('checked', false);
    $('#myonoffswitch16').prop('checked', false);
    $('#myonoffswitch17').prop('checked', false);
    $('#myonoffswitch18').prop('checked', false);
    $('body')?.removeClass('bg-img4');
    $('body')?.removeClass('bg-img1');
    $('body')?.removeClass('bg-img2');
    $('body')?.removeClass('bg-img3');
    $('body')?.removeClass('transparent-mode');
    $('body')?.removeClass('dark-mode');
    $('body')?.removeClass('dark-menu');
    $('body')?.removeClass('color-menu');
    $('body')?.removeClass('gradient-menu');
    $('body')?.removeClass('dark-header');
    $('body')?.removeClass('color-header');
    $('body')?.removeClass('gradient-header');
    $('body')?.removeClass('layout-boxed');
    $('body')?.removeClass('icontext-menu');
    $('body')?.removeClass('icon-overlay');
    $('body')?.removeClass('closed-leftmenu');
    $('body')?.removeClass('hover-submenu');
    $('body')?.removeClass('hover-submenu1');
    $('body')?.removeClass('sidenav-toggled');
    $('body')?.removeClass('scrollable-layout');
}
$('#country-select').on('change', function () {
    $('#state-select').html('<option label="Choose one"></option>')
    $('#city-select').html('<option label="Choose one"></option>')
    let id = $(this).val();
    if (id != '') {
        $.ajax({
            type: 'GET',
            cache: false,
            data: { id: id },
            url: 'get-state',
            success: function (response) {
                $('#state-select').html(response)
            }
        });
    }
})
$('#state-select').on('change', function () {
    let id = $(this).val();
    if (id != '') {
        $.ajax({
            type: 'GET',
            cache: false,
            data: { id: id },
            url: 'get-city',
            success: function (response) {
                $('#city-select').html(response)
            }
        });
    }
})
$('.generateLoginKey').on('click', function () {
    $('#copy-login-key').html('Copy')
    $('#login-key-area').html('Wait while we are loading...........')
    let id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        cache: false,
        data: { id: id },
        url: 'generate-login-key',
        success: function (response) {
            $('#login-key-area').html(response)
        }
    })
})
function copyToClipboard() {
    var range = document.createRange();
    range.selectNode(document.getElementById("login-key-area"));
    window.getSelection().removeAllRanges(); // clear current selection
    window.getSelection().addRange(range); // to select text
    document.execCommand("copy");
    window.getSelection().removeAllRanges();// to deselect
    $('#copy-login-key').html('Copied!')
}
$('.deleteUserModal').on('click', function () {
    $('#staff-name-to-delete').html('Wait while we are loading...........')
    $('.delete-modal-comp').prop('disabled', true)
    $('#key-to-delete').val('');
    $('.modalError').html('')
    let id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        cache: false,
        data: { id: id },
        url: 'get-user-name',
        success: function (response) {
            // $('#login-key-area').html(response)
            $('#user-id-input').val(id)
            $('#staff-name-to-delete').html(`Please enter the key to delete data of ${response}`)
            $('.delete-modal-comp').prop('disabled', false)
        }
    })
})
// $('.deleteBatchModal').on('click',function(){
//     $('#batch-name-to-delete').html('Wait while we are loading...........')
//     $('.delete-modal-comp').prop('disabled',true)
//     $('#key-to-delete').val('');
//     $('.modalError').html('')
//     let id = $(this).attr('data-id');
//     $.ajax({
//         type : 'GET',
//         cache : false,
//         data : {id:id},
//         url : 'get-batch-name',
//         success:function(response){
//             // $('#login-key-area').html(response)
//             $('#user-id-input').val(id)
//             $('#staff-name-to-delete').html(`Please enter the key to delete data of ${response}`)
//             $('.delete-modal-comp').prop('disabled',false)
//         }
//     })
// })
$('#key-to-delete').on('keyup', function () {
    $('.modalError').html('')
    let key = $.trim($(this).val());
    if (key.length > 0) {
        $('.delete-modal-comp-2').prop('disabled', false)
    }
    else {
        $('.delete-modal-comp-2').prop('disabled', true)
    }
})
$('.delete-modal-comp-2').on('click', function () {
    let id = $('#user-id-input').val();
    let key = $('#key-to-delete').val();
    if (key == 7206881088) {
        $('.modalError').html('')
        window.location.href = `delete-user/${id}`;
    }
    else {
        $('.modalError').html('Invalid Key')
    }
})
$('#staff-for-salary').on('change', function () {
    let id = $(this).val();
    if (id > 0) {
        $('#salary-update-btn').prop('disabled', false)
        $('#user-id-value').val(id)
        $.ajax({
            type: 'GET',
            cache: false,
            data: { id: id },
            url: 'get-salary-details',
            success: function (response) {
                if (response != '') {
                    let d = response.split('|');
                    $('#salary-amount').val(d[0]);
                    if (d[1] != '') {
                        $('#salary-date').html(`(On Date : ${d[1]})`)
                    }
                    else {
                        $('#salary-date').html('')
                    }
                }
                else {
                    $('#salary-amount').val('');
                    $('#salary-date').html('')
                }
            }
        })
    }
    else {
        $('#salary-update-btn').prop('disabled', true)
    }
})
$('.save-attendance').on('click', function () {
    let id = $(this).attr('data-id');
    let time = $(`#tp${id}`).val();
    $.ajax({
        type: 'GET',
        cache: false,
        data: { id: id, time: time },
        url: 'save-staff-attendance',
        success: function (response) {
            $(`#tp${id}`).attr('disabled', true)
            $(`.timeBtn-${id}`).attr('disabled', true)
            $(`#save-td-${id}`).html(`<button class="btn btn-icon btn-green"
         >Saved</button>`)
        }
    })
})
$('.timeInp').on('keyup', function () {
    let id = $(this).attr('data-id')
    if ($(this).val() != '') {
        $(`#btn-${id}`).prop('disabled', false)
    }
    else {
        $(`#btn-${id}`).prop('disabled', true)
    }
})
$('#add-fee-block').on('click', function () {
    let id = $('#add-fee-block').attr('data-btn');
    let html = `<div class="fee-block-${id} row">
    <div class="form-group col-md-2">
        <label for="feesInput">Fees Received</label>
        <input required type="number" name="fees[]"
            class="form-control number-without-arrow" id="feesInput"
            placeholder="Fees">
    </div>
    <div class="form-group col-md-4">
        <label for="receivedDateInput">Fees Received Date</label>
        <input type="date" name="fee_received_date[]" class="form-control "
            id="receivedDateInput" placeholder="Fees">
    </div>
    <div class="form-group col-md-4">
        <label for="dueDateInput">Next Due Date</label>
        <input type="date" name="next_due_date[]" class="form-control "
            id="dueDateInput" placeholder="Fees">
    </div>
    <div class="col-md-2 form-group">
        <label for="">Remove</label><br/>
        <button id="remove-button" type="button" data-remove-btn="${id}"  class="btn btn-red btn-block">
            <i class="fe fe-x-circle"></i>
        </button>
    </div>
</div>`;
    $('#fee-blocks').prepend(html)
    $('#add-fee-block').attr('data-btn', Number(id) + 1)
    $('#remove-button').on('click', function () {
        let rid = $(this).attr('data-remove-btn')
        $(`.fee-block-${rid}`).remove()
    })
})
$('#remove-button').on('click', function () {
    let eid = $(this).attr('data-remove-btn')
    $(`.fee-block-${rid}`).remove()
})
$('#fromDate').on('change', function () {
    $('#toDate').val('');
    $('#toDate').prop('disabled', false);
    $('#toDate').attr({ 'min': $(this).val() })
})
$('#generateExpenseReport').on('click', function () {
    $('#generateExpenseReport').html('Generating')
    let fromDate = $('#fromDate').val();
    let toDate = $('#toDate').val();
    let types = $('#type').val();
    let kind = 'expense';
    if (fromDate != '' && toDate != '' && type != '') {
        $('#fromDateError').html('')
        $('#toDateError').html('')
        $('#typeError').html('')
        window.location.href = `generate-report?kind=${kind}&fromDate=${fromDate}&toDate=${toDate}&types=${types}`;
        $('#generateExpenseReport').html('Generate')
    }
    else {
        $('#generateExpenseReport').html('Generate')
        if (fromDate == '') {
            $('#fromDateError').html('Please enter from date')
        }
        else {
            $('#fromDateError').html('')
        }
        if (toDate == '') {
            $('#toDateError').html('Please enter to date')
        }
        else {
            $('#toDateError').html('')
        }
        if (types == '') {
            $('#typeError').html('Please enter type')
        }
        else {
            $('#typeError').html('')
        }
    }
})
$('.ielts_pte_switch').on('change',function(){
    let val = $(this).val();
    if(val=='ielts' || val=='pte'){
        $('.scores-input').removeClass('hidden')
    }
    else{
        $('.scores-input').addClass('hidden')
    }
});
$('#allow-delete').on('change',function(){
    let checked = $(this).is(":checked")
    if(checked){
        $('.delete-btn').removeClass('hidden')
    }
    else{
        $('.delete-btn').addClass('hidden')
    }
})

function scrollToBottom(){
    $(".main-chat-body").animate({ scrollTop: $('.main-chat-body').prop("scrollHeight")}, 1000);
}

$('#file-attach').on('click',function(){
    $('#files-chat').click()
})

$('#files-chat').on('change',function(){
    let num = $(this)[0].files.length;
    if(num>0){
        $('.files-count').html(num)
        $('.files-count').addClass('show')
    }
    else{
        $('.files-count').html(num)
        $('.files-count').removeClass('show')
    }
})

$('#discussion-form').on('submit',function(e){
    e.preventDefault();
    $('#discussion-form').addClass('lock')
    var formData = new FormData(this);
    $('#discussion-error').html('')

    $.ajax({
        type : 'post',
        url:  "discussion-hub",
        data : formData,
        contentType : false,
        processData : false,
        success:function(response){
            scrollToBottom();
            let fl = '';
            if(response.file!=null){
                fl = `<a href="assets/discussionHub/${response.file}" target="_blank" class="text-primary">(File)</a>`
            }
            let mesg = `<div class="media flex-row-reverse chat-right">
            <div class="main-img-user chat-user">Me</div>
            <div class="media-body">
                <div class="main-msg-wrapper">
                   ${response.msg}
                   <em class="ml-2">${fl}</em>
                </div>
                <div>
                    <span>Just Now</span> <a href=""><i
                            class="icon ion-android-more-horizontal"></i></a>
                </div>
            </div>
        </div>`;
        $('.chat-body').append(mesg)


            $('#discussion-form')[0].reset();
            $('.files-count').removeClass('show')
            $('.files-count').html('0')
            $('#discussion-form').removeClass('lock')
            $('#send-chat-btn').prop('disabled',true)
            console.log(response)
        },
        error:function(response){
            $('#discussion-form')[0].reset();
            $('.files-count').removeClass('show')
            $('.files-count').html('0')
            $('#discussion-form').removeClass('lock')
            $('#discussion-error').html('Unable to send this message')
            $('#send-chat-btn').prop('disabled',true)
        }
    })
})
$('#club-form').on('submit',function(e){
    e.preventDefault();
    $('#club-form').addClass('lock')
    var formData = new FormData(this);
    $('#discussion-error').html('')

    $.ajax({
        type : 'post',
        url:  "../enter-club",
        data : formData,
        contentType : false,
        processData : false,
        success:function(response){
            scrollToBottom();
            let fl = '';
            if(response.file!=null){
                fl = `<a href="../assets/club/${response.file}" target="_blank" class="text-primary">(File)</a>`
            }
            let mesg = `<div class="media flex-row-reverse chat-right">
            <div class="main-img-user chat-user">Me</div>
            <div class="media-body">
                <div class="main-msg-wrapper">
                   ${response.msg}
                   <em class="ml-2">${fl}</em>
                </div>
                <div>
                    <span>Just Now</span> <a href=""><i
                            class="icon ion-android-more-horizontal"></i></a>
                </div>
            </div>
        </div>`;
        $('.chat-body').append(mesg)


            $('#club-form')[0].reset();
            $('.files-count').removeClass('show')
            $('.files-count').html('0')
            $('#club-form').removeClass('lock')
            $('#send-chat-btn').prop('disabled',true)
            console.log(response)
        },
        error:function(response){
            $('#club-form')[0].reset();
            $('.files-count').removeClass('show')
            $('.files-count').html('0')
            $('#club-form').removeClass('lock')
            $('#discussion-error').html('Unable to send this message')
            $('#send-chat-btn').prop('disabled',true)
        }
    })
})

$('#chat-msg').on('keyup',function(){
    $('#discussion-error').html('')
    let len = $.trim($(this).val().length)
    if(len>0){
        $('#send-chat-btn').prop('disabled',false)
    }
    else{
        $('#send-chat-btn').prop('disabled',true)
    }
})

scrollToBottom();


$('#update-ticket-status').on('click',function(){
    let id = $('#ticket-id').val();
    let val = $('#ticket-status').val();
    window.location.href = `../change-ticket-status/${id}/${val}`
})

$('.notification_for_switch').on('change',function(){
    let v = $(this).val()
    if(v==4){
        $('#notification-user-list').removeClass('d-none')
        $('#notification-user-list').prop('required',true);
    }
    else{
        $('#notification-user-list').addClass('d-none')
        $('#notification-user-list').prop('required',false);
    }
})