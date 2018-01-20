<?php

namespace HVBlogBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HVBlogBundle\Entity\Billet;
use HVBlogBundle\Form\BilletType;
use HVBlogBundle\Form\BilletEditType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;



class MainController extends Controller
{
  public function indexAction($page)
  {
    //if($page<1){//throw $this->createNotFoundException('La page '.$page.'n existe pas');}
    $nbPerPage=5;
    $listeBillets=$this->getDoctrine()->getManager()->getRepository('HVBlogBundle:Billet')->getBillets($page,$nbPerPage);
    $nbTotPages=ceil(count($listeBillets)/$nbPerPage);
    //if($page>$nbTotPages){//throw $this->createNotFoundException('La page '.$page.'n existe pas');}
    return $this->render('HVBlogBundle:Main:index.html.twig',array('listebillets'=>$listeBillets,'nbTotPages'=>$nbTotPages,'page'=>$page));
  }

  public function addAction(Request $request)
  {
    //Si on a deja rempli le form ou la page de creation du billet
    if(!$this->get('security.authorization_checker')->isGranted('ROLE_AUTEUR'))
    {
      throw new AccessDeniedException('Acces limité aux auteurs');
    }
    $billet=new Billet();
    $billet->setDate(new \Datetime());
    $form=$this->createForm(BilletType::class,$billet);
    if($request->isMethod('POST') && $form->handleRequest($request)->isValid() )
    {
      $em=$this->getDoctrine()->getManager();
      $em->persist($billet);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice','Billet bien enregistré');
      return $this->redirectToRoute('hv_blog_homepage');
    }
    //Si on arrive sur la page de add de billet pour la premiere fois
    return $this->render('HVBlogBundle:Main:add.html.twig',array('form'=>$form->createView()));
  }

  public function viewAction($id)
  {
    $billet=$this->getDoctrine()->getManager()->getRepository('HVBlogBundle:Billet')->find($id);
    return $this->render('HVBlogBundle:Main:view.html.twig',array('billet'=>$billet));
  }

  public function editAction($id,Request $request)
  {
    $em=$this->getDoctrine()->getManager();
    $billet=$em->getRepository('HVBlogBundle:Billet')->find($id);
    if($billet==null)
    {
      throw new NotFoundHttpException("l annonce demandée n existe pas");
    }
    $form=$this->createForm(BilletEditType::class,$billet);
    //Si on a deja rempli le form ou la page de modification du billet
    if($request->isMethod('POST') && $form->handleRequest($request)->isValid() )
    {
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice','Billet bien modifié');
      return $this->redirectToRoute('hv_blog_homepage');
    }
    //Si on arrive sur la page de edit de billet pour la premiere fois
    return $this->render('HVBlogBundle:Main:edit.html.twig',array('billet'=>$billet,'form'=>$form->createView()));
  }

  public function deleteAction($id,Request $request)
  {
    $em=$this->getDoctrine()->getManager();
    $billet=$em->getRepository('HVBlogBundle:Billet')->find($id);
    if($billet==null)
    {
      throw new NotFoundHttpException("l annonce demandée n existe pas");
    }
    $form=$this->get('form.factory')->create();
    if($request->isMethod('POST') && $form->handleRequest($request)->isValid() )
    {
      $em->remove($billet);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice','Billet bien modifié');
      return $this->redirectToRoute('hv_blog_homepage');
    }
    return $this->render('HVBlogBundle:Main:delete.html.twig',array('billet'=>$billet,'form'=>$form->createView()));
  }

}
