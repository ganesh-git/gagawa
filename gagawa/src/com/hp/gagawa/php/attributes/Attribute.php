<?php

/**
(c) Copyright 2008 Hewlett-Packard Development Company, L.P.

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
*/

/*
 * Gagawa Attribute PHP
 * @author kolichko Mark Kolich
 */
class Attribute {

	private $name_;
	private $value_;

	public function __construct ( $name = NULL, $value = NULL ) {

		if(empty($name) || empty($value)){
			throw new Exception( "Attributes must have a name " .
						"and a value!" );
		}

		$this->name_ = $name;
		$this->value_ = $value;

	}

	public function write ( ) {
		return " " . $this->name_ .
			"=\"" . $this->value_ .
			"\"";
	}

	public function getName ( ) {
		return $this->name_;
	}

	public function setName ( $name = NULL ) {
		
		if(empty($name)){
			throw new Exception( "Attribute names cannot be " .
									"empty!" );											
		}
		
		$this->name_ = $name;
		
	}

	public function getValue ( ) {
		return $this->value_;
	}

	public function setValue ( $value ) {
		
		if(empty($name)){
			throw new Exception( "Attribute values cannot be " .
									"empty!" );											
		}
		
		$this->value_ = $value;
		
	}

}

?>
