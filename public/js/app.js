$(document).ready(function(){
    //initial job list
    $.getJSON('index.php/api/joblist', function(data){ 
        
        if (data.statusCode === 200) {
            
            var jobs = data.jobList;
            
            $.each(jobs, function (key, obj) {
                date = new Date(obj.createdTime.date);
                $('#joblist').append('<div class="row"><div class="col-sm-12 col-md-6 col-md-offset-2">\n\
<div class="row"><div class="col-xs-10 "><h4 ><a href="detail.html">'+obj.name+'</a></h4>\n\
<p class="company">'+obj.brand+'</p></div></div></div>\n\
<div class="col-xs-10 col-xs-offset-2 col-sm-4 col-sm-offset-2 col-md-2 col-md-offset-0">\n\
'+obj.location+'</div>\n\
<div class="col-xs-10 col-xs-offset-2 col-sm-4 col-sm-offset-0 col-md-3">\n\
<p>'+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear()+'</p></div></div>');
            });
        } else {
            $('.alert-danger').show();
        }
    });
});