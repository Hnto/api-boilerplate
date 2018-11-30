<?php

namespace App\Controller;

use App\Entity\Website;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebsiteController extends Controller
{

    /**
     * @param int $id
     *
     * @return array
     */
    public function getPages(int $id)
    {
        /** @var Website $website */
        $website = $this->getDoctrine()
            ->getRepository(Website::class)
            ->find($id);

        return $website->getPages()->toArray();
    }
}
