$(document).ready(function(){    
    function add_header_init(){
        // pc 버전 시작
        $(".gnb > li").mouseover(function () {
            $(".main_nav").addClass("current");
        })
        $(".gnb li").mouseout(function () {
            $(".main_nav").removeClass("current");
        });
        // pc 버전 버거 메뉴
        $('#pc-burger').click(function(){
            $('.main_nav').toggleClass("current");
            $('.header-bg').slideToggle('slow');
            $('.sub_dep ul').css('background','transparent');
            $('.sub_dep').slideToggle('slow');  
        });

        // 모바일 버전 버거 메뉴
        var click_flag = true;
        $('#mobile-burger').click(function(e){
            //버거 클릭시 외부 scroll 없애기
            if(click_flag){
                $('html, body').css({'overflow-Y' : 'hidden', 'height' : '100%', 'position' : 'fixed', 'width' : '100%'});
                click_flag = false;
            }else{
                $('html, body').css({'overflow-Y' : 'auto', 'height' : 'auto', 'width' : 'auto', 'position' : 'static'});
                click_flag= true;
            }
            e.preventDefault();
            $(this).toggleClass('actived');
            $('.mobile_nav').toggleClass('active');
            $('.mobile_gnb_wrap').toggleClass('opened');
        });
        
        //버거 메뉴가 열린 상태로 사이즈가 커지면 스크롤바 생성
        window.addEventListener('resize', function(){
            var mobile_gnb = document.querySelector('.mobile_gnb_wrap').className;
            if(mobile_gnb == 'mobile_gnb_wrap opened'){ //모바일 버거 메뉴가 열려있으면
                if($(document).width() > 1024){ //1024이상이면 스크롤 생성
                    $('html, body').css({'overflow-Y' : 'auto', 'height' : 'auto', 'width' : 'auto', 'position' : 'static'});
                }else{
                    $('html, body').css({'overflow-Y' : 'hidden', 'height' : '100%', 'position' : 'fixed', 'width' : '100%'}); 
                }
            }
        });
    }
    add_header_init();
});



