<?php

/*
  Created on : 13/03/2019, 15:29:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
  Lib        : Dompdf
  Program    : Print to PDF
 */


defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

if (!function_exists('printToPdf')) {

    /**
     * Gera PDF de um HTML especifico passando a URL como parâmetro
     *
     * @param type $_loadHtml           Código HTML do relatório
     * @param type $_setPaper           Tipo do Papel - A4, letter, legal, ...
     * @param type $_pageOrientation    Orientação do papel - landscape ou portrait 
     */
    function printToPdf($_loadHtml, $_setPaper = 'A4', $_pageOrientation = '') {

        /* instantiate and use the dompdf class */
        $dompdf = new Dompdf;

        $dompdf->set_option('defaultFont', 'Courier');
        $dompdf->set_option('isHtml5ParserEnabled', true);

        $dompdf->loadHtml($_loadHtml);

        /* (Optional) Setup the paper size and orientation */
        $dompdf->setPaper($_setPaper, $_pageOrientation);

        /* Render the HTML0| as PDF */
        $dompdf->render();

        /* Output the generated PDF to Browser */
        $dompdf->stream(
                time() . ".pdf", array("Attachment" => false)
        );
    }

}
