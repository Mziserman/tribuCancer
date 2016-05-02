<?php
namespace AppBundle\Utils;

use Cocur\Slugify\Slugify;

class Slug
{
    public function setSlugForEntities($entities, $em) {
        $slugify = new Slugify();

        for ($i = 0; $i < count($entities); $i++) {
            $entity = $entities[$i];
            $name = $entity->getName();

            $entity->setSlug($slugify->slugify($name));
            $em->persist($entity);
        }
        $em->flush();

        return $entities;
    }
}

