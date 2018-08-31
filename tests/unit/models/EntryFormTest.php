<?php

namespace tests\models;

use app\models\EntryForm;

class EntryFormTest extends \Codeception\Test\Unit
{
  

    public function testSearch()
    { 
      $form=new EntryForm();
      $form->search='koko@';
      $form->select='beer';

    
      $this->assertTrue($form->validate());

      
      
      
      $this->assertTrue($form->validate());
   }

}

