<?php 
namespace App\Controllers;

use App\Controllers\BaseController;

//require_once base_url('vendor/autoload.php)';
class Createpdf extends BaseController{

	public function index(){
		$this->data['title'] = 'PDF';
		$mpdf = new \mpdf\mpdf();
        $html = $this->load->view('pdf/create',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
        $mpdf->Output('create.pdf','D'); 
		//$this->render_template('pdf/create',$this->data);
	}
	public function convertHTMLToPdf(){
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('pdf/create'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }    
}