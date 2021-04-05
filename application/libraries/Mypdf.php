<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('assets/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Mypdf
{

    protected $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
    }
    public function generate($view, $data = [], $namaFile = 'laporan', $ukuranKertas = 'A4', $tampilanKertas = 'potrait')
    {
        $options = new Options();
        $options->setChroot(FCPATH);
        $options->setDefaultFont('courier');

        $dompdf = new Dompdf([
            'enable_remote' => true
        ]);
        $html = $this->ci->load->view($view, $data, TRUE);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($ukuranKertas, $tampilanKertas);

        // Render the HTML as PDF
        $dompdf->render();
        // ob_clean();

		if(ob_get_length() > 0) {
			ob_clean();
		}
        $dompdf->stream($namaFile . ".pdf", array("Attachment" => TRUE));
    }
}
