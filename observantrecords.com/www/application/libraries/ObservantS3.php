<?php

/**
 * ObservantS3
 * 
 * ObservantS3 is a library to interact with the Observant Records S3 bucket.
 *
 * @author Greg Bueno
 */

use Aws\S3\S3Client;
use Aws\S3\Exception;
use Aws\S3\Iterator;

class ObservantS3 {
	
	private $CI;
	private $s3;
	private $bucket = 'observant-records';
	private $artist_root = 'artists';
	
	public function __construct() {
		
		$this->CI =& get_instance();
		
		$params = array(
			'key' => ACCESS_KEY_ID,
			'secret' => SECRET_ACCESS_KEY,
		);
		$this->CI->load->library('MyAws');
		
		$this->s3 = Aws\S3\S3Client::factory($params);
	}
	
	public function list_folders($artist_alias = 'eponymous-4') {
		$prefix = $this->artist_root . '/' . $artist_alias;
		
		$args = array(
			'Bucket' => $this->bucket,
			'Prefix' => $prefix,
		);
		$results = $this->s3->getIterator('ListObjects', $args);
		
		$directories = array();
		foreach ($results as $result) {
			$dirname = dirname($result['Key']); 
			if (array_search($dirname, $directories) === false) {
				$directories[] = $dirname;
			}
		}
		
		return $directories;
	}
}

?>
