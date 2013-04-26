<?php

/**
 * Obr_Song_Test
 *
 * Unit tests for Obr_Song model.
 *
 * @author Greg Bueno
 */
class Obr_Song_Test extends CIUnit_TestCase
{
	protected $Obr_Song;

	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
	}
	
	public function setUp()
	{
		parent::setUp();

		$this->CI->load->model('Obr_Song');
		$this->Obr_Song = $this->CI->Obr_Song;
	}

	public function test_constructor()
	{
		$this->assertEquals('ep4_songs', $this->Obr_Song->_table);
		$this->assertEquals('song_id', $this->Obr_Song->primary_key);
	}
	
	public function test_get_tracks()
	{
		$song_title = 'enigmatics I';
		$result_01 = $this->Obr_Song->with('tracks')->get_by('song_title', $song_title);
		$this->assertEquals($result_01->song_title, $song_title);
		$this->assertObjectHasAttribute('tracks', $result_01);
	}
	
	public function test_get_audio()
	{
		$song_title = 'enigmatics I';
		$result_01 = $this->Obr_Song->with('audio')->get_by('song_title', $song_title);
		$this->assertEquals($result_01->song_title, $song_title);
		$this->assertObjectHasAttribute('audio', $result_01);
	}
	
	public function test_soft_delete()
	{
		$input = $this->_build_test_song();
		$test_id_01 = $this->Obr_Song->insert($input);
		
		$result_01 = $this->Obr_Song->get($test_id_01);
		$this->assertEquals($result_01->song_title, $input['song_title']);
		
		$result_02 = $this->Obr_Song->delete($test_id_01);
		
		$result_03 = $this->Obr_Song->get($test_id_01);
		$this->assertEmpty($result_03);
		
		$result_04 = $this->Obr_Song->with_deleted()->get($test_id_01);
		$this->assertEquals($result_01->song_title, $input['song_title']);
	}
	
	private function _build_test_song()
	{
		return array(
			'song_title' => 'Song of Test ' . date('U'),
		);
	}

	public function tearDown()
	{
		parent::tearDown();
	}
}

?>
