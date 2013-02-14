$(document).ready(function () {
	Cufon.replace('.logo .title');	
			
	InitGraphs ();
		
	InitMenuEffects ();
	
	InitNotifications ();
	
	InitContentBoxes ();
	
	InitTables ();	
	
	InitFancybox ();
	
	InitWYSIWYG ();
        
        InitQuickEdit ();
});


//--auto refresh
/*var auto_refresh = setInterval(
function()
{
$('#data').fadeOut(0).load('dataTopSiswa.php').fadeIn(0);
}, 1000 );
*/
/* *********************************************************************
 * Main Menu
 * *********************************************************************/
						var clockID = 0;

						function UpdateClock() {
							if(clockID) {
								clearTimeout(clockID);
								clockID  = 0;
							}

							var tDate = new Date();

									document.theClock.theTime.value = "" 
											+ tDate.getHours() + ":" 
											+ tDate.getMinutes() + ":" 
											+ tDate.getSeconds();

								clockID = setTimeout("UpdateClock()", 1000);
						}
						function StartClock() {
							clockID = setTimeout("UpdateClock()", 500);
						}

						function KillClock() {
							if(clockID) {
								clearTimeout(clockID);
									clockID  = 0;
							}
						}
						
	

					
function timedRefresh(waktu){
	setTimeout("location.reload(true);",waktu);
};
				
