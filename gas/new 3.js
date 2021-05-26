jq(document).ready(function() {
	//10초마다 수강시간 저장
	//StudyEndLog();

	/*
	jq(window).unload(function(){
		try {
			if(slNo) {
				clearTimeout(endLog);
				jq.post("/Study/Proc/StudyEndLog/"+slNo+url_suffix);
			}
			opener.location.reload();
		} catch (e) { }
	});
	*/

	jq(window).bind("unload",function(){
		try {
			if(slNo) {
				clearTimeout(endLog);
				jq.post("/Study/Proc/StudyEndLog/"+slNo+url_suffix);
			}
			opener.location.reload();
		} catch (e) { }
	});
	
	jq(".notice, .help, .progress, .score, .qna, .chatting, .forum").click(function(){
		studyMenuView(jq(this).attr("class"));
	});
	
	jq(".spmClose").click(function(){
		jq(".spmArea").slideUp("fast");
		jq(".spm").slideUp("fast");
		jq(".iframeArea").html(iframeAreaHTML);
		iframeAreaHTML = "";
		jq(".iframeArea").slideDown("fast");
	});
	
	jq(".help2").click(function(){
		jq(".helpStep1").hide();
		jq(".helpStep2").show();
		jq(".helpStep3").hide();
	});
	jq(".help3").click(function(){
		jq(".helpStep1").hide();
		jq(".helpStep2").hide();
		jq(".helpStep3").show();
	});

	/*
	checkBrowser = navigator.userAgent.match(/Chrome|Firefox|MSIE/);
	if(checkBrowser == "Chrome") {
		resizePopup(Number(width)+16, Number(height)+90);
	} else if(checkBrowser == "Firefox") {
		resizePopup(Number(width)+16, Number(height)+100);
	} else if(checkBrowser == "MSIE") {
		resizePopup(Number(width)+16, Number(height)+90);
	} else {
		resizePopup(Number(width),Number(height));
		heightMore = Number(height) - window.innerHeight;
		widthMore = Number(width) - window.innerWidth;
		if(jq(".studyPopupMenu").hasClass("studyPopupMenu")) {
			studyPopupMenuHeight = 23;
		} else {
			studyPopupMenuHeight = 0;
		}
		resizePopup(Number(width)+Number(widthMore), Number(height)+Number(heightMore) + studyPopupMenuHeight);
	}
	*/
	
	
	jq(".studyPopupClose").click(function(){
		window.close();
	});
});