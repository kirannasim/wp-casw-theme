jQuery(function($) {
	   
	   
	   
	$('iframe').attr('data-scale', 'true');
	
	display.init('phone 500 tablet 700 normal 1000 large');

    // Links

    external.init('a[rel="external"]', 'pdf, doc, docx, jpg', true);


    // Forms

    form.stylize();
    form.init();



    var navIsOpen = false;
    var navTrigger = $('#header #nav #nav-menu');
    var isMobile = navTrigger.is(':visible');

    navTrigger.click(function() {
        if(navIsOpen) {
            closeNav();
        }
        else {
            openNav();
        }
    });
    
    if(document.location.href.indexOf('/news/announcements/') > 0) {
	    if(!$('#nav ul:first>li.current-menu-parent').length) {
		    $('#nav .current-post-ancestor').removeClass('current-post-ancestor');
	    	$('#menu-item-174').addClass('current-menu-item').parent().parent().addClass('current-post-ancestor');
	    }
	}

    if(document.location.href.indexOf('/people-categories/') > 0 || document.location.href.indexOf('/people/') > 0) {
	    if(!$('#nav ul:first>li.current-menu-parent').length) {
		    $('#nav .current-post-ancestor').removeClass('current-post-ancestor');
	    	$('#menu-item-412').addClass('current-menu-item').parent().parent().addClass('current-post-ancestor');
	    }
	}
	
		
	$('.accordion-content').hide();
	$('.accordion-title').click(function() {
		$(this).next().slideToggle('fast');
		$(this).toggleClass('open');
	});
    
    

    function openNav() {
        if(!navIsOpen) {
            $('#header #nav ul:first').slideDown();
            $('body').on('mousedown.nav', function() {
                closeNav();
            });
            $('#nav').on('mousedown.nav', function(e) {
                if(navIsOpen) {
                    e.stopPropagation();
                }
            });
        }
        navIsOpen = true;
    }

    function closeNav() {
        if(navIsOpen) {
            $('#header #nav ul:first').slideUp();
            $('body').off('mousedown.nav');
        }
        navIsOpen = false;
    }	
	
	$(window).resize(function() {
        if(navTrigger.is(':visible')) {
            isMobile = true;
            $('#header #nav ul:first').hide();
        }
        else {
            isMobile = false;
            $('#header #nav ul:first').show();
        }
        navIsOpen = false;
    });	
	

	// Home features

	var homeSlider = null;
	
	if($('#home-features ul li').length > 1) {

        homeSlider = slider.init('#home-features .slider',{ratio: .5, delay: 7}).start();
        
       $('#home-features .label').click(function() {
	    	document.location = $(this).parent().find('.image').attr('href'); 
	    	return false;
	    });
	    /* 
	    $('#home-features .category a').click(function(e) {
	    	e.stopPropagation();
	    });
	    */
	    
	    display.change('phone tablet', function() { homeSlider.modify({ratio: 1.6}) });
        display.change('normal large', function() { homeSlider.modify({ratio: .5}) });
        display.update();
        
    }

	// Share Menu
	
	var shareMenuOpen = false;
	$('#share-button').click(function() {
		var parent = $(this).parent();
		var url = document.location.href;
		var title = document.title;
		if(!shareMenuOpen) {
			var shareMenuHtml = '<div class="menu">'
			+ '<a href="mailto:?subject=' + title + '&amp;body=' + url + '" class="share-menu-email"></a>'
			+ '<a href="https://twitter.com/intent/tweet?text=' + title + '&amp;url=' + url + '" target="_blank" class="share-menu-twitter"></a>'
			+ '<a href="http://www.facebook.com/share.php?u=' + url + '" target="_blank" class="share-menu-facebook"></a>'
			+ '<a href="https://www.linkedin.com/shareArticle?url=' + url + '" class="share-menu-linkedin"></a>'
			+ '</div>';
			parent.find('.menu').remove();
			$(this).after(shareMenuHtml);
			parent.find('.menu').css({opacity:0}).animate({opacity:1}, 200);
			$('body').on('click.share', function() {
				$('#share-button').trigger('click');
			});
			shareMenuOpen = true;
		}
		else {
			$('body').off('click.share');
			parent.find('.menu').fadeOut(200, function() {
				$(this).remove();
			});
			shareMenuOpen = false;
		}
		return false;	
	});
	
	$('.search-field').focus();
	
	
	$('.agendas-wrap .tabs a').on('click', function(e) {
		e.preventDefault();

		var $this = $(this),
			link = $this.attr('href');
		
		$('.agendas-wrap .tabs a').removeClass('active');
		$this.addClass('active');		

		$('.agendas-wrap .tab-pane').removeClass('active');
		$('.agendas-wrap ' + link).addClass('active');

		return false;
	});
});