document.addEventListener('DOMContentLoaded', function () {
	const wrapper = document.getElementById('wrapper');
	const buttons = document.querySelectorAll('.menu-toggle');

	buttons.forEach(function (button) {
		button.addEventListener('click', function () {
			wrapper.classList.toggle('toggled');
		});
	});
});
