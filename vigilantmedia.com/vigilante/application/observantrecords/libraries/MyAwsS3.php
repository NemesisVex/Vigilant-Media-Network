<?php

require(APPPATH . 'third_party/vendor/autoload.php');

use Aws\S3\S3Client;
use Aws\S3\Exception;

/**
 * MyAwsS3
 *
 * @author Greg Bueno
 */
class MyAwsS3
{
	protected $s3;

	public function __construct()
	{
		$this->s3 = Aws\S3\S3Client::factory(array(
			'key' => ACCESS_KEY_ID,
			'secret' => SECRET_ACCESS_KEY,
		));
	}

	public function bucket_exists($bucket_name = null)
	{
		return $this->s3->doesBucketExist($bucket_name);
	}

	public function list_objects($args = array())
	{
		return $this->s3->listObjects($args);
	}
}

?>
