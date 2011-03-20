<?php
	include('settings.php');

	/* determins if done to a file or to sql */
	$debug = isset( $_GET['debug'] ) ?  $_GET['debug'] : false;

	/* initialize sql if needed. must be on for mysql_real_escape_string to work */
	if( !$debug ) {
		mysql_connect( $MYSQL_SERVER, $MYSQL_USER , $MYSQL_PASSWORD );
		mysql_selectdb( $MYSQL_DATABASE );
	}

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
		var_dump( $data );
		$data = explode( '|', $data );
		var_dump( $data );
		$query = 'INSERT INTO '.$MYSQL_TABLE.' (x,y,company,data) VALUES ('.
			$coordx.','.$coordy.',\''.$data[0].'\',\''.$data[1].'\''.
			')';
		echo $query;
		mysql_query( $query );
		mysql_close();
	}
?>