function menuSlide() {
	if($(".menuPanel").is(':visible')){
		$(".menuPanel").hide();
		
	}else{
		$(".menuPanel").show();
		
	}
	
	if($('#logoDalem').is(':visible')){
			$('#logoDalem').hide();
			document.getElementById("maincontent").style.width="76%"
			document.getElementById("maincontent").style.right="0px"
			//document.getElementById("papan").style.width="400"
	}
	else{
			
		$('#logoDalem').show();
		if($('#logoDalem').is(':visible')){
			document.getElementById("maincontent").style.width="93%"
			document.getElementById("maincontent").style.right="10px"
			//document.getElementById("papan").style.width="600"
		}
			
			
			
	}
	  
}
	
	 

	
	$(document).ready(function(){
		$('#ab').hide();
		//$('#p_1').hide();
	//	$('.menu').hide();
		//$('.abcdef').slideLeft();
		$('#p_2').hide();
		$('#p_2_2').hide();
		$('#p_2_3').hide();
		$('#p_2_4').hide();
		$('#p_2_5').hide();
		$('#p_2_6').hide();
		$('#p_2_7').hide();
		$('#p_2_8').hide();
		$('#p_2_9').hide();
		$('#p_2_10').hide();
		$('#logoDalem').hide();
		$('#in_out').hide();
		
		
		$('#p_4').hide();
	})
	function ar(){
	$('#ab').slideToggle(250);
	}
	
	function p1(){
	$('#p_1').slideToggle(250);
	$('#p_1_2').slideToggle(250);
	$('#p_1_3').slideToggle(250);
	$('#p_1_4').slideToggle(250);
	}
	function p2(){
	$('#p_2').slideToggle(250);
	$('#p_2_2').slideToggle(250);
	$('#p_2_3').slideToggle(250);
	$('#p_2_4').slideToggle(250);
	$('#p_2_5').slideToggle(250);
	$('#p_2_6').slideToggle(250);
	$('#p_2_7').slideToggle(250);
	$('#p_2_8').slideToggle(250);
	$('#p_2_9').slideToggle(250);
	$('#p_2_10').slideToggle(250);
	}
	function p3(){
	
	$('#in_out').slideToggle(250);
	}
	function p4(){
	$('#p_4').slideToggle(250);
	}
	
 function InitMenuEffects () {
	/* Sliding submenus */
	$('.sidebar .menu ul ul').hide();
	$('.sidebar .menu ul li.active ul').show();
	
	$('.bapak_siswa').click(function(){
		$('#anak_siswa').slideToggle(250);
		$('#telat_anak_siswa').slideUp(250);
	});
	$('.telat_bapak_siswa').click(function(){
		$('#telat_anak_siswa').slideToggle(250);
		$('#anak_siswa').slideUp(250);
	});
	
	$('.bapak').click(function(){
		$('#anak').slideToggle(250);
	});
	
	
	$('#master').click(function () {
		if($('#emak1').is(':visible')){
			$('#emak1').slideUp(250);
			$('#anak').slideUp(250);
			$('#anak_siswa').slideUp(250);
			$('#telat_anak_siswa').slideUp(250);
			
		}
		else{
			$('#emak1').slideDown(250);
			$('#emak2').slideUp(250);
			$('#emak3').slideUp(250);
			$('#emak4').slideUp(250);
			$('#emak5').slideUp(250);
			$('#emak6').slideUp(250);
			$('#telat_anak_siswa').slideUp(250);
			
		}
	});
	$('#absensi').click(function () {
		if($('#emak2').is(':visible')){
			$('#emak2').slideUp(250);
		}
		else{
			$('#emak2').slideDown(250);
			$('#emak1').slideUp(250);
			$('#emak3').slideUp(250);
			$('#anak').slideUp(250);
			$('#anak_siswa').slideUp(250);
			$('#telat_anak_siswa').slideUp(250);
			$('#emak4').slideUp(250);
			$('#emak5').slideUp(250);
			$('#emak6').slideUp(250);
		}
	});
	$('#laporan').click(function () {
		if($('#emak3').is(':visible')){
			$('#emak3').slideUp(250);
			$('#anak_siswa').slideUp(250);
			$('#telat_anak_siswa').slideUp(250);
		}
		else{
			$('#emak3').slideDown(250);
			$('#emak1').slideUp(250);
			$('#emak2').slideUp(250);
			$('#anak').slideUp(250);
			$('#anak_siswa').slideUp(250);
			$('#telat_anak_siswa').slideUp(250);
			$('#emak4').slideUp(250);
			$('#emak5').slideUp(250);
			$('#emak6').slideUp(250);
		}
	});
	$('#laporan_karyawan').click(function () {
		if($('#emak4').is(':visible')){
			$('#emak4').slideUp(250);
		}
		else{
			$('#emak4').slideDown(250);
			$('#emak1').slideUp(250);
			$('#emak2').slideUp(250);
			$('#anak').slideUp(250);
			$('#anak_siswa').slideUp(250);
			$('#telat_anak_siswa').slideUp(250);
			$('#emak3').slideUp(250);
			$('#emak5').slideUp(250);
			$('#emak6').slideUp(250);
		}
	});
	$('#laporan_guru').click(function () {
		if($('#emak5').is(':visible')){
			$('#emak5').slideUp(250);
		}
		else{
			$('#emak5').slideDown(250);
			$('#emak4').slideUp(250);
			$('#emak1').slideUp(250);
			$('#emak2').slideUp(250);
			$('#anak').slideUp(250);
			$('#anak_siswa').slideUp(250);
			$('#telat_anak_siswa').slideUp(250);
			$('#emak3').slideUp(250);
			$('#emak6').slideUp(250);
			
		}
	});
	$('#dashboard').click(function () {
		if($('#emak6').is(':visible')){
			$('#emak6').slideUp(250);
		}
		else{
			$('#emak6').slideDown(250);
			$('#emak4').slideUp(250);
			$('#emak1').slideUp(250);
			$('#emak2').slideUp(250);
			$('#anak').slideUp(250);
			$('#anak_siswa').slideUp(250);
			$('#telat_anak_siswa').slideUp(250);
			$('#emak3').slideUp(250);
			$('#emak5').slideUp(250);
			
		}
	});
	/*$('.sidebar .menu ul li').click(function () {
		sm = $(this).find('#anak');
		submenu = $(this).find('#emak');
		if (submenu.is(':visible')){
			submenu.slideUp(150);
			sm.slideUp(150);
			}
		else{
		submenu.slideDown(200);	
		
		}	
		return false;
	
	});*/
	
	
	/* Hover effect on links */
	$('.sidebar .menu li a').hover(
		function () { $(this).stop().animate({'paddingLeft': '18px'}, 200); },
		function () { $(this).stop().animate({'paddingLeft': '12px'}, 200); }
	);
		$('.sidebar .menu li ul li a').click(function(){
		
	top.location.href=($(this).attr('href'));
	
	});




	$('li#dashboard a').click(function(){
	top.location.href=($(this).attr('href'));
	});
}


/* *********************************************************************
 * Content Boxes
 * *********************************************************************/
function InitContentBoxes () {
	/* Checkboxes */
	$('.content-box .select-all').click(function () {
		if ($(this).is(':checked'))
			$(this).parent().parent().parent().parent().find(':checkbox').attr('checked', true);
		else
			$(this).parent().parent().parent().parent().find(':checkbox').attr('checked', false); 
	});
	
	/* Tabs */
	$('.content-box .tabs').idTabs();
}

/* *********************************************************************
 * Notifications
 * *********************************************************************/
function InitNotifications () {
	$('.notification .close').click(function () {
		$(this).parent().fadeOut(1000, function() {
			$(this).find('p').fixClearType ();
		});		
		return false;
	});
}

/* *********************************************************************
 * Data Tables
 * *********************************************************************/
