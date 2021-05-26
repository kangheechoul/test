
$(function () {
    var isMobile;
    var isAndroid;
    var downEvent, moveEvent, upEvent, clickEvent, overEvent, outEvent;
  
    if (
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
      ) ||
      (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1)
    ) {
      isMobile = true;
      downEvent = 'touchstart';
      moveEvent = 'touchmove';
      upEvent = 'touchend';
      clickEvent = 'click';
    } else {
      isMobile = false;
      downEvent = 'mousedown';
      moveEvent = 'mousemove';
      overEvent = 'mouseover';
      outEvent = 'mouseout';
      upEvent = 'mouseup';
      clickEvent = 'click';
    }
    $(
      '.stopwatch, .timer, .timer_choice ul li, .key_number ul li, .btn_start, .btn_clear, .btn_restart, .btn_pause, .btn_reset, .btn_s_start, .btn_s_record, .btn_s_stop, .btn_s_restart, .btn_s_reset'
    )
      .on(overEvent, function () {
        $(this).addClass('ON');
      })
      .on(outEvent, function () {
        $(this).removeClass('ON');
      }); // 버튼 over
  
    $('.timer').bind('click', function () {
      $('.main_timer').show();
      $('.main_stopwatch').hide();
      $('.s_box').hide();
      $('.timer_box').hide();
      $('.main').css({ background: 'url(./images/timer/timer1_1.png)' });
      $('body').css({ background: '#043668' });
    });
  
    $('.stopwatch').bind('click', function () {
      $('.main_timer').hide();
      $('.main_stopwatch').show();
      $('.s_box').show();
      $('.timer_box').hide();
      $('.main').css({ background: 'url(./images/timer/stopwatch_bg.png)' });
      $('body').css({ background: '#e2c49a' });
    });
  
    $('.btn_start').bind('click', function () {
      $('.main_timer').hide();
      $('.timer_box').show();
    });
    ////////////// 타이머 /////////////////
    var timeSelect = []; //시간 값
    var hour; //시
    var min; //분
    var sec; //초
    var msec; //밀리초
  
    $('.key_number> ul >li').each(function (idx) {
      // 시간 클릭시 시간 값 출력
      $(this).on('click', function () {
        //숫자 키 클릭시
        console.log('숫자가 눌림.');
  
        var Timeval = $(this).data('value'); //클릭 한 시간 값
        console.log('값' + Timeval);
        //timeSelect.push(Timeval); // 클릭한 값 배열로 담기
        timeSelect.unshift(Timeval); // 클릭한 값 배열로 담기
        for (var i = 0; i < timeSelect.length; i++) {
          //빈값에 값 넣기
          if (timeSelect[i] === '') {
            timeSelect.push(0);
          }
        }
  
        console.log(timeSelect + '   '); // 배열 담긴 시간 값 확인
        $('.t-mir:nth-child(2)').val(timeSelect[0]);
        $('.t-mir:nth-child(1)').val(timeSelect[1]);
        $('.t-sec:nth-child(2)').val(timeSelect[2]);
        $('.t-sec:nth-child(1)').val(timeSelect[3]);
        $('.t-min:nth-child(2)').val(timeSelect[4]);
        $('.t-min:nth-child(1)').val(timeSelect[5]);
      });
    });
    var timer_ch = 1; // 타이머 기본 값
    $('.timer_choice >ul >li').on('click', function () {
      timer_ch = $(this).data('index');
      console.log('타이머 값 설정 :' + timer_ch);
    });
  
    $('.btn_start').on('click', function () {
      //타이머 시작버튼 눌렀을때 화면 전환
      if (timer_ch == 4) {
        $('.main').show();
        $('.main').css({ background: 'url(./images/timer/timer_bg5.png)' });
        $('.main').css('background-size', '100%');
      }
      console.log('다시 한번 확인' + timeSelect + ' ');
      //시간 값 넣기
  
      for (var i = 0; i < timeSelect.length; i++) {
        if (timeSelect[i] == undefined || timeSelect[i] == '') {
          timeSelect[i] = 0;
        }
      }

    //   for (var i = 0; i < 6; i++) {
    //     if (timeSelect[i] == undefined) {
    //       timeSelect[i] = 0;
    //       console.log('입력되었습니다....' + timeSelect[i]);
    //     }
    //   }
  
      hour = timeSelect[5] + '' + timeSelect[4];
  
      $('.timer_hour').text(hour); //시
      $('.timer_min').text(timeSelect[3] + '' + timeSelect[2]); //분
      $('.timer_sec').text(timeSelect[1] + '' + timeSelect[0]); //초
  
      // time =
      //   timeSelect[5] +
      //   '' +
      //   timeSelect[4] +
      //   '' +
      //   timeSelect[3] +
      //   '' +
      //   timeSelect[2] +
      //   '' +
      //   timeSelect[1] +
      //   '' +
      //   timeSelect[0] +
      //   ''; // 전체 시간 담기
  
      //time.replace(0, '').replace('//gt', '');
  
      // time = time.replace(',', '');
      // console.log('총 시간 값' + time.replace(null, '0'));
  
      hour = timeSelect[5] + '' + timeSelect[4]; //시
      min = timeSelect[3] + '' + timeSelect[2]; //분
      sec = timeSelect[1] + '' + timeSelect[0]; //초
      // hour = hour / 60;
      // min = (min % 60) * 60;
      // sec = Math.floor(sec % (1000 * 60));
      msec = 99;
      // console.log(sec.substring(0, 1)); //0
  
      /***/ //// */ */ */
      //var seconds = Math.floor((RemainDate % (1000 * 60)) / 1000);
      // sec = $('.timer_sec').text();
      //   // console.log('sec' + sec);
      //   if (sec.substring(0, 0) == 0 || sec.substring(0, 0) == '0') {
      //     sec.replace(0, 'dddddddd');
      //     console.log('sec yy' + sec);
      //   }
      // //var sec2 = sec.indexOf(0, 0);
      // console.log('dma' + sec);
      if (hour.substring(0, 0) == 0) {
        console.log('0이 있어요.');
        hour = hour.replace('0', '');
        console.log(hour);
      }
      if (min.substring(0, 0) == 0) {
        console.log('0이 있어요.');
        min = min.replace('0', '');
        console.log(min);
      }
      if (sec.substring(0, 0) == 0) {
        console.log('0이 있어요.');
        sec = sec.replace('0', '');
        console.log(sec);
      }
    }); // 정수로부터 남은 시, 분, 초 단위 계산
    // hour = time / 3600;
    // console('t시간은' + hour);
    // min = Math.floor((time - hour * 3600) / 60);
  
    // sec = time - hour * 3600 - min * 60;
  
    /////타이머/////
  
    // $('.timer_sec').html(second);
    var timer = setInterval(function () {
      // 설정
  
      $('.timer_hour').html(hour);
      $('.timer_min').html(min);
      $('.timer_sec').html(sec);
      $('.timer_ms').html(msec);
      // if (hour == 0) {
      //   $('.timer_hour').html('00');
      // }
      // if (min == 0) {
      //   $('.timer_min').html('00');
      // }
      // if (sec == 0) {
      //   $('.timer_sec').html('00');
      // }
  
      if (hour == 0 && min == 0 && sec == 0 && msec == 0) {
        //  alert('타이머 종료.');
        $('.timer_hour').html('00');
        $('.timer_min').html('00');
        $('.timer_sec').html('00');
        $('.timer_ms').html('00');
        clearInterval(timer); /* 타이머 종료 */
      } else {
        //밀리초 처리
        msec--;
  
        if (hour < 10) {
          // 10초 미만일때 앞에 0 붙이기
          $('.timer_hour').html('0' + hour);
        }
        if (min < 10) {
          // 10초 미만일때 앞에 0 붙이기
          $('.timer_min').html('0' + min);
        }
        if (sec < 10) {
          // 10초 미만일때 앞에 0 붙이기
  
          $('.timer_sec').html('0' + sec);
        }
        if (msec < 10) {
          // 10초 미만일때 앞에 0 붙이기
          $('.timer_ms').html('0' + msec);
        }
        // 초 처리
  
        if (msec < 0) {
          sec--;
          msec = 99;
        }
  
        // 분 처리
  
        if (sec < 0) {
          if (min > 0) {
            min--;
            sec = 59;
          }
        }
  
        //시간처리
  
        if (min < 0) {
          if (hour > 0) {
            hour--;
            min = 59;
          }
        }
      }
    }, 0.1); /* millisecond 단위의 인터벌 10 */
  }); // 제이쿼리 끝