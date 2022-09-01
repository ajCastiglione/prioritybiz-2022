/*
 * Load imports here.
 */

import Header from './components/Header';
import Forms from './components/Forms';
import Partners from './components/Partners';

jQuery( document ).ready( function( $ ) {
	Header( $ );
	Forms( $ );

	if ( $( '.partners__gallery' ).length ) {
		Partners( $ );
	}
} ); /* end of as page load scripts */