function InitTables () {
	$('.datatable').dataTable({
		'bLengthChange': true,
		'bPaginate': true,
		'sPaginationType': 'full_numbers',
		'iDisplayLength': 5,
		'bInfo': false,
		'oLanguage': 
		{
			'sSearch': 'Search all columns:',
			'oPaginate': 
			{
				'sNext': '&gt;',
				'sLast': '&gt;&gt;',
				'sFirst': '&lt;&lt;',
				'sPrevious': '&lt;'
			}
		},		
		'aoColumns': [ 
			{ "bSortable": false },
			null,
			null,
			null,
			null,
			null,
			null
		]	
	});
}

/* *********************************************************************
 * Graphs
 * *********************************************************************/
function InitGraphs () {
	$('.visualize1').visualize({
			'type': 'pie',
			'width': '250px',
			'height': '250px'
	});

	$('.visualize2').visualize({
			'type': 'bar',
			'width': '250px',
			'height': '250px'
	});

	$('.visualize3').visualize({
			'type': 'line',
			'width': '250px',
			'height': '250px'
	});
	
	$('.visualize4').visualize({
			'type': 'area',
			'width': '250px',
			'height': '250px'
	});
}

/* *********************************************************************
 * Fancybox
 * *********************************************************************/
function InitFancybox () {
	$('.modal-link').fancybox({
		'modal' 				: false,
		'hideOnOverlayClick' 	: 'true',
		'hideOnContentClick' 	: 'true',
		'enableEscapeButton' 	: true,
		'showCloseButton' 		: true		
	});
	
	$("a[href$='gif']").fancybox();
	$("a[href$='jpg']").fancybox();
	$("a[href$='png']").fancybox(); 	
}

/* *********************************************************************
 * WYSIWYG
 * *********************************************************************/
function InitWYSIWYG () {
	$('.jwysiwyg').wysiwyg({
		controls: {
			strikeThrough : { visible : true },
			underline     : { visible : true },

			separator00 : { visible : true },

			justifyLeft   : { visible : true },
			justifyCenter : { visible : true },
			justifyRight  : { visible : true },
			justifyFull   : { visible : true },

			separator01 : { visible : true },

			indent  : { visible : true },
			outdent : { visible : true },

			separator02 : { visible : true },

			subscript   : { visible : true },
			superscript : { visible : true },

			separator03 : { visible : true },

			undo : { visible : true },
			redo : { visible : true },

			separator04 : { visible : true },

			insertOrderedList    : { visible : true },
			insertUnorderedList  : { visible : true },
			insertHorizontalRule : { visible : true },

			separator07 : { visible : true },

			cut   : { visible : true },
			copy  : { visible : true },
			paste : { visible : true }
		}
	});
	
	$('textarea.tinymce').tinymce({
		// Location of TinyMCE script
		script_url : 'js/tiny_mce/tiny_mce.js',
		// General options
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		// theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough",
		//theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		//theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
}

/* *********************************************************************
 * Quick Edit
 * *********************************************************************/
function InitQuickEdit () {
	$.editable.addInputType('datepicker', {
                element : function(settings, original) {
                    var input = $('<input>');
                    if (settings.width  != 'none') { input.width(settings.width);  }
                    if (settings.height != 'none') { input.height(settings.height); }
                    input.attr('autocomplete','off');
                    $(this).append(input);
                    return(input);
                },
                plugin : function(settings, original) {
                    var form = this;
                    settings.onblur = 'ignore';
                    $(this).find('input').datepicker({
                        firstDay: 1,
                        dateFormat: 'dd/mm/yy',
                        closeText: 'X',
                        onSelect: function(dateText) { 
                                $(this).hide(); 
                                $(form).trigger('submit'); 
                        },
                        onClose: function(dateText) {
                                original.reset.apply(form, [settings, original]);
                                $(original).addClass(settings.cssdecoration);
                                $(this).hide(); 
                                $(form).trigger('submit'); 
                        }
                    });
                }
        });

		
		
        $('.quick_edit').click(function () {
                $(this).parent().parent().find('td.edit-field').click();
                return false;
        });
        
        $('.edit-textfield').editable('http://www.google.com', {
                'type': 'text'
        });

        $('.edit-date').editable('date.php', {
             'type' : 'datepicker'
        });
       
        $('.edit-textarea').editable('http://www.google.com', {
                'type': 'textarea'
        });
        
        $('.edit-select').editable('http://www.google.com', {
                'data': "{'true': 'Active', 'false': 'Inactive'}",
                'type': 'select'
        });        
}

jQuery.fn.fixClearType = function(){
    return this.each(function(){
        if( !!(typeof this.style.filter  && this.style.removeAttribute))
            this.style.removeAttribute("filter");
    })

} 
