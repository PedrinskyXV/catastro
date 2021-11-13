<?php
namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\ActividadModel;
use CodeIgniter\Controller;
use TCPDF;

class PDF extends Controller
{
    public function __construct()
    {
        $this->db = db_connect();
    }
    public function Index()
    {
        $datos['titulo'] = ucfirst('EstadodeCuenta');
        $datos['head'] = view('Template/head', $datos);
        $datos['header'] = view('Template/header');
        $datos['sidebar'] = view('Template/sidebar');
        $datos['footer'] = view('Template/footer');    
        
        $empresa = new EmpresaModel();
        $datos['empresas'] = $empresa->obtenerEmpresa()->get()->getResult("array");
        //var_dump($datos['empresas']);
        //die();
        return view('Informes/estadoCuenta', $datos);
    }
    public function informeEstadoCuenta()
    {
        $pdf = new TCPDF();
        $empresas = new EmpresaModel();
            if(!empty($_POST['sEmpresa'])){
                // echo $_POST['txtCodigo'];
                $estado = $empresas->filtro($_POST['sEmpresa']);
            }
            else if (empty($_POST['sEmpresa']) || $_POST['sEmpresa']==""){
                $estado = $empresas->obtenerEmpresaImpuestos();
            }
        $imagenHeader = base_url().'/img/apple-touch-icon.png';
        $pdf->setHeaderMargin(10);
        $pdf->setHeaderData(PDF_HEADER_LOGO, 60, 'Reporte', 'ESTADO CUENTA');
        $pdf->SetMargins(10, 45, 10);
        // Consulta a bd
        //$estado = $empresas->obtenerEmpresaImpuestos();
        helper('number');
        //var_dump($sucursal);
        $html = '<table border="1" cellpadding="3">
        <thead>
            <tr style="background-color: black; color: white; text-align:center;">
            <td>Nombre Comercial</td>
            <td>Actividad</td>
            <td>Impuesto</td>
            <td>Tipo</td>
            <td>Tasa Cobrada</td>
            </tr>
            </thead>';
            $html .= '<tbody>';
            //var_dump($estado); 
        foreach ($estado as $value) {
                //$estado = $value->estado = 1 ? 'Disponible' : 'No Disponible';
                //$deco = $value->estado = 1 ? 'none' : 'underline';
                if($value['tipo'] == 'Municipal Fijo'){
                    $tasa = number_to_currency($value['tasa'], 'USD', 'en_US', 2);
                }else{
                    $tasa = ($value['tasa'] * 100).' %';
                }
                //echo ($tasa[0]);
            $html .= '<tr>
                <td style="background-color: lightgrey; text-align:center;">' . $value['nombre_comercial'] . '</td>
                        <td>' . $value['actividad'] . '</td>
                        <td>' . $value['nombre'] . '</td>
                        <td>' . $value['tipo'] . '</td>
                        <td>' . $tasa . '</td>
                </tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        if(!empty($_POST['sEmpresa'])){
            $empresas = new EmpresaModel();
            $estado = $empresas->obtenerEmpresaTotales($_POST['sEmpresa']);
            $html .= '<br><br>';
            $html .= '<hr style="height: 10px;
            border: 0;
            box-shadow: 0 10px 10px -10px #8c8c8c inset;" />';
            $html .= '<h4 style="text-align:center;">TOTAL</h4>';
            $html .= '<br>';
            $html .= '<table border="1" cellpadding="3">
            <thead>
            <tr style="background-color: black; color: white; text-align:center;">
            <th>Monto Reportado Mensual</th>
            <th>Impuestos a pagar</th>
            </tr>
            </thead>';
            $html .= '<tbody>';
            $html .= '<tr style="text-align:center;">
                        <td>' .number_to_currency($estado[0]['montoReportado'], 'USD', 'en_US', 2). '</td>
                        <td>' .number_to_currency($estado[0]['TOTAL'], 'USD', 'en_US', 2) . '</td>
                    </tr>';
                    $html .= '</tbody>';
        $html .= '</table>';
        }
        $pdf->AddPage();
        $pdf->writeHTML($html);

// ---------------------------------------------------------

//Close and output PDF document
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('estado-de-cuenta.pdf', 'I');
        
    }

    public function informeTributoporRubro()
    {
        $pdf = new TCPDF();
        $actividad = new ActividadModel();
        $imagenHeader = base_url().'/img/apple-touch-icon.png';
        $pdf->setHeaderMargin(10);
        $pdf->setHeaderData(PDF_HEADER_LOGO, 60, 'Reporte', 'Impuesto por Rubro');
        $pdf->SetMargins(10, 45, 10);
        // Consulta a bd
        $estado = $actividad->obtenerTributoActividad();
        helper('number');
        //var_dump($sucursal);
        $html = '<table border="1" cellpadding="3">
        <thead>
            <tr style="background-color: black; color: white; text-align:center;">
            <td>Rubro</td>
            <td>Actividad</td>
            <td>Impuesto</td>
            <td>Tasa</td>
            </tr>
            </thead>';
            $html .= '<tbody>';
            //var_dump($estado); 
        foreach ($estado as $value) {
                if($value['tipo'] == 'Municipal Fijo'){
                $tasa = number_to_currency($value['tasa'], 'USD', 'en_US', 2);
                }else{
                    $tasa = ($value['tasa'] * 100).' %';
                }
                //$estado = $value->estado = 1 ? 'Disponible' : 'No Disponible';
                //$deco = $value->estado = 1 ? 'none' : 'underline';
                //echo ($tasa[0]);
            $html .= '<tr>
                <td style="background-color: lightgrey; text-align:center;">' . $value['nombre'] . '</td>
                        <td>' . $value['actividad'] . '</td>
                        <td>' . $value['tributo'] . '</td>
                        <td>' . $tasa . '</td>
                </tr>';
        }
        
        $html .= '</tbody>';
        $html .= '</table>';
        $pdf->AddPage();
        $pdf->writeHTML($html);

// ---------------------------------------------------------

//Close and output PDF document
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('listado-de-impuestos.pdf', 'I');
        
    }
    
}
