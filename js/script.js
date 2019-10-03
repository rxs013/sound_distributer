function getd(){
    //var param = { "text": "disctitle" };
    $.ajax({
       // type: "GET",
        url: "/js/getdiscs.php",
       // data: param,
        dataType : "json",
        scriptCharset: 'utf-8',
        success: function(data) {
            // 取得したレコードをeachで順次取り出す
            $.each(data, function(key, value){ 
			var $buf = '<div class="disc" id='+value.id+'><img class="jacket" src="/discs/'+value.id+'/mini-jacket.png" onerror=\'this.src="/discs/mini-noimage.png"\'>'+value.name+"</div>";
            $('.discs').append($buf);
            $("#"+ value.id).append('<div class="tracks" id="'+value.id+'-t"></div>');
            $("#"+ value.id+"-t").css("display","none");
            gett(value.id);
		})
         }
		 });}

function gett(disc){    
    $.ajax({
         type: "POST",
         url: "/js/gettracks.php",
         data: {'request':disc},
         dataType : "json",
         scriptCharset: 'utf-8',
         success: function(result) {
             // 取得したレコードをeachで順次取り出す
             $.each(result, function(key, value){ 
             var $buf = '<div class="track" id='+disc+"-"+value.track+'><audio class="player" controls controlslist="nodownload" src="/discs/'+disc+ '/'+ value.file +' preload="none"></audio><p class="tracktxt">Title: '+value.title+'<br>Composer: '+value.p+'<br>Vocal: '+value.vo+'</p></div>';
             $("#"+disc+"-t").append($buf);
         })
          },
          error: function(XMLHttpRequest, textStatus, errorThrown){
            alert('Error : ' + errorThrown);
          },});
}
