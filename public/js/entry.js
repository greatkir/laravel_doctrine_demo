$(document).ready(function(){
    var curr_id = $('.article-container').attr('id');
    $.getJSON('/index.php/api/job/'+curr_id, function (data) {
        if (data.statusCode === 200) {
            if (!(Object.keys(data.job).length === 0)) {
                let date = new Date (data.job.createdTime.date);
                $('.article-container').append('<h1>'+data.job.name+'</h3>');
                $('.article-container').append('<p>'+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear()+'  '+data.job.location+'   '+data.job.brand+'</p>');
                $('.article-container').append('<p class="text-left" style="word-wrap:break-word;">'+data.job.description+'</p>');
                $('.article-container').append('<p>Contact Email: <a href="mailto:'+data.job.email+'">'+data.job.email+'</a></p>');
            } else {
                $('.alert-not-found').show();
            }
        } else {
            $('.alert-danger').show();
        }
    });
});
