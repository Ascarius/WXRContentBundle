<?php

namespace WXR\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

abstract class BaseContent extends \WXR\ContentBundle\Model\Content
{
    public function __construct()
    {
        parent::__construct();
        $this->tags = new ArrayCollection();
    }

    /**
     * Update updatedAt
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}
