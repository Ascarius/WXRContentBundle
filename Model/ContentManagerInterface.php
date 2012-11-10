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

    /**
     * Find by tag
     *
     * @param TagInterface $tag
     * @param integer|null $limit
     * @param integer|null $offset
     * @return ContentInterface[]
     */
    public function findByTag(TagInterface $tag, $limit = null, $offset = null);

    /**
     * Count by tag
     *
     * @param TagInterface $tag
     * @return integer
     */
    public function countByTag(TagInterface $tag);

}
