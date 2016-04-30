<?php
namespace AppBundle\Utils;

class Association
{
    private function arrayFromPdf($pdfs) {
        $arrayPdf = [];

        foreach ($pdfs as $pdfEntity) {
            $pdf = $pdfEntity->getPdf();
            if ($pdf) {
                array_push($arrayPdf, $pdf);
            }
        }

        return $arrayPdf;
    }

    public function arrayFromRepository($repository) {
        $pdf = $repository->findAll();
        $arrayPdf= $this->arrayFromPdf($pdf);

        return $arrayPdf;
    }
}