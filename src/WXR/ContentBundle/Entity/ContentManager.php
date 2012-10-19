<?php

namespace WXR\ContentBundle\Entity;

use WXR\CommonBundle\Entity\BaseManager;
use WXR\ContentBundle\Model\ContentManagerInterface;
use WXR\ContentBundle\Model\ContentInterface;

class ContentManager extends BaseManager implements ContentManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOneByName($name)
    {
        return $this->findOneBy(array('name' => $name));
    }

    /**
     * {@inheritDoc}
     */
    public function persistFromData(array $data)
    {
        if (!$data) {
            return;
        }

        $toPersist = array();

        foreach ($data as $values) {
            if (!isset($values['name'])) {
                throw new \InvalidArgumentException('Data values require "name" key');
            }

            $content = $this->getOneByName($values['name']);

            if (null === $content) {
                $content = $this->create();
                $this->setValues($content, $values);
                $toPersist[] = $content;
            }
        }

        if ($toPersist) {
            $this->persist($toPersist);
        }
    }

    /**
     * Set content values
     *
     * @param ContentInterface $content
     * @param array|object $values
     */
    protected function setValues(ContentInterface $content, $values)
    {
        $content->setName($values['name']);
        isset($values['description']) && $content->setDescription($values['description']);
        isset($values['title']) && $content->setDescription($values['title']);
        isset($values['content']) && $content->setDescription($values['content']);
    }
}
