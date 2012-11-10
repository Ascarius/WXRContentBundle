<?php

namespace WXR\ContentBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

abstract class ContentAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group_general')
                ->add('name')
                ->add('description', null, array('required' => false))
                ->add('title', null, array('required' => false))
                ->add('content', null, array(
                    'required' => false,
                    'attr' => array('data-wysiwyg' => true, 'rows' => 10)
                ))
            ->end()
            ->with('form.group_tags')
                ->add('tags', 'sonata_type_model', array(
                    'class' => 'WXR\\ContentBundle\\Entity\\Tag',
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ))
            ->end()
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('description')
            ->add('title')
            ->add('content')
            ->add('tags')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('tags')
        ;
    }
}
