<?php
namespace AppBundle\Utils;

class Service
{
    private function arrayFromPdf($pdfs) {
        $arrayPdf = [];
        $i = 0;

        foreach ($pdfs as $pdf) {
            $arrayPdf[$i]["name"] = $pdf->getName();
            $arrayPdf[$i]["color"] = $pdf->getColor();
            $arrayPdf[$i]["file"] = $pdf->getFile();

            $i++;
        }

        return $arrayPdf;
    }
    
    private function arrayFromService($services) {
        $arrayService = [];
        $i = 0;

        foreach ($services as $service) {
            $arrayService[$i]["name"] = $service->getName();
            $arrayService[$i]["link"] = $service->getLink();
            $arrayService[$i]["short_desc"] = $service->getShortDesc();
            $arrayService[$i]["body"] = $service->getBody();
            $arrayService[$i]["image"] = $service->getImage();
            $arrayService[$i]["icon"] = $service->getIcon();
            $arrayService[$i]["position"] = $service->getPosition();
            $arrayService[$i]["pdf"] = $this->arrayFromPdf($service->getPdf());

            $i++;
        }

        return $arrayService;
    }
    
    public function arrayFromRepository($repository) {
        $service = $repository->findBy(array(), null, 5);
        $arrayService = $this->arrayFromService($service);
        return $arrayService;
    }
    
}