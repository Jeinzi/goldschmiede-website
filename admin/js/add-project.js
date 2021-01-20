$('.datepicker').datepicker({
	format: "yyyy-mm-dd"
});

function handleFileSelect(evt) {
	var file = evt.target.files[0];
	var reader = new FileReader();
	reader.onload = (function(theFile) {
		return function(e) {
			$("#banner").attr('src', e.target.result);
		};
	})(file);
	reader.readAsDataURL(file);
}

document.getElementById('inputBanner').addEventListener('change', handleFileSelect, false);
