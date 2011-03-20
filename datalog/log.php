<?php

	/* determins if done to a file or to sql */
	$debug = isset( $_GET['debug'] ) ?  $_GET['debug'] : false;

	/* function for cleaning data, i.e. making it save to be written */
	function clean_data( $data ) {
		$data = strip_tags( $data );
		if( !!$debug ) {
			$data = mysql_real_escape_string( $data );
		}
		return $data;
	}

	$coordx = clean_data( $_GET['x'] );
	$coordy = clean_data( $_GET['y'] );
	$data   = clean_data( $_GET['data'] );

	if( $debug ) {
		$file = fopen( './data.txt', 'a+' );
		fwrite( $file , $coordx.'|'.$coordy.'|'.$data ."\n" );
		fclose( $file );
	} else {

	}
?>
