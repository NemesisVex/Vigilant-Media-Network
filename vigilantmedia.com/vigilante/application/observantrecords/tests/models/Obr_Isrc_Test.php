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

	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
	}

	public function setUp()
	{
		parent::setUp();

		$this->CI->load->model('Obr_Audio_Isrc');
		$this->Obr_Audio_Isrc = $this->CI->Obr_Audio_Isrc;
	}

	public function test_constructor()
	{
		$this->assertEquals('ep4_audio_isrc', $this->Obr_Audio_Isrc->table_name);
		$this->assertEquals('audio_isrc_id', $this->Obr_Audio_Isrc->primary_index_field);
	}

	public function test_retrieve()
	{
		//If no field and value are passed, the resulting query should return false.
		$result = $this->Obr_Audio_Isrc->retrieve();
		$this->assertFalse($result);

		//If an invalid field is passed, the resulting query should return false.
		$result = $this->Obr_Audio_Isrc->retrieve(NULL, 1);
		$this->assertFalse($result);

		$result = $this->Obr_Audio_Isrc->retrieve('invalid_field_name', 1);
		$this->assertFalse($result);

		//If an invalid value is passed, the resulting query should return no results.
		$result = $this->Obr_Audio_Isrc->retrieve('audio_isrc_id', 'id');
		$this->assertEquals(0, $result->num_rows);

		$result = $this->Obr_Audio_Isrc->retrieve('audio_isrc_id', 0);
		$this->assertEquals(0, $result->num_rows);

		// If a valid field and value is passed, the resulting query should return results.
		$result = $this->Obr_Audio_Isrc->retrieve('audio_isrc_id', '1');
		$this->assertGreaterThanOrEqual(1, $result->num_rows());
	}

	public function test_retrieve_all()
	{
		// No result is valid value, although there should at least be one.
		$result = $this->Obr_Audio_Isrc->retrieve_all();
		$this->assertGreaterThanOrEqual(0, count($result));

		// Limit the selection to one field.
		$result = $this->Obr_Audio_Isrc->retrieve_all('audio_isrc_code');
		// Test for the selected field.
		$this->assertObjectHasAttribute('audio_isrc_code', $result[0]);
		// Test for non-selected fields that are in the table schema.
		$this->assertObjectNotHasAttribute('audio_isrc_id', $result[0]);
		// Test for a non-selected field that's not in the table schema.
		$this->assertObjectNotHasAttribute('invalid_field', $result[0]);
	}

	public function test_retrieve_by_id()
	{
		// The ID field should never be NULL, so there should be at least one returned result.
		$result = $this->Obr_Audio_Isrc->retrieve_by_id(NULL, FALSE);
		$this->assertLessThan(1, $result->num_rows);

		// If an invalid ID is passed, the query result should be false
		$result = $this->Obr_Audio_Isrc->retrieve_by_id('id');
		$this->assertFalse($result);

		// Make sure the raw results are returned when the return_recordset flag is set to FALSE.
		$result = $this->Obr_Audio_Isrc->retrieve_by_id('id', FALSE);
		$this->assertObjectHasAttribute('conn_id', $result);

		$result = $this->Obr_Audio_Isrc->retrieve_by_id(1, FALSE);
		$this->assertObjectHasAttribute('conn_id', $result);

		// If a valid ID is passed, the query should contain a single result.
		$result = $this->Obr_Audio_Isrc->retrieve_by_id(1);
		$this->assertEquals(1, count($result));
		$this->assertObjectHasAttribute('audio_isrc_id', $result);
		$this->assertObjectHasAttribute('audio_isrc_code', $result);
	}
	
	public function test_generate_code() {
		$result = $this->Obr_Audio_Isrc->generate_code();
		echo $result . "\n";
		$this->assertStringStartsWith('us-', $result);
		
		$id = $this->Obr_Audio_Isrc->create(array('audio_isrc_code' => $result));
		echo $id . "\n";
		$this->assertNotNull($id);
		
		$result_02 = $this->Obr_Audio_Isrc->generate_code();
		echo $result_02 . "\n";
		$this->assertStringStartsWith('us-', $result);
		$this->assertNotEquals($result_02, $result);
	}

	public function tearDown()
	{
		parent::tearDown();
	}
}
