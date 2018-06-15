$(document).ready(function () {
    // edits
    $('.tab-new_vols').css('display', 'none');
    $('.tab-new_vols').find('*').attr('disabled', 'disabled');

    $('.select-need_type .custom-option').on('click', function () {
        var tabName = $(this).attr('tab-name');
        if(tabName === "tab-new_money"){
            $(".tab-new_money").css('display', 'block');
            $('.tab-new_money').find('*').removeAttr('disabled');

            $('.tab-new_vols').css('display', 'none');
            $('.tab-new_vols').find('*').attr('disabled', 'disabled');

        }else if(tabName === "tab-new_vols"){
            $('.tab-new_vols').css('display', 'block');
            $('.tab-new_vols').find('*').removeAttr('disabled');

            $('.tab-new_money').css('display', 'none');
            $('.tab-new_money').find('*').attr('disabled', 'disabled');

        }
    });
    $(".select-donate_type .custom-option").on("click", function() {
        var tabName = $(this).attr('tab-name');

        if(tabName === "finance"){
            $(".finance").css('display', 'block');
            $('.material').css('display', 'none');
        }else if(tabName === "material"){
            $(".finance").css('display', 'none');
            $('.material').css('display', 'block');
        }
    });


     $(".filter-select-catalog").on("click", function () {
         var selectCity = $(".filter-select-catalog.filter_city");
         var selectTypeOrg = $(".filter-select-catalog.filter-type_org");
         var selectTypeNeed = $(".filter-select-catalog.filter-type_need");

         var city = selectCity.find('.selection').attr('data-value');
         var typeOrg = selectTypeOrg.find('.selection').attr('data-value');
         var typeNeed = selectTypeNeed.find('.selection').attr('data-value');
         var sortBy = $(".filter-select-catalog.sort-type_catalog_all").find('.selection').attr('data-value');

         $.ajax({
             url: '/catalog/filter',
             method: 'put',
             data:{ city: city, typeOrg: typeOrg, typeNeed: typeNeed, sortBy: sortBy },
             headers: {
                 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
             },
             success: function (response) {
                 $('.block-needs--help.catalog_flex').text('');

                 if(response !== ""){
                     $('.block-needs--help.catalog_flex').append(response);
                 }else
                     $('.block-needs--help.catalog_flex').append('<h3>Ничего не найдено!</h3>');
             },
             error: function (message) {

             }
         });
     });
    $(".sort-select-needs").on("click", function() {

        var selectStatus = $(".sort-select-needs.filter_status").find('.selection').attr('data-value');
        var selectOrg = $(".sort-select-needs.filter_organization").find('.selection').attr('data-value');
        var selectTypeOfNeed = $('.sort-select-needs.filter_type-need').find('.selection').attr('data-value');
        var selectTypeOfDonate = $('.sort-select-needs.filter_type-donate').find('.selection').attr('data-value');

        $.ajax({
            url: '/needs/sorting',
            method: 'post',
            dataType: 'html',
            data: {
                status: selectStatus,
                organizationId: selectOrg,
                typeOfNeed: selectTypeOfNeed,
                typeOfDonate: selectTypeOfDonate
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('.content__list').text('');

                if(response !== ""){
                    $('.content__list').append(response);
                }else
                    $('.content__list').append('<h3>Ничего не найдено!</h3>');
            },
            error: function (message) {
                $('.content__list').text('');
                $('.content__list').append('<h3>Ошибка! </h3>' + message);
            }
        });

    });

    $(".sort-select-org").on("click", function() {

        var selectTypeOfNeed = $('.sort-select-org.filter_type-need').find('.selection').attr('data-value');
        var orgId = $('.select').find('.orgId').val();

        console.log(selectTypeOfNeed);
        console.log(orgId);

        $.ajax({
            url: '/organizations/filter',
            method: 'post',
            dataType: 'html',
            data:{ typeOfNeed: selectTypeOfNeed, orgId: orgId },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('.content__list').text('');

                if(response !== ""){
                    $('.content__list').append(response);
                }else
                    $('.content__list').append('<h3>Ничего не найдено!</h3>');
            },
            error: function (message) {
                $('.content__list').text('');
                $('.content__list').append('<h3>Ошибка! </h3>' + message);
            }
        });

    });

    $(".dashboard-search").on("click", function () {
        var searchAttr = $(this).parent().find('.i-value').val();
        var page = $(this).parent().find('.page').val();

        $.ajax({
            url: '/dashboard/search',
            method: 'post',
            dataType: 'html',
            data:{ searchAttr: searchAttr, page: page },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('.content__list').text('');

                if(response !== ""){
                    $('.content__list').append(response);
                }else
                    $('.content__list').append('<h3>Ничего не найдено!</h3>');
            },
            error: function (message) {
                $('.content__list').text('');
                $('.content__list').append('<h3>Ошибка! </h3>' + message);
            }
        });

        return false;
    });

    $('#modal6').find('#login-form').submit(function (e) {
        e.preventDefault();

        var email = $(this).find('input[name="email"]').val();
        var password = $(this).find('input[name="password"]').val();

        $.ajax({
            url: '/ajax-login',
            method: 'post',
            dataType: 'json',
            data:{ email: email, password: password },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                var json = response;

                if(json.status === 200)
                    window.location.reload();
                else if(json.status === 400){
                    $('#login-form-error').html(json.message);
                }
            }
        });
    });

    $('#modal2').find('#register-form').submit(function (e) {
       e.preventDefault();

        var email = $(this).find('input[name="email"]').val();
        var password = $(this).find('input[name="password"]').val();
        var passwordConfirmation = $(this).find('input[name="password_confirmation"]').val();
        var typeOfUser = $('#modal2').find('.select-type_user').find('.selection').attr('data-value');

        // если ничего не выбрано, то дефолт благотваритель
        if(typeOfUser === undefined)
            typeOfUser = 0;

        $.ajax({
            url: '/ajax-register',
            method: 'post',
            dataType: 'json',
            data:{ email: email, password: password, password_confirmation: passwordConfirmation, type: typeOfUser},
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                var json = response;

                if(json.status === 200)
                    window.location.reload();
                else if(json.status === 400){
                    $('#register-form-error').html("");
                    var errors = JSON.parse(json.messages);
                    for(var i in errors)
                        $('#register-form-error').append(errors[i] + "<br><br>");
                }
            }
        });
    });
    $('#modal3').find('#donation-form').find('input[type="submit"]').click(function (e) {
        e.preventDefault();

        var needData = $('#donation-form').find('input[name="need_data"]').val();
        var amount = $('#donation-form').find('input[name="amount"]').val();

        var info = $('#donation-form').find('textarea[name="info"]').val();

        $.ajax({
            url: '/donation',
            method: 'post',
            dataType: 'json',
            data:{ need_data: needData, amount: amount, info: info, type: $(this).attr('name') },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                var json = response;
                if(json.status === 200)
                    window.location.reload();
                else if(json.status === 400){
                    $('#donation-form-error').html("");
                    var errors = JSON.parse(json.messages);
                    for(var i in errors)
                        $('#donation-form-error').append(errors[i] + "<br><br>");
                }
            }
        });
    });
});