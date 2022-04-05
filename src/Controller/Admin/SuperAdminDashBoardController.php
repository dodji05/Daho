<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class SuperAdminDashBoardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard_index")
     */
    public function index()
    {
        return $this->render('admin/admin_base.html.twig');
    }
}