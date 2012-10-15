<?php

class DelimitedFileTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $file ='/Users/mfrost/PhpstormProjects/DelimitedFile/tests/resources/test.csv';
        $this->df = new \DelimitedFile\src\DelimitedFile($file,',','"');
    }

    public function tearDown()
    {
        unset($df);
    }

    /**
     * @test
     * Given that we have a DelimitedFile object
     * we can confirm the delimiter and enclosure is set
     * and that the handle is a file resource
     */

    public function ConfirmDelimiterEnclosureAndFileResource()
    {

        $handle = $this->df->get('handle');
        $delimiter = $this->df->get('delimiter');
        $enclosure = $this->df->get('enclosure');
        $this->assertTrue(is_resource($handle));
        $this->assertEquals(',',$delimiter);
        $this->assertEquals('"',$enclosure);
    }

    /**
     * @test
     * Given that we have a Delimited file, we should be able to verify that
     * we receive the first record when current is used.
     */

    public function ConfirmReturnedRowIsFirstRowFromFile()
    {
        $row = $this->df->current();
        $this->assertEquals($row[0],'This is a test');
        $row = $this->df->current();
        $this->assertEquals($row[0],'This is a test');
        unset($row);
    }

    /**
     * @test
     */
    public function ConfirmThatResetSendsFilePointerToBeginning()
    {
        $this->df->next();
        $test = $this->df->next();
        $this->assertEquals($test[0],'This is also a test');
        $this->assertEquals(2,$this->df->key());
        $this->df->rewind();
        $row = $this->df->current();
        $this->assertEquals($row[0],'This is a test');
    }

    /**
     * @test
     * Verify that the valid method is properly returning an empty array vs a row
     */

    public function ConfirmTheValidMethodIsProperlyReturningEmptyArray()
    {
        $row1 = $this->df->next();
        $this->assertTrue(!empty($row1));
        $row2 = $this->df->next();
        $this->assertTrue(!empty($row2));
        $row3 = $this->df->next();
        $this->assertTrue(!empty($row3));
        $noRow = $this->df->next();
        $this->assertTrue(empty($noRow));
    }

}