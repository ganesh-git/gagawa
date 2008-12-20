package com.hp.gagawa;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.PrintWriter;

import com.hp.gagawa.elements.A;
import com.hp.gagawa.elements.Br;
import com.hp.gagawa.elements.Comment;
import com.hp.gagawa.elements.Div;
import com.hp.gagawa.elements.Img;
import com.hp.gagawa.elements.Table;
import com.hp.gagawa.elements.Td;
import com.hp.gagawa.elements.Text;
import com.hp.gagawa.elements.Tr;


public class TestProgram {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		
		Document document = new Document(DocumentType.XHTMLStrict);
		
		Comment c1 = new Comment("This is part 1.");
		c1.appendChild(new Text("This is a comment!\n"));
		c1.appendChild(new Text("This is part 2!"));
		document.body.appendChild(c1);
		document.body.setBgcolor("#CCC");
		Div d1 = new Div().setId("myDiv");
		Div d2 = new Div().setCSSClass("mainClass");
		d1.appendChild(d2);
		d2.appendChild(new Text("Inside of div2"));
		d2.appendChild(new Br());
		d2.appendChild(new A("http://www.jumppage.com","_blank").appendChild(new Text("jumppage")));
		Img img = new Img("http://www.w3schools.com/tags/angry.gif","");
		d2.appendChild(new Br());
		d2.appendChild(img);
		document.body.appendChild(d1);
		
		Table table = new Table();
		
		int count = 0;
		for(int row = 0; row < 10; row++){
			Tr tr = new Tr();
			table.appendChild(tr);
			for(int col = 0; col < 10; col++){
				Td td = new Td();
				tr.appendChild(td);
				td.appendChild(new Text(count++));
			}
		}
		document.body.appendChild(table);
		
		d1.setStyle("float:left");
		
		try {
			File output = new File("test/test.html");
			PrintWriter out = new PrintWriter(new FileOutputStream(output));
			out.println(document.write());
			System.out.println(document.write());
			out.close();
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

}
