<?php
namespace DelimitedFile\src;

class DelimitedFile implements \Iterator {

    private $delimiter;
    private $enclosure;
    private $handle;
    private $line = 0;

    /**
     * @param $filename
     * @param string $delimiter
     * @param string $enclosure
     * @description Filename set with ability to override default delimiters, populates
     * the handle property so the file can be iterated.
     */

    public function __construct($filename,$delimiter=',',$enclosure='"')
    {
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->handle = fopen($filename,'r');
    }

    /**
     * @return array|mixed
     * @description takes the current line and returns the file to that position
     * then returns the row at that position.
     */

    public function current()
    {
        fseek($this->handle,$this->line);
        return fgetcsv($this->handle,1024,$this->delimiter,$this->enclosure);
    }

    /**
     * @return bool
     * @description Verifies that the position of the file pointer is not the
     * end of the file, returns true if not EOF and false if EOF
     */

    public function valid()
    {
        if(!(feof($this->handle))){
            return true;
        }
        return false;
    }

    /**
     * @return int|mixed
     * @description returns the line number of the file
     */

    public function key()
    {
        return $this->line;
    }

    /**
     * @return array|void
     * @description increment the line number and return the result
     */

    public function next()
    {
        if($this->valid()){
            $this->line++;
            return fgetcsv($this->handle,1024,$this->delimiter,$this->enclosure);
        }
        return array();
    }

    /**
     * @description returns the file pointer to 0
     */
    public function rewind()
    {
        $this->line = 0;
        rewind($this->handle);
    }

    /**
     * @param $attr
     * @return mixed
     * @description allows for the retrieval of a property, including the handle, delimiter or enclosure
     */
    public function get($attr)
    {
        return $this->$attr;
    }
}