$(document).ready(function () {
    //initial job list
    var jobs;
    loadData = function (url1) {
        $.getJSON(url1, function (data) {

            if (data.statusCode === 200) {

                jobs = data.jobList;
                $('#joblist').empty();
                $('.pagination').empty();
                $.each(jobs, function (key, obj) {
                    date = new Date(obj.createdTime.date);

                    $('#joblist').append('<div class="row">\n\
<div class="col-sm-12 col-md-6 col-md-offset-2">\n\
<div class="row"><div class="col-xs-10 "><h4 >\n\
<a href="index.php/job/' + obj.id + '">' + obj.name + '</a></h4>\n\
<p class="company">' + obj.brand + '</p></div></div></div>\n\
<div class="col-xs-10 col-xs-offset-2 col-sm-4 \n\
col-sm-offset-2 col-md-2 col-md-offset-0">\n\
' + obj.location + '</div>\n\
<div class="col-xs-10 col-xs-offset-2 col-sm-4 col-sm-offset-0 col-md-3">\n\
<p>' + date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + '</p>\n\
</div></div>');
                });
                //pagination
                if (typeof (data.links.prev) !== 'undefined') {
                    $('.pagination').append('<li><a href="/index.php/' + data.links.prev + '">&laquo;Previous page</a></li>')
                }
                if (typeof (data.links.next) !== 'undefined') {
                    $('.pagination').append('<li><a href="/index.php/' + data.links.next + '">Next Page &raquo;</a></li>')
                }
            } else {
                $('.alert-danger').show();
            }
        });
    }
    loadData('/index.php/api/job');

    loadSelectors = function (url2, sel_id, type) {
        $.getJSON(url2, function (data) {
            if (data.statusCode === 200) {
                var locations = data[type];
                $.each(locations, function (key, obj) {
                    $(sel_id).append('<option id="' + obj.id + '">' + obj.name + '</option>');
                });
            } else {
                $('.alert-danger').show();
            }
        });
    }
    loadSelectors('/index.php/api/locationlist', '#location_sel', 'locationList');
    loadSelectors('/index.php/api/brandlist', '#brand_sel', 'brandList');

    $('.pagination').on('click', 'li a', function () {
        let needed_url = $(this).attr('href');
        loadData(needed_url);
        return false;
    });

    $('.controls button').click(function () {
        let name = $('.controls input').val();
        let location = $('#location_sel option:selected').attr('id');
        let brand = $('#brand_sel option:selected').attr('id');
        loadData('/index.php/api/job?name=' + name + '&location=' + location + '&brand=' + brand);
        return false;
    });
});