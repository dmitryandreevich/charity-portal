$(document).ready(function () {
    /*
     var selectCity = $(".sort-select.filter_city");
     var selectTypeOrg = $(".sort-select.filter-type_org");
     var selectTypeNeed = $(".sort-select.filter-type_need");

     var city = selectCity.find('.selection').attr('data-value');
     var typeOrg = selectTypeOrg.find('.selection').attr('data-value');
     var typeNeed = selectTypeNeed.find('.selection').attr('data-value');
     var sortBy = $(".sort-select.sort-type_catalog_all").attr('data-value');

     //console.log(city + " " + typeOrg + " " + typeNeed);


     $.ajax({
         url: '/catalog/sort',
         method: 'put',
         data:{ city: city, typeOrg: typeOrg, typeNeed: typeNeed, sortBy: sortBy },
         headers: {
             'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
         },
         success: function (response) {
             console.log(response);
         },
         error: function (message) {

         }
     });*/
    $(".sort-select-needs").on("click", function() {

        var selectStatus = $(".sort-select-needs.filter_status").find('.selection').attr('data-value');
        var selectOrg = $(".sort-select-needs.filter_organization").find('.selection').attr('data-value');
        var selectTypeOfNeed = $('.sort-select-needs.filter_type-need').find('.selection').attr('data-value');

        console.log(selectTypeOfNeed);
        $.ajax({
            url: '/needs/sorting',
            method: 'post',
            dataType: 'html',
            data:{ status: selectStatus, organizationId: selectOrg, typeOfNeed: selectTypeOfNeed },
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

            }
        });

    });
});