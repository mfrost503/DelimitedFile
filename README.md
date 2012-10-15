## DelimitedFile
DelimitedFile is a class that implements the SPL Iterator interface and provides an interface to iterate through
a file that is organized with a delimiter/enclosure. By default, DelimitedFile is setup to use a comma as the delimiter
and a double quotes as the enclosure; these can be specified other wise in the constructor.

## Example

$df = new DelimitedFile\src\DelimitedFile($file,',','"');

while($row = $df->next() && $df->valid()){
    // do whatever you need to do to the data
}

$df->key() - returns the line in the file
$df->current() - sets the pointer to position of key and returns record
$df->valid() - returns true if we're not at the end of the file
$df->next() - returns the next row
$df->rewind() - rewinds the pointer to the beginning
$df->get($attr) - returns $attr - provided it exists