$(document).ready(function () {
    $(".sort-select").on("click", function() {
        var selectCity = $(".sort-select.sort_city");
        var selectTypeOrg = $(".sort-select.sort-type_org");
        var selectTypeNeed = $(".sort-select.sort-type_need");

        var city = selectCity.find('.selection').attr('data-value');
        var typeOrg = selectTypeOrg.find('.selection').attr('data-value');
        var typeNeed = selectTypeNeed.find('.selection').attr('data-value');

        //console.log(city + " " + typeOrg + " " + typeNeed);


        $.ajax({
            url: '/catalog/sort',
            method: 'put',
            data:{ city: city, typeOrg: typeOrg, typeNeed: typeNeed },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
            },
            error: function (message) {

            }
        });
    });
});