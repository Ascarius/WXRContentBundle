<?php

namespace WXR\ContentBundle\Model;

interface ContentInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set tags
     *
     * @param TagInterface $tags
     * @return ContentInterface
     */
    public function setTags($tags);

    /**
     * Get tags
     *
     * @return TagInterface
     */
    public function getTags();

    /**
     * Set name
     *
     * @param string $name
     * @return ContentInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set description
     *
     * @param string $description
     * @return ContentInterface
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set title
     *
     * @param string $title
     * @return ContentInterface
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set content
     *
     * @param string $content
     * @return ContentInterface
     */
    public function setContent($content);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set created at
     *
     * @param \DateTime $createdAt
     * @return ContactInterface
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Get created at
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updated at
     *
     * @param \DateTime $updatedAt
     * @return ContactInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Get updated at
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @return string
     */
    public function __toString();
}
