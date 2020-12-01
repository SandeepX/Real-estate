
$('a[data-rel^=lightcase]').lightcase();


// pre loader js code starts 

	$(window).on('load', function() {
		$('#preloader').fadeOut('slow', function() {
		    $(this).remove();
		    $('body').css('overflow', 'visible');
		});
	});


 


// pre loader js code ends 

 

// $(document).click(function(){

// 	$('.info_content').hide();
// })
$('#mapCanvas').on('click', function(){
  });

//  range slider

	$(".range_28").ionRangeSlider({
		type: "double",
		min: 0, max: 70000000, from: 0,
		to: 70000000, from_min: 0, from_max: 70000000, to_min: 0, to_max: 70000000,
        onFinish: function (data) {
            // Called then action is done and mouse is released

            let min=data.from;
            let max=data.to;

           /* console.log(data.to);
            console.log(data.from);*/
            $('#property_min_price').val(555);
            $('#property_max_price').val(888);

        },
	});
$(".area_range").ionRangeSlider({
    type: "double",
    min: 0, max: 1000000, from: 0,
    to: 1000000, from_min: 0, from_max: 1000000, to_min: 0, to_max: 1000000,
    onFinish: function (data) {
        // Called then action is done and mouse is released

        let min=data.from;
        let max=data.to;

        $('#min_area').val(min);
        $('#max_area').val(max);

    },
});

//  for home page slider section

var owl = $('.owl-bannerSlider');
	owl.owlCarousel({
		items: 1,
		loop: true,
		margin: 15,
		nav: false,
		dots: false,
		smartSpeed: 2000,
		autoplay: true,
		autoplayTimeout: 8000,
		autoplayHoverPause: true  
	});  





 
// for featured properties slider

var owl = $('.owl-featured');
	owl.owlCarousel({
		items: 3,
		loop: true,
		margin: 15,
		nav: true,
		dots: false,
		smartSpeed: 2000,
		autoplay: false,
		autoplayTimeout: 8000,
		autoplayHoverPause: true, 
		responsiveClass: true,
		responsive:
		{
			0:{
				items:1,
				nav: false   
			},
			480:{
				items:1,
				nav: false 
			},
			768:{
				items:2, 
				nav: true 

			},
			992:{
				items:3, 
				nav: true 

			},
			1200:{
				items:3,
				nav: true 

			},
			2000:{
				items:4,
				nav: true 

			}  
		}
	});  


// for related properties slider

var owl = $('.owl-related');
	owl.owlCarousel({
		items: 4,
		loop: true,
		margin: 15,
		nav: false,
		dots: false,
		smartSpeed: 2000,
		autoplay: true, 
		autoplayTimeout: 5000,
		autoplayHoverPause: false, 
		responsiveClass: true,
		responsive:
		{
			0:{
				items:1,
				nav: false   
			},
			480:{
				items:1,
				nav: false 
			},
			768:{
				items:2   
			},
			992:{
				items:3   
			},
			1200:{
				items:4  
			},
			2000:{
				items:4 
			}  
		}
	});  
  


// for verified properties slider	

var owl = $('.owl-verified');
	owl.owlCarousel({
		items:4,
		loop:true,
		margin:15,
		nav: true,
		dots: false,
		smartSpeed: 2000,
		autoplay:true, 
		autoplayTimeout:8000,
		autoplayHoverPause:true, 
		responsiveClass:true,
		responsive:
		{
			0:{
				items:1,
				nav: false  
			},
			480:{
				items:1,
				nav: false 
			},
			768:{
				items:2  
			},
			992:{
				items:3  
			},
			1200:{
				items:3 
			},
			2000:{
				items:3 
			}  
		}
	}); 

// for Trending properties slider

var owl = $('.owl-trending');
	owl.owlCarousel({
		items:4,
		loop:true,
		margin:15,
		nav: true,
		smartSpeed: 2000,
		dots: false,
		autoplay:true, 
		autoplayTimeout:8000,
		autoplayHoverPause:true, 
		responsiveClass:true,
		responsive:
		{
			0:{
				items:1,
				nav: false   
			},
			480:{
				items:1,
				nav: false 
			},
			768:{
				items:2   
			},
			992:{
				items:3   
			},
			1200:{
				items:3 
			},
			2000:{
				items:3  
			}  
		}
	}); 


// for new properties slider js

var owl = $('.owl-trend');
	owl.owlCarousel({
		items:3,
		loop:true,
		margin:15,
		nav: true,
		dots: false,
		smartSpeed: 2000,
		autoplay:true, 
		autoplayTimeout:8000,
		autoplayHoverPause:true, 
		responsiveClass:true,
		responsive:
		{
			0:{
				items:1,
				nav: false 
			},
			480:{
				items:1,
				nav: false
			},
			768:{
				items:2 
			},
			992:{
				items:3 
			},
			1200:{
				items:3 
			},
			2000:{
				items:3 
			}  
		}
	});
 

// owl blog slider js 

var owl = $('.owl-blog');
	owl.owlCarousel({
		items:2,
		loop:true,
		margin:15,
		nav: true,
		dots: false,
		smartSpeed: 2000,
		autoplay:true, 
		autoplayTimeout:8000,
		autoplayHoverPause:true, 
		responsiveClass:true,
		responsive:
		{
			0:{
				items:1,
				nav: false  
			},
			480:{
				items:1,
				nav: false 
			},
			768:{
				items:1  
			},
			992:{
				items:2  
			}, 
			2000:{
				items:2 
			}  
		}
	});  



