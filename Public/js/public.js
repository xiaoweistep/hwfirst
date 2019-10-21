$(function () {
    $(window).scroll(function () {
        var scrollY = $(window).scrollTop() // 获取垂直滚动的距离，即滚动了多少
        if (scrollY > 600) {
            $("#backTop").fadeIn(500)
        }
        else {
            $("#backTop").fadeOut(500)
        }
    });
    $('#backTop').click(function(e) {
		$('html,body').animate({ scrollTop:0 },500)
    });

    $('#index-search').hover(function () {
        $(this).css('width', '260px')
    }, function () {
        if ($('#index-search').val().length > 0) {
            $(this).css('width', '260px')
        } else {
            if ($('#index-search').is(":focus")) {
                $(this).css('width', '260px')
            } else {
                $(this).css('width', '180px')
            }
        }
    })
    $('#index-search').focus(function () {
        $(this).css('width', '260px')
        setTimeout(function () {
            $('.search-box dl').css('display', 'block')
        }, 300)
    })
    $('#index-search').blur(function () {
        $('#index-search').val('')
        $('#deleteValue').css('display', 'none')
        $('.search-box dl').css('display', 'none')
        if ($(this).val().length > 0) {
            $(this).css('width', '260px')
        } else {
            $(this).css('width', '180px')
        }
    })
    $('#index-search').keyup(function () {
        if ($(this).val().length > 0) {
            $('#deleteValue').css('display', 'block')
        } else {
            $('#deleteValue').css('display', 'none')
        }
    })
    $('.delete-icon').eq(0).click(function () {
        $('#index-search').val('')
        $('#index-search').focus()
    })

    /*顶部导航下滑线*/
    $('.header-floor2').eq(0).children('ul').children('li').hover(function () {
        var le = 0
        if ($(this).index() > 0) {
            for (var i = 0; i < $(this).index(); i++) {
                le += $('.header-floor2').eq(0).children('ul').children('li').eq(i).width()
            }
        }
        $('#span').css('left', le + 'px')
        $('#span').css('width', $(this).width() + 'px')
        $('.headContent').attr('id', 'headContent')
    }/*, function() {
            //$('#span').css('left',0)
            $('#span').css('width', 0)
        }*/)
    $('.header-floor2').mouseleave(function () {
        $('#span').css('width', 0)
        $('.headContent').removeAttr('id')
    })
    /*顶部导航下滑线-完*/

	//移动端导航条效果-公用
	$('#headSHBtn').find('img').click(function(){
		// $('#headSHBtn').find('img').addClass('active')
        // $(this).removeClass('active')
        $('#headSHBtn').find('img').stop().fadeIn(500)
        //$(this).fadeOut(500)
        $(this).css('display','none')
		$(".app-nav").toggleClass("app-nav-active");
		$('.appMask').toggleClass("appMask-active");
	})
	$(".appMask").click(function(){
		// $('#headSHBtn').find('img').eq(1).removeClass('active')
        // $('#headSHBtn').find('img').eq(0).addClass('active')
        $('#headSHBtn').find('img').stop().fadeIn(500)
		$(".app-nav").removeClass("app-nav-active");
		$('.appMask').removeClass("appMask-active");
	})    
})