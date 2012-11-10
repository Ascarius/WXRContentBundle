<?php

namespace WXR\ContentBundle\Entity;

use Doctrine\ORM\QueryBuilder;

use WXR\CommonBundle\Entity\BaseManager;
use WXR\ContentBundle\Model\ContentManagerInterface;
use WXR\ContentBundle\Model\ContentInterface;
use WXR\ContentBundle\Model\TagInterface;

class ContentManager extends BaseManager implements ContentManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function findOneByName($name)
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

            $content = $this->findOneByName($values['name']);

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
     * {@inheritDoc}
     */
    public function findByTag(TagInterface $tag, $limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->findBy(
            array('tag.id' => $tag->getId()),
            null,
            $limit,
            $offset
        );
    }

    /**
     * {@inheritDoc}
     */
    public function countByTag(TagInterface $tag)
    {
        $now = new \DateTime();

        return $this->countBy(
            array('tag.id' => $tag->getId())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getSearchableProperties()
    {
        return array(
            $this->alias.'.name',
            'tag.name',
            'tag.slug'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function buildFromClause(QueryBuilder $qb, array $criteria)
    {
        parent::buildFromClause($qb, $criteria);

        $qb
            ->leftJoin($this->alias.'.tags', 'tag')
        ;
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
