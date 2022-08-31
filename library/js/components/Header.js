export default function Header( $ ) {
	const customMenuItem = {
		settings: {
			nav: $( '.main-nav-container .nav' ),
			reg: new RegExp(
				window.location.pathname.split( '-' ).join( ' ' ).replaceAll( '/', '' ),
				'ig'
			),
		},

		init() {
			this.addActive();
		},

		addActive() {
			if ( window.location.pathname === '/' ) {
				return;
			}
			const link = this.settings.nav.find( 'li.menu-item-object-custom a' );
			$.each( link, function( el, a ) {
				if ( $( a ).text().match( customMenuItem.settings.reg ) ) {
					$( a ).parent().addClass( 'current-menu-item' );
				}
			} );
		},
	};
	customMenuItem.init();

	const headerSticky = {
		settings: {
			header: $( '.header' ),
			sticky: $( '.header' ).offset().top,
			body: $( 'body' ),
		},

		init() {
			// When the user scrolls the page, execute stickyHeader
			$( window ).on( 'scroll', this.stickyHeader );
		},

		stickyHeader() {
			if ( window.pageYOffset > headerSticky.settings.sticky ) {
				headerSticky.settings.header.addClass( 'sticky' );
				headerSticky.settings.body.css(
					'padding-top',
					headerSticky.settings.header.outerHeight()
				);
			} else {
				headerSticky.settings.header.removeClass( 'sticky' );
				headerSticky.settings.body.css( 'padding-top', 0 );
			}
		},
	};
	headerSticky.init();

	const mobileMenu = {
		settings: {
			toggle: $( '.nav-toggle' ),
			closeIcon: 'fa-times',
			nav: $( '.mobile-nav' ),
			header: $( '.header' ),
			body: $( 'html, body' ),
		},

		init() {
			this.bindUIActions();
		},

		bindUIActions() {
			this.settings.toggle.on( 'click', this.handleToggle );
		},

		handleToggle() {
			mobileMenu.settings.nav.toggleClass( 'active' );
			// Add close icon classes to toggle button if nav is active.
			if ( mobileMenu.settings.nav.hasClass( 'active' ) ) {
				mobileMenu.settings.toggle.addClass( mobileMenu.settings.closeIcon );
			} else {
				mobileMenu.settings.toggle.removeClass( mobileMenu.settings.closeIcon );
			}
			mobileMenu.settings.body.toggleClass( 'menu-active' );
			mobileMenu.settings.nav.css(
				'top',
				mobileMenu.settings.header.outerHeight()
			);
		},
	};
	mobileMenu.init();
}
