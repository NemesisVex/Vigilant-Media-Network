<?php

/**
 * Obr_Isrc_Test
 *
 * Unit tests for obr_audio_isrc model.
 *
 * @author Greg Bueno
 */
class Obr_Isrc_Test extends CIUnit_TestCase
{
	protected $Obr_Song;
	private $_isrc_stem;

	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
	}

	public function setUp()
	{
		parent::setUp();

		$this->CI->load->model('Obr_Audio_Isrc');
		$this->Obr_Audio_Isrc = $this->CI->Obr_Audio_Isrc;
		$this->_isrc_stem = ISRC_COUNTRY_CODE . '-' . ISRC_REGISTRANT_CODE . '-' . date('y') . '-';
	}

	public function test_constructor()
	{
		$this->assertEquals('ep4_audio_isrc', $this->Obr_Audio_Isrc->_table);
		$this->assertEquals('audio_isrc_id', $this->Obr_Audio_Isrc->primary_key);
	}
	
	public function test_get_audio()
	{
		$result_01 = $this->Obr_Audio_Isrc->with('audio')->get(1);
		$this->assertObjectHasAttribute('audio', $result_01);
	}

	public function test_generate_code() {
		$result = $this->Obr_Audio_Isrc->generate_code();
		$this->assertStringStartsWith(ISRC_COUNTRY_CODE . '-', $result);
		
		$result_02 = $this->Obr_Audio_Isrc->generate_code();
		$this->assertStringStartsWith(ISRC_COUNTRY_CODE . '-', $result);
		$this->assertEquals($result_02, $result);
		
		// Generate random audio ID.
		$audio_isrc_audio_id = mt_rand();
		$check = $this->Obr_Audio_Isrc->get_many_by('audio_isrc_audio_id', $audio_isrc_audio_id);
		while (count($check) > 0) {
			$audio_isrc_audio_id = mt_rand();
			$check = $this->Obr_Audio_Isrc->get_many_by('audio_isrc_audio_id', $audio_isrc_audio_id);
		}
		echo $audio_isrc_audio_id . "\n";
		
		$input = array(
			'audio_isrc_audio_id' => $audio_isrc_audio_id,
		);
		$this->Obr_Audio_Isrc->update_by('audio_isrc_code', $result_02, $input);
		
		$result_03 = $this->Obr_Audio_Isrc->generate_code();
		$this->assertStringStartsWith(ISRC_COUNTRY_CODE . '-', $result);
		$this->assertNotEquals($result_03, $result_02);
	}

	public function tearDown()
	{
		parent::tearDown();
	}
}
