/*
|--------------------------------------------------------------------------
| JS for theme settings
|--------------------------------------------------------------------------
|
| Author : Juman
| Version : 1.0.0
|
*/

jQuery(function($){

	var img_fileinput_setting = {
		'showUpload':false,
		'showPreview':true,
		'browseLabel': 'Upload',
		'removeLabel': 'remove',
		'previewSettings': {
	    	image: {width: "auto", height: "auto", 'max-width': "100%", 'max-height': "100%"}
	    } 
	};
	
	$("#smallLogo").fileinput(img_fileinput_setting);
	$("#mainLogo").fileinput(img_fileinput_setting);
	$("#preLoader").fileinput(img_fileinput_setting);
	$("#fabicon").fileinput(img_fileinput_setting);

	$( "#siteBasicForm" ).validate({
		rules: {
			site_title:  {
				required: true,
				minlength: 2
			},
			site_date_format:  {
				required: true,
			},
			site_currency: {
				required: true,     
			},
			site_language: {
				required: true,
			},
			site_android_url: {
				url: true,
			},
			site_ios_url: {
				url: true,
			},
			site_copyright: {
				required: true,
				minlength: 2,
				maxlength: 500
			},
		},
		messages: {
			site_title:{
				required: "Title field Required!",
				minlength: "Minimum 2 Charracters!"
			},    
			site_date_format: {
				required:"Please fill-up this field!",
			},
			site_currency: {
				required:"Please fill-up this field!",
			},
			site_language: {
				required:"Please fill-up this field!",
			},
			site_android_url: {
				url: "Please enter url ex. https://www.domain.com",
			},
			site_ios_url: {
				url: "Please enter url ex. https://www.domain.com",
			},
			site_copyright: {
				required:"Please fill-up this field!",
				minlength: "Minimum 2 Charracters!",
				maxlength: "Minimum 500 Charracters!"
			} 
		}

	});

	$( "#socialForm" ).validate({
		rules: {
			site_facebook_link: {
				url: true,
			},	
			site_twitter_link: {
				url: true,
			},	
			site_instagram_link: {
				url: true,
			},	
			site_linkedin_link: {
				url: true,
			},	
			site_google_plus_link: {
				url: true,
			},	
			site_pinterest_link: {
				url: true,
			},	
			site_youtube_link: {
				url: true,
			},		
		},
		messages: {
			site_facebook_link: {
				url: "Please enter url ex. https://www.domain.com",
			},
			site_twitter_link: {
				url: "Please enter url ex. https://www.domain.com",
			},
			site_instagram_link: {
				url: "Please enter url ex. https://www.domain.com",
			},
			site_linkedin_link: {
				url: "Please enter url ex. https://www.domain.com",
			},
			site_google_plus_link: {
				url: "Please enter url ex. https://www.domain.com",
			},
			site_pinterest_link: {
				url: "Please enter url ex. https://www.domain.com",
			},
			site_youtube_link: {
				url: "Please enter url ex. https://www.domain.com",
			},
		}

	});


});