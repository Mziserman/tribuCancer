<?php
namespace AppBundle\Utils;

class Event
{
    private function arrayFromPdf($pdfs) {
        $arrayPdf = [];
        $i = 0;

        foreach ($pdfs as $pdf) {
            $arrayPdf[$i]["name"] = $pdf->getId();
            $arrayPdf[$i]["name"] = $pdf->getName();
            $arrayPdf[$i]["color"] = $pdf->getColor();
            $arrayPdf[$i]["file"] = $pdf->getFile();

            $i++;
        }

        return $arrayPdf;
    }

    private function arrayFromEvent($events) {
        $arrayEvent = [];
        $i = 0;

        foreach ($events as $event) {
            $arrayEvent[$i]["id"] = $event->getId();
            $arrayEvent[$i]["name"] = $event->getName();
            $arrayEvent[$i]["short_desc"] = $event->getShortDesc();
            $arrayEvent[$i]["body"] = $event->getBody();
            $arrayEvent[$i]["thumbnail"] = $event->getThumbnail();
            $arrayEvent[$i]["image"] = [
                $event->getImage1(),
                $event->getImage2(),
                $event->getImage3()
            ];
            $arrayEvent[$i]["flickr"] = $event->getFlickr();
            $arrayEvent[$i]["youtube"] = $event->getYoutube();
            $arrayEvent[$i]["inscription"] = $event->getInscription();
            $arrayEvent[$i]["position"] = $event->getPosition();
            $arrayEvent[$i]["pdf"] = $this->arrayFromPdf($event->getPdf());

            $i++;
        }

        return $arrayEvent;
    }

    public function arrayFromRepository($repository) {
        $event = $repository->findBy(array(), null, 5);
        $arrayEvent = $this->arrayFromEvent($event);

        return $arrayEvent;
    }
}