// range slider js code

$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 10000000,
      values: [ 0, 10000000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ] );
          $( "#min_price" ).val( ui.values[ 0 ]);
          $( "#max_price" ).val( ui.values[ 1 ] );
      }
    });
    let min_price =  $( "#slider-range" ).slider( "values", 0 );
    let max_price =  $( "#slider-range" ).slider( "values", 1 );

    $( "#amount" ).val( "Rs." + $( "#slider-range" ).slider( "values", 0 ) +
      " - Rs." + $( "#slider-range" ).slider( "values", 1 ) );

    $( "#min_price" ).val(min_price);
    $( "#max_price" ).val( max_price);
  } );

// range slider js code for list property price

    $(".range-slider-ui").each(function () {
        var minRangeValue = $(this).attr('data-min');
        var maxRangeValue = $(this).attr('data-max');
        var minName = $(this).attr('data-min-name');
        var maxName = $(this).attr('data-max-name');
        var unit = $(this).attr('data-unit');

        $(this).append("" +
            "<span class='min-value'></span> " +
            "<span class='max-value'></span>" +
            "<input id='"+minName+"' class='current-min' type='hidden' name='"+minName+"'>" +
            "<input id='"+maxName+"' class='current-max' type='hidden' name='"+maxName+"'>"
        );
        $(this).slider({
            range: true,
            min: minRangeValue,
            max: maxRangeValue,
            values: [minRangeValue, maxRangeValue],
            slide: function (event, ui) {
                event = event;
                var currentMin = parseInt(ui.values[0]);
                var currentMax = parseFloat(ui.values[1]);
                $(this).children(".min-value").text(unit + " " + currentMin);
                $(this).children(".max-value").text(unit  + " " + currentMax);
                $(this).children(".current-min").val(currentMin);
                $(this).children(".current-max").val(currentMax);
            }
        });

        var currentMin = parseInt($(this).slider("values", 0));
        var currentMax = parseFloat($(this).slider("values", 1));
        $(this).children(".min-value").text(unit + " " + currentMin);
        $(this).children(".max-value").text(unit + " " + currentMax);
        $(this).children(".current-min").val(currentMin);
        $(this).children(".current-max").val(currentMax);
    });



// testimonial carousel slider js code

        var owl = $(".testimonial-carousel");
        owl.owlCarousel({
            loop: true,
            margin: 40,
            responsiveClass: true,
            navigation: false,
            nav: false,
            items: 1,
            smartSpeed: 2000,
            dots: true,
            autoHeight:true,
            autoplay: false,
            autoplayTimeout: 9000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 1
                },
                992: {
                    items: 1
                }
            }
        });  



// partner carousel slider js code 

	var owl = $(".partners-carousel");
        owl.owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            navigation: true,
            nav: true,
            items: 5,
            smartSpeed: 2000,
            dots: false,
            autoplay: false,
            autoplayTimeout: 9000,
            center: false,
            responsive: {
                0: {
                    items: 2,
                    nav: false
                },
                480: {
                    items: 2,
                    nav: false
                },
                760: {
                    items: 3
                },
                992: {
                    items: 5
                }
            }
        });  




var owl = $('.owl-search');
	owl.owlCarousel({
		items:2,
		loop:true,
		margin:15,
		nav: true,
		smartSpeed: 2000,
		dots: false,
		autoplay:true, 
		autoplayTimeout:30000,
		autoplayHoverPause:true, 
		responsiveClass:true,
		responsive:
		{
			0:{
				items:1,
				nav: false   
			},
			480:{
				items:1,
				nav: false 
			},
			768:{
				items:2   
			},
			992:{
				items:2   
			},
			1200:{
				items:2 
			},
			2000:{
				items:3  
			}  
		}
	}); 













 //  scroll animation js code

 // var $window = $(window),
 //  win_height_padded = $window.height() * 1.1,
 //  isTouch = Modernizr.touch;

 //  if (isTouch) {$('.revealOnScroll').addClass('animated');}

 //  $window.on('scroll', revealOnScroll);

 //  function revealOnScroll() {
 //    var scrolled = $window.scrollTop(),
 //    win_height_padded = $window.height() * 1.1;

 
 //    $(".revealOnScroll:not(.animated)").each(function () {
 //      var $this = $(this),
 //      offsetTop = $this.offset().top;

 //      if (scrolled + win_height_padded > offsetTop) {
 //        if ($this.data('timeout')) {
 //          window.setTimeout(function () {
 //            $this.addClass('animated ' + $this.data('animation'));
 //          }, parseInt($this.data('timeout'), 10));
 //        } else {
 //          $this.addClass('animated ' + $this.data('animation'));
 //        }
 //      }
 //    });
 
 //    $(".revealOnScroll.animated").each(function (index) {
 //      var $this = $(this),
 //      offsetTop = $this.offset().top;
 //      if (scrolled + win_height_padded < offsetTop) {
 //        $(this).removeClass('animated fadeInUp flipInX lightSpeedIn');
 //      }
 //    });
 //  }

 //  revealOnScroll();

