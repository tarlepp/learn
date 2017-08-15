<?php

namespace Home\PageBundle\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RequestStack;


class BoxHandler
{
      protected $form;
      protected $request;

      public function __construct(Form $form, RequestStack $requestStack)
      {
          $this->form = $form;
          $this->request = $requestStack;
      }
 
      public function process()
      {
             $this->form->handleRequest($this->request);
          
              if ($this->form->isSubmitted() && $this->form->isValid())
          {
               return true;
          }
          
          return false;
      }
      
            public function onsucess()
      {
            $em = $this->getDoctrine()->getManager();
            $em->persist($box);
            $em->flush();
      }
      
      public function getForm()
      {
          return $this->form;
      }
}
