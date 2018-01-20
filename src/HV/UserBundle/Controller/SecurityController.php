<?php

namespace HV\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
  public function loginAction(Request $request)
  {
    if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
    {
      return $this->redirectToRoute('hv_blog_homepage');
    }
    $authenticationUtils=$this->get('security.authentication_utils');
    return $this->render('HVUserBundle:Security:login.html.twig',array('last_username'=>$authenticationUtils->getLastUsername(),'error'=>$authenticationUtils->getLastAuthenticationError()));
  }
}
