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
 * Gagawa FertileNode PHP
 * @author kolichko Mark Kolich
 */
class FertileNode extends Node {

	private $children_;

	public function __construct ( $tag = NULL ) {

		if(empty($tag)){
			throw new Exception( "FertileNode's must have a tag " .
						"type!" );
		}

		parent::__construct( $tag );
		$this->children_ = array();

	}
	
	public function appendChild ( $childNode = NULL ) {

		if(empty($childNode)){
			throw new Exception( "You cannot append an empty " .
						"child node!" );
		}

		$childNode->setParent( $this );
		$this->children_[] = $childNode;
		return $this;
	}

	public function removeChild ( $childNode = NULL ) {

		if(empty($childNode)){
			throw new Exception( "You cannot remove an empty " .
						"child node!" );
		}

		for ( $i = 0; $i < count($this->children_); $i++ ) {
			$child = $this->children_[$i];
			if($child===$childNode){
				unset( $this->children_[$i] );
				return true;
			}
		}

		return false;

	}

	public function removeChildren ( ) {
		unset( $this->children_ );
		$this->children_ = array();
	}

	public function getChildren ( ) {
		return $this->children_;
	}

	public function getChild ( $index = 0 ) {
		return $this->children_[$index];
	}

	/* @Override */
	public function write ( ) {
		$buffer = $this->writeOpen();
		foreach ( $this->children_ as $child ) {
			$buffer .= $child->write();
		}
		$buffer .= $this->writeClose();
		return $buffer;
	}

}

?>
