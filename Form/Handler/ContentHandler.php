<?php

namespace WXR\ContentBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

use WXR\ContentBundle\Model\ContentInterface;
use WXR\ContentBundle\Model\ContentManagerInterface;

class ContentHandler
{
    protected $request;

    protected $form;

    protected $contentManager;

    public function __construct(Request $request, FormInterface $form, ContentManagerInterface $contentManager)
    {
        $this->request = $request;
        $this->form = $form;
        $this->contentManager = $contentManager;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function process(ContentInterface $content)
    {
        $this->form->setData($content);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($content);

                return true;
            }
        }

        return false;
    }

    protected function onSuccess(ContentInterface $content)
    {
        $this->contentManager->persist($content);
    }
}
