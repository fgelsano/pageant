$(document).ready(function(){
    
    $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .choice .form-group #goto").on("click", function(e){
        var can = $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .choice .form-group #candidate").val();
        var cat = $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .choice .form-group #cat").val();
        // var newlink = "../../display/indiv.php?cat=" + cat + "&can=" + can;
        var newlink = "../../display/indiv.php?cat=" + cat;
        $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .choice .form-group #goto").attr("href", newlink);
    })
})
$(document).ready(function(){
    
    $(".topwinner #page-wrapper .container-fluid .row .col-md-12 .white-box .choice .form-group #goto").on("click", function(e){
        var can = $(".topwinner #page-wrapper .container-fluid .row .col-md-12 .white-box .choice .form-group #candidate").val();
        var cat = $(".topwinner #page-wrapper .container-fluid .row .col-md-12 .white-box .choice .form-group #cat").val();
        // var newlink = "../../display/indiv.php?cat=" + cat + "&can=" + can;
        var newlink = "../../winner/topwinner.php?cat=" + cat;
        $(".topwinner #page-wrapper .container-fluid .row .col-md-12 .white-box .choice .form-group #goto").attr("href", newlink);
    })
})
console.log(location);
$('#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .col-md-3 #category').change(function(){
    var cat = $(this).val();

    if(cat != ''){
        if(cat == "Summary"){
            $.post('php/category.php',{ca:cat},function(data){
                if(data == 0){
                    $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table tbody").html('No data at the Moment!');
                }else{
                    var rawdata = JSON.parse(data);
                    //console.log(rawdata);
                    var text = '';
                    var x = 1;
                    var head = "";
                    head += "<tr>";
                    head += "<th>#</th>";
                    head +=    '<th>NAME</th>';
                    head +=    '<th>Baranggay</th>';
                    head +=    '<th>Description</th>';
                    head +=    '<th>Talent</th>';
                    head +=    '<th>Festival Attire</th>';
                    head +=    '<th>Batobalani Queen Iconic Pose</th>';
                    head +=    '<th>Swimsuit</th>';
                    head +=    '<th>Evening Gown</th>';
                    head +=    '<th>Prelim</th>';
                    head +=    '<th> Total Score</th>';
                    head += '</tr>';
                    console.log(rawdata);
                    $.each(rawdata,function(index,value){
                        text += '<tr>\n';
                        var num = "";
                        text += '<td>' + value[0].number + '</td>\n';
                        text += '<td>' + value[1].Candidate + '</td>\n';
                        text += '<td>' + value[0].team + '</td>\n';
                        text += '<td>' + value[0].descript + '</td>\n';
                        text += '<td>' + value[2].Score + '</td>\n';
                        text += '<td>' + value[3].Score + '</td>\n';
                        text += '<td>' + value[4].Score + '</td>\n';
                        text += '<td>' + value[5].Score + '</td>\n';
                        text += '<td>' + value[6].Score + '</td>\n';
                        text += '<td>' + value[7].Score + '</td>\n';
                        text += '<td>' + value[1].Score + '</td>\n';          
                        text += '</tr>\n';
                        x++;
                    })
                    $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table thead").html(head);
                    $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table tbody").html(text);
                }
                
            })
        }else{
            $.post('php/crit.php',{ca:cat},function(data1){
                if(data1 >= 1){
                    $.post('php/category.php',{ca:cat},function(data){
                        if(data == 0){
                            $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table tbody").html('No data at the Moment!');
                        }else{
                            //var rawdata = JSON.parse(data);
                            // console.log(rawdata);
                            // var text = '';
                            // var x = 1;
                            // var head = "";
                            // head += "<tr>";
                            // head += "<th>#</th>";
                            // head +=    '<th>NAME</th>';
                            // head +=    '<th>Category</th>';
                            // var num = 1;
                            // $.each(rawdata.judges.count.Beauty,function(i,v){
                            //     num++;
                            // })
                            // head +=    "<th colspan = '" + num +"'class = 'text-center'>Beauty</th>";
                            // head +=    "<th colspan = '" + num +"'class = 'text-center'>Brain</th>";
                            // head +=    '<th> Total Score</th>';
                            // head += '</tr>';
                            // head += '<tr>';
                            // head +=    '<th colspan = "3"></th>';
                            // $.each(rawdata.judges.count.Beauty,function(i,v){
                            //     head += '<th>'+ v[1]+'</th>';
                            // })
                            // head += '<th>Subtotal</th>';
                            // $.each(rawdata.judges.count.Brain,function(i,v){
                            //     head += '<th>'+ v[1]+'</th>';
                            // })
                            // head += '<th>Subtotal</th>';
                            // //console.log(rawdata);
                            // $.each(rawdata.score,function(index,value){
                            //     text += '<tr>\n';
                            //     $.each(rawdata.numb,function(x,y){
                            //         //console.log(y);
                            //         if(y.name == value.Candidate){
                            //             text += '<td>' + y.number + '</td>\n';
                            //         }
                            //     });
                            //     // text += '<td>' + data + '</td>\n';
                            //     text += '<td>' + value.Candidate + '</td>\n';
                            //     text += '<td>' + value.Cat + '</td>\n';
                            //     $.each(rawdata,function(index1,value1){
                            //         if(index1 != 'score' && index1 != 'numb'){
                                        
                            //             var data = value1.Brain;
                            //             var sum = 0;
                            //             var count = 0;
                            //             $.each(data,function(index2,value2){
                            //                 if(value.Candidate == value2.Candidate){
                            //                     text += '<td>' + value2.score + '</td>\n';
                            //                     sum = sum + parseFloat(value2.score);
                            //                     count++;
                            //                 }
                            //             })
                            //             text += '<td>' + (sum / count).toFixed(3) + '</td>\n';
                            //             var sum1 = 0;
                            //             var count1 = 0;
                            //             var data = value1.Beauty;
                            //             $.each(data,function(index2,value2){
                            //                 if(value.Candidate == value2.Candidate){
                            //                     text += '<td>' + value2.score + '</td>\n';
                            //                     sum1 = sum1 + parseFloat(value2.score);
                            //                     count1++;
                            //                 }
                            //             })
                            //             text += '<td>' + (sum1 / count1).toFixed(3) + '</td>\n';
                            //         }
                            //     })
                            //     text += '<td>' + value.Score + '</td>\n';          
                            //     text += '</tr>\n';
                            //     x++;
                            // })
                            // head += '</tr>';
                            //console.log(data);
                            var head = "<tr>";
                            head += "<th>#</th>";
                            head += "<th>Name</th>";
                            head += "<th>Baranggay</th>";
                            head += "<th>Description</th>";
                            head += "<th>Beauty</th>";
                            head += "<th>Intelligence</th>";
                            head += "<th>Score</th>";
                            head += "</tr>";
                            // head += "<tr>";
                            // head += "<th>Beauty</th>";
                            // head += "<th>Intelligence</th>";
                            // head += "</tr>";

                            $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table thead").html(head);
                            $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table tbody").html(data);
                        }
                        
                    })
                }else{
                    var head = "";
                    head +=  '<tr>';
                    head +=  '<th>#</th>';
                    head +=  '<th>NAME</th>';
                    head +=   '<th>Baranggay</th>';
                    // head +=    '<th>Piolo</th>';
                    // head +=    '<th>Kim</th>';
                    
                    
                    $.post('php/category.php',{ca:cat},function(data){
                        if(data == 0){
                            $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table tbody").html('No data at the Moment!');
                        }else{
                            var rawdata = JSON.parse(data);
                            //console.log(rawdata);
                            var text = '';
                            var x = 1;
                            $.each(rawdata.judges.count,function(index1,value1){
                                head +=    '<th>'+ value1[1]+ '</th>';
                            })
                            head +=    '<th>Total Score</th>';
                            head += '</tr>';
                            $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table thead").html(head);
                            $.each(rawdata.score,function(index,value){
                                    text += '<tr>\n';
                                    $.each(rawdata.number,function(x,y){
                                        if(y.name == value.Candidate){
                                            text += '<td>' + y.number + '</td>\n';
                                            text += '<td>' + y.name + '</td>\n';
                                            text += '<td>' + y.team + '</td>\n';
                                            text += '<td>' + y.descript + '</td>\n';
                                        }
                                    });
                                    // text += '<td>' + value.Candidate + '</td>\n';
                                    // text += '<td>' + value.Cat + '</td>\n';
                                    if(rawdata.judges.jud != undefined){
                                        var jd = rawdata.judges.jud;
                                        $.each(jd,function(index1,value1){
                                            if(value.Candidate == value1.Candidate){
                                                //console.log(value1);
                                                text += "<td class = 'text-center'>" + value1.score + '</td>\n';
                                            }
                                        })
                                    }
                                    text += '<td>' + value.Score + '</td>\n';
                                    text += '</tr>\n';
                                x++;
                            })
                            
                            $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table tbody").html(text);
                        }
                        
                    })
                    
                }
                
            });
        }
        
    }
    $("#title").html(cat);
});

