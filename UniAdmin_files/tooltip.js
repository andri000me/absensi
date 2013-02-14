$(function() {

	$('abbr').css('cursor', 'pointer').hover(function() {

		// Saya menukar nilai di dalam atribut title untuk dimasukkan ke dalam atribut data-title
		// dan menyingkirkan atribut title dari <abbr>
		// sehingga nilai tooltip asli dari browser tidak akan tampil saat Anda menyentuh elemen <abbr>
		$(this).attr('data-title', $(this).attr('title')).removeAttr('title');

	}, function() {

		// Namun saat pointer menjauhi elemen ini, Saya harus mengembalikan nilai awal dari atribut title dan menghilangkan atribut data-title
		// Ini adalah proses bergantian untuk memastikan agar tampilan <abbr> tidak terganggu dengan
		// munculnya tooltip panjang yang berasal dari atribut title saat didekati pointer mouse.
		$(this).attr('title', $(this).attr('data-title')).removeAttr('data-title');

	// Saat elemen <abbr> diklik...
	}).click(function(e) {

		// Hilangkan semua elemen #tooltip-click yang ada
		$('#tooltip-click').remove(); 
		
		// Kemudian sisipkan elemen #tooltip-click baru pada elemen ini (elemen <abbr> yang diklik)
		$('abbr.underlined').removeClass('underlined');
		$(this).addClass('underlined').append('<div id="tooltip-click"></div>');

		
		// Pastikan tooltip selalu muncul pada area yang terlihat!
		
		var ttWidth   = $("#tooltip-click").outerWidth(),  // Mengambil data lebar tooltip
		    ttHeight  = $("#tooltip-click").outerHeight(), // Mengambil data tinggi tooltip

			// Mengambil data lebar layar dan tinggi dokumen
		    winWidth  = $(window).width(),
		    docHeight = $(document).height(),

		    top       = -2, // Set nilai top sebesar koordinat pointer dari batas atas jendela + 15
		    left      = 260;      // Set nilai left sebesar koordinat pointer dari batas kiri layar browser

		// Jika top + tinggi tooltip lebih besar dari tinggi dokumen...
		if(top + ttHeight > docHeight) {
			// Set nilai top sebesar top - tinggi tooltip - 15
			top = top - ttHeight - 15;
		} else {
			// Jika tidak, set nilai top sebagai top yang nilainya telah dinyatakan sebelum ini
			top = top;
		}

		// Jika left + lebar tooltip lebih besar dari lebar layar...
		if(left + ttWidth > winWidth) {
		// Set nilai left sebesar left - lebar tooltip - 15
			left = left - ttWidth - 15;
		} else {
		// Jika tidak, set nilai left sebagai left yang nilainya telah dinyatakan sebelum ini
			left = left;
		}

		// Isi elemen #tooltip-click dengan deskripsi yang ada di dalam atribut data-title
		// kemudian tampilkan tooltip dengan efek .show()
		$('#tooltip-click').html($(this).attr('data-title')).css({top:top,left:left}).show(200);

		// Jangan biarkan event .click() pada fungsi ini meluap keluar dari DOM tree
		// Event ini khusus untuk mempengaruhi elemen ini saja
		// Selengkapnya: http://api.jquery.com/event.stopPropagation/
		e.stopPropagation();
	});

	// Jika seluruh dokumen (katakanlah: sesuatu selain <abbr>) diklik...
	$(document).click(function() {
		// Hilangkan elemen #tooltip-click
		$('#tooltip-click').remove();
		$('abbr.underlined').removeClass('underlined');
	});
	
});

//========================================================================================

$(function() {

	$('.gatau').css('cursor', 'pointer').hover(function() {

		// Saya menukar nilai di dalam atribut title untuk dimasukkan ke dalam atribut data-title
		// dan menyingkirkan atribut title dari <abbr>
		// sehingga nilai tooltip asli dari browser tidak akan tampil saat Anda menyentuh elemen <abbr>
		$(this).attr('data-title', $(this).attr('title')).removeAttr('title');

	}, function() {

		// Namun saat pointer menjauhi elemen ini, Saya harus mengembalikan nilai awal dari atribut title dan menghilangkan atribut data-title
		// Ini adalah proses bergantian untuk memastikan agar tampilan <abbr> tidak terganggu dengan
		// munculnya tooltip panjang yang berasal dari atribut title saat didekati pointer mouse.
		$(this).attr('title', $(this).attr('data-title')).removeAttr('data-title');

	// Saat elemen <abbr> diklik...
	}).click(function(e) {

		// Hilangkan semua elemen #tooltip-click yang ada
		$('#tooltip-click').remove(); 
		
		// Kemudian sisipkan elemen #tooltip-click baru pada elemen ini (elemen <abbr> yang diklik)
		$('.gatau.underlined').removeClass('underlined');
		$(this).addClass('underlined').append('<div id="tooltip-click"></div>');

		
		// Pastikan tooltip selalu muncul pada area yang terlihat!
		
		var ttWidth   = $("#tooltip-click").outerWidth(),  // Mengambil data lebar tooltip
		    ttHeight  = $("#tooltip-click").outerHeight(), // Mengambil data tinggi tooltip

			// Mengambil data lebar layar dan tinggi dokumen
		    winWidth  = $(window).width(),
		    docHeight = $(document).height(),

		    top       = 1 // Set nilai top sebesar koordinat pointer dari batas atas jendela + 15
		    left      = -100;      // Set nilai left sebesar koordinat pointer dari batas kiri layar browser

		// Jika top + tinggi tooltip lebih besar dari tinggi dokumen...
		if(top + ttHeight > docHeight) {
			// Set nilai top sebesar top - tinggi tooltip - 15
			top = top - ttHeight - 150000;
		} else {
			// Jika tidak, set nilai top sebagai top yang nilainya telah dinyatakan sebelum ini
			top = top;
		}

		// Jika left + lebar tooltip lebih besar dari lebar layar...
		if(left + ttWidth > winWidth) {
		// Set nilai left sebesar left - lebar tooltip - 15
			left = left - ttWidth - 15;
		} else {
		// Jika tidak, set nilai left sebagai left yang nilainya telah dinyatakan sebelum ini
			left = left;
		}

		// Isi elemen #tooltip-click dengan deskripsi yang ada di dalam atribut data-title
		// kemudian tampilkan tooltip dengan efek .show()
		$('#tooltip-click').html($(this).attr('data-title')).css({top:top,left:left,}).show(200);

		// Jangan biarkan event .click() pada fungsi ini meluap keluar dari DOM tree
		// Event ini khusus untuk mempengaruhi elemen ini saja
		// Selengkapnya: http://api.jquery.com/event.stopPropagation/
		e.stopPropagation();
	});

	// Jika seluruh dokumen (katakanlah: sesuatu selain <abbr>) diklik...
	
	
});
