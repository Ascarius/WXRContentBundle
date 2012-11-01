<?php

namespace WXR\ContentBundle\Entity;

abstract class BaseContent extends \WXR\ContentBundle\Model\Content
{
    /**
     * Update updatedAt
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}
