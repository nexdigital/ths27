<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends MY_Controller {
	
	private $ppn_handling_jakarta = 10;
	private $nt_handling_jakarta = 50;

	function __construct(){
		parent::__construct();
	}

	function priview($hawb_no){
		//Check tax
		$this->invoice_model->checked_tax($hawb_no);
		
		$data['data'] = $this->manifest_model->get_by_hawb($hawb_no);
		$data['shipper'] = $this->customers_model->get_by_id($data['data']->shipper);
		$data['consignee'] = $this->customers_model->get_by_id($data['data']->consignee);
		
		$data['freight'] = $this->manifest_model->get_freight($hawb_no) * $data['data']->exchange_rate;
		$data['handling_jakarta'] = $this->manifest_model->get_handling_jakarta($hawb_no) * $data['data']->exchange_rate;
		
		$data['reimbursement'] = $this->invoice_model->get_item($hawb_no,'reimbursement');
		$data['non_reimbursement'] = $this->invoice_model->get_item($hawb_no,'non_reimbursement');
		
		//$data['extra_charge'] = $this->manifest_model->get_extra_charge($data['data']->hawb_no);
		
		$data['is_tax'] = $this->invoice_model->is_tax($hawb_no);
		$data['total_tax'] = $this->invoice_model->get_total_tax($hawb_no);
		$data['total_invoice'] = $this->manifest_model->get_total($hawb_no); //return on rupiah
		
		$this->load->view('manifest/airwaybill',$data);
	}

	function total($hawb_no){
		$get_total = $this->manifest_model->get_total($hawb_no);
		echo number_format($get_total);
	}

	function add_item(){
		$hawb_no = $_POST['hawb_no'];
		$type = $_POST['type'];
		$name = $_POST['name'];	
		$value = $_POST['value'];
		$id = $this->invoice_model->add_item($hawb_no,$type,$name,$value);
		echo json_encode(array('id'=>$id,'type'=>$type,'name'=>$name,'value'=>number_format($value)));
	}
	
	function remove_item(){
		$id = $this->input->post('item_id');
		$this->invoice_model->remove_item($id);
	}
	
	function updatetax($status){
		$hawb_no = $this->input->post('hawb_no');
		$this->invoice_model->update_tax($hawb_no,($status === 'true') ? 'active' : 'nonactive');
		return true;
	}
	
	function gettax($hawb_no){
		$get_total = $this->invoice_model->get_total_tax($hawb_no);
		echo number_format($get_total);
	}

	function edit($hawb_no) {
		$this->db->insert('invoice_table',array('created_date' => date('Y-m-d h:i:s')));

		$data['invoice_id'] = $this->db->insert_id();
		$data['data']	= $this->manifest_model->get_data($hawb_no);
		$data['discount'] = $this->manifest_model->get_discount($hawb_no);
		$data['extra_charge'] = $this->manifest_model->get_extra_charge($hawb_no);
		$data['title']	= 'Edit Invoice #'.$hawb_no;
		$this->set_content('manifest/invoice_edit',$data);
	}

	function save(){
		$invoice['hawb_no'] = $_POST['hawb_no'];
		$invoice['shipper_name'] = $_POST['shipper_name'];
		$invoice['shipper_address'] = $_POST['shipper_address'];
		$invoice['shipper_attn'] = $_POST['shipper_attn'];
		$invoice['consignee_name'] = $_POST['consignee_name'];
		$invoice['consignee_address'] = $_POST['consignee_address'];
		$invoice['consignee_attn'] = $_POST['consignee_attn'];
		$invoice['status'] = 'active';

		$this->db->where('invoice_id',$_POST['invoice_id']);
		$this->db->update('invoice_table',$invoice);
	}

	function printout($hawb_no) {
		$this->manifest_model->update_status($hawb_no,'Finish');
		$this->manifest_model->update_status_delivery($hawb_no,'On Progress');
		try {
			$this->invoice_model->create($hawb_no);
		} catch (Exception $e) {
			redirect('asset/invoice/'.$hawb_no.'.pdf');
		}
	}
	
	function test(){
		$html = '
		<h1><a name="top"></a>mPDF</h1>
		<h2>Basic HTML Example</h2>
		This file demonstrates most of the HTML elements.
		<h3>Heading 3</h3>
		<h4>Heading 4</h4>
		<h5>Heading 5</h5>
		<h6>Heading 6</h6>
		<p>P: Nulla felis erat, imperdiet eu, ullamcorper non, nonummy quis, elit. Suspendisse potenti. Ut a eros at ligula vehicula pretium. Maecenas feugiat pede vel risus. Nulla et lectus. Fusce eleifend neque sit amet erat. Integer consectetuer nulla non orci. Morbi feugiat pulvinar dolor. Cras odio. Donec mattis, nisi id euismod auctor, neque metus pellentesque risus, at eleifend lacus sapien et risus. Phasellus metus. Phasellus feugiat, lectus ac aliquam molestie, leo lacus tincidunt turpis, vel aliquam quam odio et sapien. Mauris ante pede, auctor ac, suscipit quis, malesuada sed, nulla. Integer sit amet odio sit amet lectus luctus euismod. Donec et nulla. Sed quis orci. </p>
		
		<hr />
		
		<div><img src="tiger.wmf" style="float:right;">DIV: Proin aliquet lorem id felis. Curabitur vel libero at mauris nonummy tincidunt. Donec imperdiet. Vestibulum sem sem, lacinia vel, molestie et, laoreet eget, urna. Curabitur viverra faucibus pede. Morbi lobortis. Donec dapibus. Donec tempus. Ut arcu enim, rhoncus ac, venenatis eu, porttitor mollis, dui. Sed vitae risus. In elementum sem placerat dui. Nam tristique eros in nisl. Nulla cursus sapien non quam porta porttitor. Quisque dictum ipsum ornare tortor. Fusce ornare tempus enim. </div>
		<div><img src="klematis.jpg" style="opacity: 0.5; float: left;" />DIV: Proin aliquet lorem id felis. Curabitur vel libero at mauris nonummy tincidunt. Donec imperdiet. Vestibulum sem sem, lacinia vel, molestie et, laoreet eget, urna. Curabitur viverra faucibus pede. Morbi lobortis. Donec dapibus. Donec tempus. Ut arcu enim, rhoncus ac, venenatis eu, porttitor mollis, dui. Sed vitae risus. In elementum sem placerat dui. Nam tristique eros in nisl. Nulla cursus sapien non quam porta porttitor. Quisque dictum ipsum ornare tortor. Fusce ornare tempus enim. </div>
		
		<blockquote>Blockquote: Maecenas arcu justo, malesuada eu, dapibus ac, adipiscing vitae, turpis. Fusce mollis. Aliquam egestas. In purus dolor, facilisis at, fermentum nec, molestie et, metus. Maecenas arcu justo, malesuada eu, dapibus ac, adipiscing vitae, turpis. Fusce mollis. Aliquam egestas. In purus dolor, facilisis at, fermentum nec, molestie et, metus.</blockquote>
		
		<address>Address: Vestibulum feugiat, orci at imperdiet tincidunt, mauris erat facilisis urna, sagittis ultricies dui nisl et lectus. Sed lacinia, lectus vitae dictum sodales, elit ipsum ultrices orci, non euismod arcu diam non metus.</address>
		
		<pre>PRE: Cum sociis natoque penatibus et magnis dis parturient montes, 
		nascetur ridiculus mus. In suscipit turpis vitae odio. Integer convallis 
		dui at metus. Fusce magna. Sed sed lectus vitae enim tempor cursus. Cras 
		sed, posuere et, urna. Quisque ut leo. Aliquam interdum hendrerit tortor. 
		Vestibulum elit. Vestibulum et arcu at diam mattis commodo. Nam ipsum sem, 
		ultricies at, rutrum sit amet, posuere nec, velit. Sed molestie mollis dui.</pre>
		
		<div><a href="#top">Hyperlink (&lt;a&gt;) to top of document</a></div>
		<div><a href="http://www.mpdf1.com/mpdf/">Hyperlink (&lt;a&gt;) to mPDF</a></div>
		
		<div>Styles - <tt>tt(teletype)</tt> <i>italic</i> <b>bold</b> <big>big</big> <small>small</small> <em>emphasis</em> <strong>strong</strong> <br />new lines<br>
		<code>code</code> <samp>sample</samp> <kbd>keyboard</kbd> <var>variable</var> <cite>citation</cite> <abbr>abbr.</abbr> <acronym>ACRONYM</acronym> <sup>sup</sup> <sub>sub</sub> <strike>strike</strike> <s>strike-s</s> <u>underline</u> <del>delete</del> <ins>insert</ins> <q>To be or not to be</q> <font face="sans-serif" color="#880000" size="5">font changing face, size and color</font>
		</div>
		
		<p style="font-size:15pt; color:#440066">Paragraph using the in-line style to determine the font-size (15pt) and colour</p>
		
		
		<h3>Testing BIG, SMALL, UNDERLINE, STRIKETHROUGH, FONT color, ACRONYM, SUPERSCRIPT and SUBSCRIPT</h3>
		<p>This is <s>strikethrough</s> in <b><s>block</s></b> and <small>small <s>strikethrough</s> in <i>small span</i></small> and <big>big <s>strikethrough</s> in big span</big> and then <u>underline and <s>strikethrough and <sup>sup</sup></s></u> but out of span again but <font color="#000088">blue</font> font and <acronym>ACRONYM</acronym> text</p>
		
		<p>This is a <font color="#008800">green reference<sup>32-47</sup></font> and <u>underlined reference<sup>32-47</sup></u> then reference<sub>32-47</sub> and <u>underlined reference<sub>32-47</sub></u> then <s>Strikethrough reference<sup>32-47</sup></s> and <s>strikethrough reference<sub>32-47</sub></s></p> 
		
		<p><big>Repeated in <u>BIG</u>: This is reference<sup>32-47</sup> and <u>underlined reference<sup>32-47</sup></u> then reference<sub>32-47</sub> and <u>underlined reference<sub>32-47</sub></u> but out of span again but <font color="#000088">blue</font> font and <acronym>ACRONYM</acronym> text</big></p> 
		
		<p><small>Repeated in small: This is reference<sup>32-47</sup> and <u>underlined reference<sup>32-47</sup></u> then reference<sub>32-47</sub> and <u>underlined reference<sub>32-47</sub></u> but out of span again but <font color="#000088">blue</font> font and <acronym>ACRONYM</acronym> text</small></p>
		
		<p>The above repeated, but starting with a paragraph with font-size specified (7pt)</p>
		
		<p style="font-size:7pt;">This is <s>strikethrough</s> in block and <small>small <s>strikethrough</s> in small span</small> and then <u>underline</u> but out of span again but <font color="#000088">blue</font> font and <acronym>ACRONYM</acronym> text</p>
		
		<p style="font-size:7pt;">This is <s>strikethrough</s> in block and <big>big <s>strikethrough</s> in big span</big> and then <u>underline</u> but out of span again but <font color="#000088">blue</font> font and <acronym>ACRONYM</acronym> text</p>
		
		<p style="font-size:7pt;">This is reference<sup>32-47</sup> and <u>underlined reference<sup>32-47</sup></u> then reference<sub>32-47</sub> and <u>underlined reference<sub>32-47</sub></u> then <s>Strikethrough reference<sup>32-47</sup></s> and <s>strikethrough reference<sub>32-47</sub></s></p>
		
		<p><small>This tests <u>underline</u> and <s>strikethrough</s> when they are <s><u>used together</u></s> as they both use text-decoration</small></p>
		
		
		<p><small>Repeated in small: This is reference<sup>32-47</sup> and <u>underlined reference<sup>32-47</sup></u> then reference<sub>32-47</sub> and <u>underlined reference<sub>32-47</sub></u> but out of span again but <font color="#000088">blue</font> font and <acronym>ACRONYM</acronym> text</small></p> 
		
		<p style="font-size:7pt;"><big>Repeated in BIG but with font-size set to 7pt by in-line css: This is reference<sup>32-47</sup> and <u>underlined reference<sup>32-47</sup></u> then reference<sub>32-47</sub> and <u>underlined reference<sub>32-47</sub></u> but out of span again but <font color="#000088">blue</font> font and <acronym>ACRONYM</acronym> text</big></p>
		
		<ol>
		<li>Item <b><u>1</u></b></li>
		<li>Item 2<sup>32</sup></li>
		<li><small>Item</small> 3</li>
		<li>Praesent pharetra nulla in turpis. Sed ipsum nulla, sodales nec, vulputate in, scelerisque vitae, magna. Sed egestas justo nec ipsum. Nulla facilisi. Praesent sit amet pede quis metus aliquet vulputate. Donec luctus. Cras euismod tellus vel leo. 
		<ul>
		<li>Praesent pharetra nulla in turpis. Sed ipsum nulla, sodales nec, vulputate in, scelerisque vitae, magna. Sed egestas justo nec ipsum. Nulla facilisi. Praesent sit amet pede quis metus aliquet vulputate. Donec luctus. Cras euismod tellus vel leo. </li>
		<li>Subitem 2
		<ul>
		<li>
		Level 3 subitem
		</li>
		</ul>
		</li>
		</ul>
		</li>
		<li>Item 5</li>
		</ol>
		
		<dl>
		<dt>Definition list</dt>
		<dd>List defined by DL, DD and DT tags</dd>
		</dl>
		
		<p>Sed bibendum. Nunc eleifend ornare velit. Sed consectetuer urna in erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris sodales semper metus. Maecenas justo libero, pretium at, malesuada eu, mollis et, arcu. Ut suscipit pede in nulla. Praesent elementum, dolor ac fringilla posuere, elit libero rutrum massa, vel tincidunt dui tellus a ante. Sed aliquet euismod dolor. Vestibulum sed dui. Duis lobortis hendrerit quam. Donec tempus orci ut libero. Pellentesque suscipit malesuada nisi. </p>
		
		<table border="1">
		<thead>
		<tr>
		<th>Data</th>
		<td>Data</td>
		<td>Data</td>
		<td>Data<br />2nd line</td>
		</tr>
		</thead>
		<tbody>
		<tr>
		<th>More Data</th>
		<td>More Data</td>
		<td>More Data</td>
		<td>Data<br />2nd line</td>
		</tr>
		<tr>
		<th>Data</th>
		<td>Data</td>
		<td>Data</td>
		<td>Data<br />2nd line</td>
		</tr>
		<tr>
		<th>Data</th>
		<td>Data</td>
		<td>Data</td>
		<td>Data<br />2nd line</td>
		</tr>
		</tbody>
		</table>
		
		<p>Praesent pharetra nulla in turpis. Sed ipsum nulla, sodales nec, vulputate in, scelerisque vitae, magna. Sed egestas justo nec ipsum. Nulla facilisi. Praesent sit amet pede quis metus aliquet vulputate. Donec luctus. Cras euismod tellus vel leo. Cras tellus. Fusce aliquet. Curabitur tincidunt viverra ligula. Fusce eget erat. Donec pede. Vestibulum id felis. Phasellus tincidunt ligula non pede. Morbi turpis. In vitae dui non erat placerat malesuada. Mauris adipiscing congue ante. Proin at erat. Aliquam mattis. </p>
		
		<form>
		
		<b>Textarea</b>
		<textarea name="authors" rows="5" cols="80" wrap="virtual">Quisque viverra. Etiam id libero at magna pellentesque aliquet. Nulla sit amet ipsum id enim tempus dictum. Quisque viverra. Etiam id libero at magna pellentesque aliquet. Nulla sit amet ipsum id enim tempus dictum. Quisque viverra. Etiam id libero at magna pellentesque aliquet. Nulla sit amet ipsum id enim tempus dictum. Quisque viverra. Etiam id libero at magna pellentesque aliquet. Nulla sit amet ipsum id enim tempus dictum. Quisque viverra. Etiam id libero at magna pellentesque aliquet. Nulla sit amet ipsum id enim tempus dictum. Quisque viverra. Etiam id libero at magna pellentesque aliquet. Nulla sit amet ipsum id enim tempus dictum. Quisque viverra. Etiam id libero at magna pellentesque aliquet. Nulla sit amet ipsum id enim tempus dictum. Quisque viverra. Etiam id libero at magna pellentesque aliquet. Nulla sit amet ipsum id enim tempus dictum. </textarea>
		<br /><br />
		
		<b>Select</b>
		<select size="1" name="status"><option value="A">Active</option><option value="W" >New item from auto_manager: pending validation</option><option value="I" selected="selected">Incomplete record - pending</option><option value="X" >Flagged for Deletion</option> </select> followed by text
		<br /><br />
		
		
		
		<b>Input Radio</b>
		<input type="radio" name="pre_publication" value="0" checked="checked" > No &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="pre_publication" value="1" > Yes 
		<br /><br />
		
		
		<b>Input Radio</b>
		<input type="radio" name="recommended" value="0" > No &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="recommended" value="1" > Keep &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="recommended" value="2"  checked="checked" > Choice 
		<br /><br />
		
		
		<b>Input Text</b>
		<input type="text" size="190" name="doi" value="10.1258/jrsm.100.5.211"> 
		<br /><br />
		
		<b>Input Password</b>
		<input type="password" size="40" name="password" value="secret"> 
		<br /><br />
		
		
		<input type="checkbox" name="QPC" value="ON" > Checkboxes<br>
		<input type="checkbox" name="QPA" value="ON" > Not selected<br>
		<input type="checkbox" name="QLY" value="ON" checked="checked" > Selected<br>
		<input type="checkbox" name="QLY" value="ON" disabled="disabled" > Disabled
		<br /><br />
		
		<input type="submit" name="submit" value="Submit" /> 
		<input type="image" name="submit" src="goto.gif" />
		<input type="button" name="submit" value="Button" />
		<input type="reset" name="submit" value="Reset" />
		
		</form>
		
		';
		
		
		//==============================================================
		//==============================================================
		//==============================================================
		
		include_once APPPATH . 'libraries/mpdf60/mpdf.php';
		$mpdf=new mPDF('c'); 
		
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
		
		//==============================================================
		//==============================================================
		//==============================================================
	}
}

?>