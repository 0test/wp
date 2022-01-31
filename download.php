<?php 
$lines = explode("\n", file_get_contents(__DIR__.'/files.txt') );

function parser($index, $lines)
{
	if ( $index < count($lines)){
		$line = explode(', ', trim($lines[$index]));
		$filename = pathinfo($line[1])['basename'];
		$dir = pathinfo($line[1])['dirname'];
		if( !is_dir(__DIR__ . '/files/' .parse_url($dir)['path'])){
			mkdir(__DIR__ . '/files/' .parse_url($dir)['path'], 0777, true);
		}
		try {
			save($line[1],  __DIR__ . '/files/' .parse_url($dir)['path'] . '/' . $filename);
			echo "$filename \n";
			echo "$index \n";
		} catch (\Throwable $th) {
			throw $th;
		}
		sleep(rand(0,0.2));
		parser( $index+1, $lines);
	}
	else{
		die($index);
	}
}
parser(1000, $lines);

function save($url,$fname) {
	$timeout  =5;   
	$fp = fopen($fname, 'w');
	$ch = curl_init($url);
	curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	curl_setopt( $ch, CURLOPT_ENCODING, "" );
	curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
	curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
	curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
	$response = curl_exec($ch);
	//echo print_r(curl_getinfo($ch),true);
	if(!$response)$response=print_r(curl_getinfo($ch),true);
	curl_close($ch);
	fclose($fp);
	return $response;
  }