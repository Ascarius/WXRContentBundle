<?php

namespace WXR\Bundle\ContentBundle\Controller;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContentAdminController extends Controller
{
    public function listAction()
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedHttpException();
        }

        $contents = $this->getContentManager()->findAll();

        return $this->render('WXRContentBundle:Admin/Content:list.html.twig', compact('contents'));
    }

    public function addAction()
    {
        if (!$this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            throw new AccessDeniedHttpException();
        }

        $content = $this->getContentManager()->create();

        $handler = $this->get('wxr_content.content.form.handler');
        $form = $handler->getForm();

        if ($handler->process($content)) {
            $this->get('session')->setFlash('success', 'wxr_content.content.added');

            return $this->redirect($this->generateUrl('wxr_content_content_list'));
        }

        return $this->render('WXRContentBundle:Admin/Content:add.html.twig', array(
            'content' => $content,
            'form' => $form->createView()
        ));
    }

    public function editAction($id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedHttpException();
        }

        $content = $this->getContentManager()->find($id);

        if (null === $content) {
            throw $this->createNotFoundException('wxr_content.content.not_found');
        }

        $handler = $this->get('wxr_content.content.form.handler');
        $form = $handler->getForm();

        if ($handler->process($content)) {
            $this->get('session')->setFlash('success', 'wxr_content.content.updated');

            return $this->redirect($this->generateUrl('wxr_content_content_list'));
        }

        return $this->render('WXRContentBundle:Admin/Content:edit.html.twig', array(
            'content' => $content,
            'form' => $form->createView()
        ));
    }

    public function deleteAction($id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            throw new AccessDeniedHttpException();
        }

        $content = $this->getContentManager()->find($id);

        if ($this->getRequest()->query->get('confirm')) {

            if (null === $content) {
                throw $this->createNotFoundException('wxr_content.content.not_found');
            }

            $this->getContentManager()->removeContent($content);
            $this->get('session')->setFlash('success', 'wxr_content.content.deleted');

            return $this->redirect($this->generateUrl('wxr_content_content_list'));
        }

        return $this->render('WXRContentBundle:Admin/Content:delete.html.twig', compact('content'));
    }

    /**
     * @return WXR\Bundle\ContentBundle\Model\ContentManagerInterface
     */
    protected function getContentManager()
    {
        return $this->get('wxr_content.content.manager');
    }
}
