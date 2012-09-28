<?php

namespace WXR\ContentBundle\Model;

interface ContentManagerInterface extends WXR\CommonBundle\Model\BaseManagerInterface
{
    /**
     * @param string $name
     * @return ContentInterface|null
     */
    public function getOneByName($name);

    /**
     * Persist contents from array data
     *
     * @param array $data
     */
    public function persistFromData(array $data);
}
