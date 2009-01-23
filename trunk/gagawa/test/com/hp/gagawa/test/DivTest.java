package com.hp.gagawa.test;

import static org.junit.Assert.*;
import org.junit.Test;

import com.hp.gagawa.java.elements.Div;




public class DivTest {

	@Test
	public void test() throws Exception {
		Div div = (Div) new Div().appendText("Hello World");
		assertEquals("","<div>Hello World</div>",div.write());
	}
	
}
