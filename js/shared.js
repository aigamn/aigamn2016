var shared = {};

	shared.init = function(){
		// prevent closing of a dropdown on form click
		$('.dropdown-menu').find(':not(a)').click(function (e) {
		    e.stopPropagation();
		});
	}

$('document').ready(shared.init);