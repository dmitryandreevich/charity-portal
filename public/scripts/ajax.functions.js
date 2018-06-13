$(document).ready(function () {

     $(".filter-select-catalog").on("click", function () {
         var selectCity = $(".filter-select-catalog.filter_city");
         var selectTypeOrg = $(".filter-select-catalog.filter-type_org");
         var selectTypeNeed = $(".filter-select-catalog.filter-type_need");

         var city = selectCity.find('.selection').attr('data-value');
         var typeOrg = selectTypeOrg.find('.selection').attr('data-value');
         var typeNeed = selectTypeNeed.find('.selection').attr('data-value');
         var sortBy = $(".filter-select-catalog.sort-type_catalog_all").find('.selection').attr('data-value');

         console.log(sortBy);


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
});