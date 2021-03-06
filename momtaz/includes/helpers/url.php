<?php

/**
 * Get the current URL.
 *
 * @return string
 * @since 1.3
 */
function momtaz_get_current_url() {
	return ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Check the given URL for a valid structure.
 *
 * @param string URL to be validated
 * @return bool Validation result
 * @since 1.0
 */
function momtaz_is_vaild_url( $url ) {
	return (bool) filter_var( utf8_uri_encode( $url ), FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED + FILTER_FLAG_HOST_REQUIRED );
}

/**
 * Check if the given URL is vaild and self-hosted.
 *
 * Check if the structure of a given URL is valid and the URL is a self hosted one. The 'momtaz_is_self_hosted_url'
 * filter hook can be used to hook into this function if needed.
 *
 * @param string The URL to be validated.
 * @uses momtaz_is_vaild_url() Check the given URL for a valid structure.
 * @uses get_site_url() Get the site URL.
 * @return bool
 * @since 1.2
 */
function momtaz_is_self_hosted_url( $url ) {

	$retval = false;

	if ( momtaz_is_vaild_url( $url ) ) {

		$url_host = parse_url( $url, PHP_URL_HOST );
		$site_host = parse_url( get_site_url(), PHP_URL_HOST );

		$retval = ( empty( $url_host ) || $url_host === $site_host );

	}

	$retval = apply_filters( 'momtaz_is_self_hosted_url', $retval, $url );
	return $retval;

}