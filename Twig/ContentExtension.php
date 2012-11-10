<?php

namespace WXR\ContentBundle\Twig;

use WXR\ContentBundle\Model\ContentManagerInterface;
use WXR\ContentBundle\Model\ContentInterface;

class ContentExtension extends \Twig_Extension
{
    /**
     * @var ContentManagerInterface
     */
    protected $contentManager;

    /**
     * @var string
     */
    protected $defaultTemplate;

    protected $container;

    public function __construct(ContentManagerInterface $contentManager, $defaultTemplate, $container)
    {
        $this->contentManager = $contentManager;
        $this->defaultTemplate = $defaultTemplate;
        $this->container = $container;

    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'wxr_content';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'wxr_content_render' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html')))
        );
    }

    /**
     * Render content
     *
     * @param ContentInterface|ContentInterface[]|array|string|null $content
     * @param string|null $template
     * @return string
     */
    public function render($contents, $template = null)
    {
        if (!$contents) {
            return '';
        }

        if (null === $template) {

            if (!$this->defaultTemplate) {
                throw new \InvalidArgumentException('No layout provided and no default set');
            }

            $template = $this->defaultTemplate;
        }

        if ($contents instanceof ContentInterface) {
            $contents = array($contents);
        } elseif(!is_array($contents) || !reset($contents) instanceof ContentInterface) {
            $criteria = null;

            if (is_array($contents)) {
                $criteria = $contents;
            } elseif (is_string($contents)) {
                $criteria = array('_search' => $contents);
            } else {
                throw new \InvalidArgumentException(sprintf('Invalid argument for "contents"; must be ContentInterface|ContentInterface[]|array|string|null; "%s" given'), is_object($contents) ? get_class($contents) : gettype($contents));
            }

            $contents = $this->contentManager->findBy($criteria);
        }

        if (!$contents) {
            return '';
        }

        return $this->container->get('templating')->render($template, compact('contents'));
    }
}
