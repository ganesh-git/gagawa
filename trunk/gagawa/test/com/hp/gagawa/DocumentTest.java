/**
 * 
 */
package com.hp.gagawa;

import static org.junit.Assert.*;
import org.junit.Test;


/**
 * @author friedrch
 *
 */
public class DocumentTest {

	@Test
	public void testDocument(){
		Document doc = new Document(DocumentType.XHTMLTransitional);
		assertNotNull("Document head is null!",doc.head);
		assertNotNull("Document body is null!",doc.body);
	}
}
