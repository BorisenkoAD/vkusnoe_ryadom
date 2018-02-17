$(function() {
	$('.popup-with-form').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#name',

		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		}
	});

	$(".preloader").fadeOut();
/*
	//E-mail Ajax Send
	$("#insertTovar").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "insertTovar.php", //Change
			data: th.serialize()
		}).done(function() {
			window.alert("Товар добавлен");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});
*/
});
