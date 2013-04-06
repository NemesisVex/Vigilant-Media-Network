<?php

/**
 * MyAwsS3_test
 *
 * Unit tests for MyAwsS3 class.
 *
 * @author Greg Bueno
 */
class MyAwsS3_test extends CIUnit_TestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->CI->load->library('MyAwsS3', '', 's3');
	}

	public function test_bucket_exists()
	{
		// Test whether connection was successful.
		$result = $this->CI->s3->bucket_exists('observant-records');
		$this->assertTrue($result);
	}

	public function test_list_objects()
	{
		$args = array(
			'Bucket' => 'observant-records',
			'Key' => '/releases/music/imprint/mp3'
		);
		$result = $this->CI->s3->list_objects($args);
//		foreach ($result as $object) {
//			echo $object['Key'] . PHP_EOL;
//		}
		$this->assertFalse($result);
	}
}

?>