$('#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .col-md-3 #judges').change(function(){
    var cat = $(this).val();

    if(cat != ''){
        $.post('php/judges.php',{ca:cat},function(data){
            if(data == 0){
                $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table tbody").html('No data at the Moment!');
            }else{
                var rawdata = JSON.parse(data);
                //console.log(rawdata);
                var text = '';
                var x = 1;
                var head = "";
                head += "<tr>";
                head += "<th>#</th>";
                head +=    '<th>NAME</th>';
                $.each(rawdata[0],function(i,v){
                    head +=    '<th>' + v.cat + '</th>';
                })
                head +=    '<th>Final</th>';
                head += '</tr>';
                console.log(rawdata);
                $.each(rawdata,function(index,value){
                    if(index != 'number'){
                        text += '<tr>\n';
                        $.each(rawdata.number,function(x,y){
                            if(y.name == value[0].Candidate){
                                text += '<td>' + y.number + '</td>\n';
                            }
                        });
                        text += '<td>' + value[0].Candidate + '</td>\n';
                        $.each(value,function(ind,val){
                            text += '<td>' + val.score + '</td>\n';
                        })      
                        text += '</tr>\n';
                        x++;
                    }
                })
                $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table thead").html(head);
                $("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table tbody").html(text);
            }
            
        })
        
    }
    $("#title").html(cat);
});
/*
================================================================================
PRINTING JS
================================================================================
*/

