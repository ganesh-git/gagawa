package com.hp.gagawa;

import static org.junit.Assert.assertEquals;

import org.junit.Test;

import com.hp.gagawa.elements.Br;
import com.hp.gagawa.elements.Img;

public class NonFertileNodeWriteTest {

	@Test
	public void writeTest(){
		assertEquals("br write failed",new Br().write(),"<br>");
		assertEquals("img write failed",new Img("alt text","image.png").write(),"<img alt=\"alt text\" src=\"image.png\">");
		// TODO add tests for all non-fertile nodes
	}
}
