function getResult(feature,column) {
    // alert('hhh');
    // alert(base_url + "data/getFeatureDetails/?feature=" + feature);
    $.ajax({
        url: base_url + "data/getFeatureDetails/?feature=" + feature,
        type: "GET",
        success: function(data){
            // console.log("hi" + JSON.parse(data));
            // alert(data);
           var columnNum = ".column" + column; 
           var monthNames = ["ಜನವರಿ","ಫೆಬ್ರವರಿ","ಮಾರ್ಚ್","ಏಪ್ರಿಲ್","ಮೇ","ಜೂನ್","ಜುಲೈ","ಆಗಸ್ಟ್","ಸೆಪ್ಟೆಂಬರ್","ಅಕ್ಟೋಬರ್","ನವೆಂಬರ್","ಡಿಸೆಂಬರ್"]; 
           var displayString = "";
           var obj = JSON.parse(data);
           var displayString = "";
           if(feature == 'ಸಂಪಾದಕೀಯ'){
                var page = obj[0]['page'].split("-");
                displayString = displayString + '<div class="widget">';
                displayString = displayString + '<div class="tbar">' + monthNames[parseInt(obj[0]['issue']) - 1] + ' ಸಂಚಿಕೆ</div>';
                displayString = displayString + '<img src=' + base_url + 'public/images/viveka.png' + ' alt="cover"><br>';
                displayString = displayString + '<img src=' + base_url + 'public/images/cover.png' + ' alt="175 anniversary"><br>';
                displayString = displayString + '<span class="title"><br></span>';
                displayString = displayString + '<span class="text"><a href="'+ base_url + 'public/Volumes/djvu/' + obj[0]['volume'] + '/' + obj[0]['issue'] + '/index.djvu?djvuopts&page=' + page[0] +'&zoom=page">ಸಂಪಾದಕೀಯ: ' + obj[0]['title'] + '</a></span>';
                displayString = displayString + '</div>'; 
            
            }
           else{
                if(column == 1){

                    displayString = displayString + '<div class="art_widget_col1">';
                }
                else{
                    displayString = displayString + '<div class="art_widget">';
                }
                displayString = displayString + '<div class="tbar">'+ feature +'</div>';

                for(i=0;i<obj.length;i++){
                    var page = obj[i]['page'].split("-");
                    displayString = displayString + '<div><img class="art_widget_img" src="'+ base_url + 'public/Volumes/djvu/' + obj[i]['volume'] + '/' + obj[i]['issue'] + '/images/' + parseInt(page[0]) + '.png" alt="cover"></div>';
                    displayString = displayString + '<div style="width: 40%;" class="text"><span class="titlespan"><a href="'+ base_url + 'public/Volumes/djvu/' + obj[i]['volume'] + '/' + obj[i]['issue'] + '/index.djvu?djvuopts&page=' + page[0] +'&zoom=page" target="_blank">';
                    displayString = displayString + obj[i]['title'] + '</a></span><br>';
                    displayString = displayString + obj[i]['text'];
                    displayString = displayString + '</div>';
                    displayString = displayString + '<div class="further"><span class="furtherspan"><a href="'+ base_url + 'public/Volumes/djvu/' + obj[i]['volume'] + '/' + obj[i]['issue'] + '/index.djvu?djvuopts&page=' + page[0] +'&zoom=page" target="_blank">ಮುಂದೆ ಓದಿ..</a></span></div>';
                    if(i!=(obj.length-1)){
                        displayString =  displayString + '<div class="art_widget_rule"></div>'; 
                    }   
                }   
                displayString = displayString + '</div>';

                // alert(displayString);
           }    

            $(columnNum).append(displayString);
            displayString = '';
        },
        error: function(){console.log("Fail");}             
  });
}


$(document).ready(function() {

    var isWider = $( '.wider' );
    isWider.next( '.container' ).addClass( 'push-down' );

    if(isWider.length) {
        $( window ).scroll(function() {

            var tp = $( 'body' ).scrollTop();

            if(tp > 50) {

                $( '.navbar' ).removeClass( 'wider') ;
            }
            else if(tp < 50) {
        
                $( '.navbar' ).addClass( 'wider') ;
            }
        }); 
    }
    
    var hloc = window.location.href;
    if(hloc.match('#')){

        var jumpLoc = $( '#' + hloc.split("#")[1] ).offset().top - 105;

        $("html, body").animate({scrollTop: jumpLoc}, 1000);
    }

    $( '.navbar-nav li a').on('click', function(event){

        // event.preventDefault();

        var jumpLoc = $( '#' + $( this ).attr( "href" ).split('#')[1] ).offset().top - 105;

        $("html, body").animate({scrollTop: jumpLoc}, 1000);
    });

    $(".TOCtoggle").click(function(){

        var divID = "#toc-" + $(this).attr('data-name'); 
        $(divID).slideToggle(1, function(){

            buildMasonry();
           
        });
    });  

});