$('.container .row .col-md-12 .white-box .col-md-3 #category').change(function(){
    var cat = $(this).val();

    if(cat != ''){
        if(cat == "Ranking"){
            $.post('php/category.php',{ca:cat},function(data){
                if(data == 0){
                    $(".container .row .col-md-12 .white-box .table-responsive .table tbody").html('No data at the Moment!');
                }else{
                    var rawdata = JSON.parse(data);
                    //console.log(rawdata);
                    var text = '';
                    var x = 1;
                    var head = "";
                    head += "<tr>";
                    head += "<th>#</th>";
                    head +=    '<th>NAME</th>';
                    head +=    '<th>Production</th>';
                    head +=    '<th>Swim Wear</th>';
                    head +=    '<th>Talent</th>';
                    head +=    '<th>Gown</th>';
                    head +=    '<th>Prelim</th>';
                    head +=    '<th>Total Score</th>';
                    head += '</tr>';
                    //console.log(rawdata);
                    $.each(rawdata,function(index,value){
                        text += '<tr>\n';
                        text += '<td>' + x + '</td>\n';
                        text += '<td>' + value[0].Candidate + '</td>\n';
                        text += '<td>' + value[1].Score + '</td>\n';
                        text += '<td>' + value[2].Score + '</td>\n';
                        text += '<td>' + value[3].Score + '</td>\n';
                        text += '<td>' + value[4].Score + '</td>\n';
                        text += '<td>' + value[5].Score + '</td>\n';
                        text += '<td>' + value[0].Score + '</td>\n';          
                        text += '</tr>\n';
                        x++;
                    })
                    $(".container .row .col-md-12 .white-box .table-responsive .table thead").html(head);
                    $(".container .row .col-md-12 .white-box .table-responsive .table tbody").html(text);
                }
                
            })
        }else{
            $.post('php/crit.php',{ca:cat},function(data1){
                if(data1 >= 1){
                    $.post('php/category.php',{ca:cat},function(data){
                        if(data == 0){
                            $(".container .row .col-md-12 .white-box .table-responsive .table tbody").html('No data at the Moment!');
                        }else{
                            var rawdata = JSON.parse(data);
                            //console.log(rawdata);
                            var text = '';
                            var x = 1;
                            var head = "";
                            head += "<tr>";
                            head += "<th>#</th>";
                            head +=    '<th>NAME</th>';
                            head +=    '<th>Category</th>';
                            var num = 1;
                            $.each(rawdata.judges.count.Beauty,function(i,v){
                                num++;
                            })
                            head +=    "<th colspan = '" + num +"'class = 'text-center'>Beauty</th>";
                            head +=    "<th colspan = '" + num +"'class = 'text-center'>Brain</th>";
                            head +=    '<th>Total Score</th>';
                            head += '</tr>';
                            head += '<tr>';
                            head +=    '<th colspan = "3"></th>';
                            $.each(rawdata.judges.count.Beauty,function(i,v){
                                head += '<th>'+ v[1]+'</th>';
                            })
                            head += '<th>Subtotal</th>';
                            $.each(rawdata.judges.count.Brain,function(i,v){
                                head += '<th>'+ v[1]+'</th>';
                            })
                            head += '<th>Subtotal</th>';
                            //console.log(rawdata);
                            $.each(rawdata.score,function(index,value){
                                text += '<tr>\n';
                                text += '<td>' + x + '</td>\n';
                                text += '<td>' + value.Candidate + '</td>\n';
                                text += '<td>' + value.Cat + '</td>\n';
                                $.each(rawdata,function(index1,value1){
                                    if(index1 != 'score'){
                                        
                                        var data = value1.Brain;
                                        var sum = 0;
                                        var count = 0;
                                        $.each(data,function(index2,value2){
                                            if(value.Candidate == value2.Candidate){
                                                text += '<td>' + value2.score + '</td>\n';
                                                sum = sum + parseFloat(value2.score);
                                                count++;
                                            }
                                        })
                                        text += '<td>' + sum / count + '</td>\n';
                                        var sum1 = 0;
                                        var count1 = 0;
                                        var data = value1.Beauty;
                                        $.each(data,function(index2,value2){
                                            if(value.Candidate == value2.Candidate){
                                                text += '<td>' + value2.score + '</td>\n';
                                                sum1 = sum1 + parseFloat(value2.score);
                                                count1++;
                                            }
                                        })
                                        text += '<td>' + (sum1 / count1) + '</td>\n';
                                    }
                                })
                                text += '<td>' + value.Score + '</td>\n';          
                                text += '</tr>\n';
                                x++;
                            })
                            head += '</tr>';
                            $(".container .row .col-md-12 .white-box .table-responsive .table thead").html(head);
                            $(".container .row .col-md-12 .white-box .table-responsive .table tbody").html(text);
                        }
                        
                    })
                }else{
                    var head = "";
                    head +=  '<tr>';
                    head +=  '<th>#</th>';
                    head +=  '<th>NAME</th>';
                    head +=   '<th>Category</th>';
                    // head +=   '<th>Maine</th>';
                    // head +=    '<th>Piolo</th>';
                    // head +=    '<th>Kim</th>';
                    
                    
                    $.post('php/category.php',{ca:cat},function(data){
                        if(data == 0){
                            $(".container .row .col-md-12 .white-box .table-responsive .table tbody").html('No data at the Moment!');
                        }else{
                            var rawdata = JSON.parse(data);
                            //console.log(rawdata);
                            var text = '';
                            var x = 1;
                            $.each(rawdata.judges.count,function(index1,value1){
                                head +=    '<th>'+ value1[1]+ '</th>';
                            })
                            head +=    '<th>Total Score</th>';
                            head += '</tr>';
                            $(".container .row .col-md-12 .white-box .table-responsive .table thead").html(head);
                            $.each(rawdata.score,function(index,value){
                                    text += '<tr>\n';
                                    text += '<td>' + x + '</td>\n';
                                    text += '<td>' + value.Candidate + '</td>\n';
                                    text += '<td>' + value.Cat + '</td>\n';
                                    if(rawdata.judges.jud != undefined){
                                        var jd = rawdata.judges.jud;
                                        $.each(jd,function(index1,value1){
                                            if(value.Candidate == value1.Candidate){
                                                //console.log(value1);
                                                text += '<td>' + value1.score + '</td>\n';
                                            }
                                        })
                                    }
                                    text += '<td>' + value.Score + '</td>\n';
                                    text += '</tr>\n';
                                x++;
                            })
                            
                            $(".container .row .col-md-12 .white-box .table-responsive .table tbody").html(text);
                        }
                        
                    })
                    
                }
                
            });
        }
        
    }
});

