<?php

namespace WXR\ContentBundle\Model;

use WXR\CommonBundle\Model\BaseManagerInterface;

interface ContentManagerInterface extends BaseManagerInterface
{
    /**
     * @param string $name
     * @return ContentInterface|null
     */
    public function findOneByName($name);

    /**
     * Persist contents from array data
     *
     * @param array $data
     */
    public function persistFromData(array $data);
}
