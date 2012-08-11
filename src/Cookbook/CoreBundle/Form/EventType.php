<?php

namespace Cookbook\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class EventType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('date')
            ->add('description', 'textarea', array('required' => false,))
            ->add('friends', 'entity', array(
                'class' => 'CookbookCoreBundle:Friend',
                'query_builder' => function(EntityRepository $repository) {
                return $repository->createQueryBuilder('q')
                    ->where('q.people = 1')
                    ->orderBy('q.name');
                },
                'empty_value' => 'Choose an option',
                'required' => false,
                'multiple' => true,
            ))
            ->add('recipes', 'entity', array(
                'class' => 'CookbookCoreBundle:Recipe',
                'query_builder' => function(EntityRepository $repository) {
                return $repository->createQueryBuilder('q')
                    ->where('q.people = 1')
                    ->orderBy('q.name');
                },
                'empty_value' => 'Choose an option',
                'required' => false,
                'multiple' => true,
            ))
        ;
    }

    public function getName()
    {
        return 'cookbook_corebundle_recipetype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cookbook\CoreBundle\Entity\Event',
        );
    }
}