$('.container .row .col-md-12 .white-box .col-md-3 #judges').change(function(){
    var cat = $(this).val();

    if(cat != ''){
        $.post('php/judges.php',{ca:cat},function(data){
            if(data == 0){
                $(".container .row .col-md-12 .white-box .table-responsive .table tbody").html('No data at the Moment!');
            }else{
                var rawdata = JSON.parse(data);
                //console.log(data);
                var text = '';
                var x = 1;
                var head = "";
                head += "<tr>";
                head += "<th>#</th>";
                head +=    '<th>NAME</th>';
                $.each(rawdata[0],function(i,v){
                    head +=    '<th>' + v.cat + '</th>';
                })
                head += '</tr>';
                console.log(rawdata);
                $.each(rawdata,function(index,value){
                    text += '<tr>\n';
                    text += '<td>' + x + '</td>\n';
                    text += '<td>' + value[0].Candidate + '</td>\n';
                    $.each(value,function(ind,val){
                        text += '<td>' + val.score + '</td>\n';
                    })      
                    text += '</tr>\n';
                    x++;
                })
                $(".container .row .col-md-12 .white-box .table-responsive .table thead").html(head);
                $(".container .row .col-md-12 .white-box .table-responsive .table tbody").html(text);
            }
            
        })
        
    }
});