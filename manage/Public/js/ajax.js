
function cake(id){
	ajax(id);
	ajax1(id);
}



function ajax(id)
{	
		$.ajax({
             type: "POST",
             url: url,
             data: {content: id},
             dataType: "json",
             success: function(data){
             			$(".answer_box").empty();
                        $('#less').css('display','none');
                        $('#more').css('display','block');
                        if (data.status==200) {
                            if (data.content.length<1){
                                var html = "<div class='answer'><h1 class='answer_name'></h1><span class='answer_num'>"+(i+1)+"楼</span><span class='answer_content'>暂无回复</span><span class='answer_date'></span></div>";
                                    $(html).appendTo(".answer_box");
                            }
                            if (data.content.length>1||data.content.length==1) {
                                for (var i = 0; i < 2; i++) {
                                    var html = "<div class='answer'><h1 class='answer_name'>"+data.content[i].username+"</h1><span class='answer_num'>"+(i+1)+"楼</span><span class='answer_content'>"+data.content[i].content+"</span><span class='answer_date'>"+new Date(parseInt(data.content[i].time) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ")+"</span></div>";
                                    $(html).appendTo(".answer_box");
                                    
                                };
                                for (var i = 2; i < data.content.length; i++) {
                                    var html = "<div class='answer_none'><h1 class='answer_name'>"+data.content[i].username+"</h1><span class='answer_num'>"+(i+1)+"楼</span><span class='answer_content'>"+data.content[i].content+"</span><span class='answer_date'>"+new Date(parseInt(data.content[i].time) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ")+"</span></div>";
                                    $(html).appendTo(".answer_box");
                                };
                            };
                         }
                         else
                         {
                         	alert("错误!");
                         }
                         
                    
                     

                      }
         });

}




function ajax1(id)
{	
		$.ajax({
             type: "POST",
             url: url1,
             data: {content: id},
             dataType: "json",
             success: function(data){
             			
                          if (data.status==200) {
                          $(".question_title").text(data.content.title);
                          $(".question_content").text(data.content.content);
                          $(".asker").text(data.content.username);
                       var time = new Date(parseInt(data.content.time) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ")
                       $(".question_date").text(time);
                       $(".question").attr("value",data.content.question_id);
                          }
                         else
                         {
                         	alert("错误!");
                         }
                                       

                      }
         });

}



function ajax2()
{
	var question_id = $("#reply_question").attr("value");
	var  reply = $("#my_reply").val();
	
	

	$.ajax({
         type: "POST",
         url: url2,
         data: {username:question_id,content:reply},
         dataType: "json",
         success: function(data){
        	 if(data.status==200)
        		 {
        		 alert("回复成功");
        		 $("#my_reply").val('');
        		
        		 }
        	 if(data.status==0)
        		 {
        		 alert("回复不能为空");
        		 }
        	 if(data.status!=0&&data.status!=200)
        	 {
        		 alert("回复失败");
        		 }
         }

	  });
    var parentnode = $('.response').parent().parent().attr('class');
    $.ajax({
             type: "POST",
             url: url,
             data: {content: parentnode},
             dataType: "json",
             success: function(data){
                        $(".answer_box").empty();
                        if (data.status==200) {
                            if (data.content.length<1){
                                var html = "<div class='answer'><h1 class='answer_name'></h1><span class='answer_num'>"+(i+1)+"楼</span><span class='answer_content'>暂无回复</span><span class='answer_date'></span></div>";
                                    $(html).appendTo(".answer_box");
                            }
                            if (data.content.length>1||data.content.length==1) {
                                for (var i = 0; i < 2; i++) {
                                    var html = "<div class='answer'><h1 class='answer_name'>"+data.content[i].username+"</h1><span class='answer_num'>"+(i+1)+"楼</span><span class='answer_content'>"+data.content[i].content+"</span><span class='answer_date'>"+new Date(parseInt(data.content[i].time) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ")+"</span></div>";
                                    $(html).appendTo(".answer_box");
                                    
                                };
                                for (var i = 2; i < data.content.length; i++) {
                                    var html = "<div class='answer_none'><h1 class='answer_name'>"+data.content[i].username+"</h1><span class='answer_num'>"+(i+1)+"楼</span><span class='answer_content'>"+data.content[i].content+"</span><span class='answer_date'>"+new Date(parseInt(data.content[i].time) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ")+"</span></div>";
                                    $(html).appendTo(".answer_box");
                                };
                            };
                            if ($('#less').css('display')=='block') {
                                $('.answer_none').css('display','block');
                            };
                         }
                         else
                         {
                            alert("错误!");
                         }
                         
                    
                     

                      }
         });
}