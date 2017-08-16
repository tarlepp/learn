<?php

namespace Home\PageBundle\Controller;

use Home\PageBundle\Entity\Box;
use Home\PageBundle\Handler\BoxHandler;
use Home\PageBundle\Repository\BoxRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;

/**
 * Box controller.
 *
 * @Route(path="/box")
 */
class BoxController
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * BoxController constructor.
     *
     * @param Router            $router
     * @param \Twig_Environment $twig
     */
    public function __construct(Router $router, \Twig_Environment $twig)
    {
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * Lists all box entities.
     *
     * @Route("/", name="box_index")
     *
     * @Method("GET")
     *
     * @param BoxRepository $repository
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     * @throws \Twig_Error_Syntax
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Loader
     */
    public function indexAction(BoxRepository $repository)
    {
        $boxes = $repository->findAll();

        $content = $this->twig->render('box/index.html.twig', array(
            'boxes' => $boxes,
        ));

        return new Response($content);
    }

    /**
     * Creates a new box entity.
     *
     * @Route("/new", name="box_new")
     * @Method({"GET", "POST"})
     *
     * @param BoxHandler $boxHandler
     *
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @throws \Symfony\Component\Routing\Exception\RouteNotFoundException
     * @throws \Symfony\Component\Routing\Exception\MissingMandatoryParametersException
     * @throws \Symfony\Component\Routing\Exception\InvalidParameterException
     * @throws \InvalidArgumentException
     * @throws \Twig_Error_Syntax
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Loader
     */
    public function newAction(BoxHandler $boxHandler)
    {
        // Is this needed at all ? don't see any real references to it...
        $box = new Box();

        // And how is $box used in BoxHandler ? - I don't see any references to it...
        if ($boxHandler->process()) {
            // These you should do in the BoxHandler - it already has that repository and save method
            // $em->persist($box);
            // $em->flush();

            // How do you think that $box->getId() will have some magical value in this point ? - you're not passing it to handler - so what will change that value ?
            return new RedirectResponse($this->router->generate('box_show', array('id' => $box->getId())), 201);
        }

        $content = $this->twig->render('box/new.html.twig', array(
            // 'box' isn't used at all in that template...
            'box' => $box,
            'form' => $boxHandler->getForm()->createView(),
        ));

        return new Response($content);
    }

    // And all below this should be refactor
    // I highly recommend that you start to use PhpStorm + Php Inspections (EA Extended) plugin for PhpStorm + Symfony Plugin plugin for PhpStorm

    /**
     * Finds and displays a box entity.
     *
     * @Route("/{id}", name="box_show")
     *
     * @Method("GET")
     */
    public function showAction(Box $box)
    {
        $deleteForm = $this->createDeleteForm($box);

        return $this->render('box/show.html.twig', array(
            'box' => $box,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing box entity.
     *
     * @Route("/{id}/edit", name="box_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Box $box)
    {
        $deleteForm = $this->createDeleteForm($box);
        $editForm = $this->createForm('Home\PageBundle\Form\BoxType', $box);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('box_edit', array('id' => $box->getId()));
        }

        return $this->render('box/edit.html.twig', array(
            'box' => $box,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a box entity.
     *
     * @Route("/{id}", name="box_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Box $box)
    {
        $form = $this->createDeleteForm($box);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($box);
            $em->flush();
        }

        return $this->redirectToRoute('box_index');
    }

    /**
     * Creates a form to delete a box entity.
     *
     * @param Box $box The box entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Box $box)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('box_delete', array('id' => $box->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
