export default function Partners( $ ) {
	const partners = {
		settings: {
			gallery: $( '.partners__gallery' ),
			slickOptions: {
				dots: true,
				arrows: false,
				infinite: true,
				speed: 500,
				slidesToShow: 1,
				slidesToScroll: 1,
				mobileFirst: true,
				autoplay: true,
				responsive: [
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 3,
						},
					},
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 4,
						},
					},
					{
						breakpoint: 1500,
						settings: {
							slidesToShow: 5,
						},
					},
				],
			},

		},

		init() {
			if ( partners.settings.gallery.length ) {
				partners.settings.gallery.slick( partners.settings.slickOptions );
			}
		},
	};

	partners.init();
}
