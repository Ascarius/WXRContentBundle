<?php

namespace WXR\ContentBundle\Model;

interface ContentInterface
{
    public function getId();

    public function setName($name);

    public function getName();

    public function setDescription($description);

    public function getDescription();

    public function setTitle($title);

    public function getTitle();

    public function setContent($content);

    public function getContent();

    public function __toString();
}
