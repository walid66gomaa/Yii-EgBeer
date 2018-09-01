<?php

namespace tests\models;

use app\models\EntryForm;

class EntryFormTest extends \Codeception\Test\Unit
{


	public function testValidSearch()
	{ 
		$form=new EntryForm();
		$form->search='koko';
		$form->select='beer';


		$this->assertTrue($form->validate());

		
	}


	public function testInValidSearch()
	{ 
		$form=new EntryForm();
		$form->search='koko@';
		$form->select='beer';


		$this->assertFalse($form->validate());

		
	}

}