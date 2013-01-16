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
}

?>
