(function () {
	'use strict';

	function initHeaderScrollState() {
		var header = document.querySelector('[data-site-header]');
		if (!header) {
			return;
		}
		var toggle = header.querySelector('[data-nav-toggle]');
		var main = document.getElementById('main-content');
		var hasHeroFirst = main && main.firstElementChild && main.firstElementChild.classList.contains('hero');
		if (!hasHeroFirst) {
			header.classList.add('is-static');
		}

		var updateSolidState = function () {
			header.classList.toggle('is-solid', window.scrollY > 40);
		};
		updateSolidState();
		window.addEventListener('scroll', updateSolidState, { passive: true });

		if (toggle) {
			toggle.addEventListener('click', function () {
				var isOpen = header.classList.toggle('is-nav-open');
				toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
			});
		}
	}

	function initTestimonialSliders() {
		var sliders = document.querySelectorAll('[data-testimonial-slider]');

		sliders.forEach(function (slider) {
			var slides = Array.prototype.slice.call(slider.querySelectorAll('[data-testimonial-slide]'));
			var dots = Array.prototype.slice.call(slider.querySelectorAll('[data-testimonial-dot]'));
			if (slides.length < 2) {
				return;
			}

			var currentIndex = 0;
			var timer = null;

			var showSlide = function (index) {
				currentIndex = (index + slides.length) % slides.length;
				slides.forEach(function (slide, i) {
					slide.classList.toggle('is-active', i === currentIndex);
				});
				dots.forEach(function (dot, i) {
					dot.classList.toggle('is-active', i === currentIndex);
				});
			};

			var startAutoplay = function () {
				stopAutoplay();
				timer = window.setInterval(function () {
					showSlide(currentIndex + 1);
				}, 6000);
			};
			var stopAutoplay = function () {
				if (timer) {
					window.clearInterval(timer);
				}
			};

			dots.forEach(function (dot, i) {
				dot.addEventListener('click', function () {
					showSlide(i);
					startAutoplay();
				});
			});

			slider.addEventListener('mouseenter', stopAutoplay);
			slider.addEventListener('mouseleave', startAutoplay);

			startAutoplay();
		});
	}

	document.addEventListener('DOMContentLoaded', function () {
		initHeaderScrollState();
		initTestimonialSliders();
	});
})();
