'use strict';
$(".image-link").click(function(){
    var link = $(this).attr('data');
    var url = $(this).attr('url');
    //window.location.replace(url + ".html?" + link);
    window.open(url + ".html?" + link);
})
$(document).ready(function(){
    var cat = window.location.search.replace("?cat=","");
    $.post('php/candidate.php',{ ref: cat},function(data){
        //alert(data);
        if(data != "0"){
            var raw = JSON.parse(data);
            console.log(raw);
            var rawdata = '';
            $.each(raw,function(index,value){
                    //console.log(cat);
                    var num = parseInt(index) + 1;
                    rawdata += "<h1 id='candidate" + num +"' class='hidden candidate'>"+ value[0][1] + "</h1>\n";
                    // rawdata += "<h1 id='candidate" + num +"' class='hidden candidate'>"+ value[0][1] + " <span>(" + value[1]['team'] + ")</span></h1>\n";
            });
            //console.log(rawdata);
            $(".content-item").html(rawdata);
            setTimeout(function(){
                $('#candidate1').removeClass('hidden');
                $('#candidate1').addClass('animated bounceInUp');
                $('#candidate1').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $('#candidate2').removeClass('hidden');
                    $('#candidate2').addClass('animated bounceInUp');
                });
                $('#candidate2').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $('#candidate3').removeClass('hidden');
                    $('#candidate3').addClass('animated bounceInUp');
                });
                $('#candidate3').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $('#candidate4').removeClass('hidden');
                    $('#candidate4').addClass('animated bounceInUp');
                });
                $('#candidate4').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $('#candidate5').removeClass('hidden');
                    $('#candidate5').addClass('animated bounceInUp');
                });
            },1000)
        }else{
            // alert(1);
            $(".content-item").html("<h1 id='candidate1' class='hidden candidate'>Judging is still on going</h1>");
            $('#candidate1').removeClass('hidden');
                $('#candidate1').addClass('animated bounceInUp');
        }
    });
})