<?php

namespace Home\PageBundle\Handler;

use Home\PageBundle\Repository\BoxRepository;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RequestStack;

class BoxHandler
{
    /**
     * @var Form
     */
    protected $form;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var BoxRepository
     */
    protected $repository;

    /**
     * BoxHandler constructor.
     *
     * @param Form          $form
     * @param RequestStack  $requestStack
     * @param BoxRepository $repository
     */
    public function __construct(Form $form, RequestStack $requestStack, BoxRepository $repository)
    {
        $this->form = $form;
        $this->requestStack = $requestStack;
        $this->repository = $repository;
    }

    /**
     * @return bool
     */
    public function process()
    {
        $this->form->handleRequest($this->requestStack->getCurrentRequest());

        // Imho "process" will do whole the process not just handle request and see if form is submitted and valid...
        return $this->form->isSubmitted() && $this->form->isValid();
    }

    public function onSuccess()
    {
        // Where does this '$box' came from? ?
        $this->repository->save($box);
    }

    public function getForm()
    {
        return $this->form;
    }
}
