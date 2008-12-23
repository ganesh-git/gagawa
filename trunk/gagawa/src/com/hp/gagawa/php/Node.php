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

require_once("attributes/Attribute.php");

class Node {

	protected $tag_;
	protected $attributes_;
	protected $parent_;

	protected function __construct ( $tag ) {
		$this->tag_ = $tag;
		$this->attributes_ = array();
	}

	public function getParent ( ) {
		return $this->parent_;
	}

	protected function setParent ( $parent ) {
		$this->parent_ = $parent;
	}

	public function setAttribute ( $name, $value ) {
		if(isset($value)){
			foreach ( $this->attributes_ as $attribute ) {
				if($attribute->getName()===$name){
					$attribute->setValue( $value );
					return;
				}
			}
			$this->attributes_[] = new Attribute( $name, $value );
		}
	}

	public function getAttribute ( $name ) {
		foreach ( $this->attributes_ as $attribute ) {
			if($attribute->getName()===$name){
				return $attribute->getValue();
			}
		}
	}

	public function removeAttribute ( $name ) {
		for ( $i = 0; $i < count($this->attributes_); $i++ ) {
			$attribute = $this->attributes_[$i];
			if($attribute->getName()===$name){
				unset( $this->attributes_[$i] );
			}
		}
	}

	public function write ( ) {
		$buffer = $this->writeOpen();
		$buffer .= $this->writeClose();
		return $buffer;
	}

	protected function writeOpen ( ) {
		$buffer = "<";
		$buffer .= $this->tag_;
		foreach ( $this->attributes_ as $attribute ) {
			$buffer .= $attribute->write(); 
		}
		$buffer .= ">";
		return $buffer;
	}

	protected function writeClose ( ) {
		return "</" . $this->tag_ . ">";
	}

}

?>
