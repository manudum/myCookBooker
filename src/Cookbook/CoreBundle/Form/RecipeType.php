<?php

namespace Cookbook\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
       $builder
            ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouveau plat', 'style' => 'width:100%;'),
            ))
            ->add('type', 'entity', array(
                    'class' => 'CookbookCoreBundle:TypeRecipe',
                    'query_builder' => function(EntityRepository $repository) use($options) {
                    return $repository->createQueryBuilder('q')
                        ->where('q.people = '.$options['user_id'])
                        ->orderBy('q.name');
                    },
                    'empty_value' => 'Choisir une valeur',
                    'required' => false, 
                    'expanded' => true, 
                ))
            ->add('category', 'entity', array(
                    'class' => 'CookbookCoreBundle:CategoryRecipe',
                    'query_builder' => function(EntityRepository $repository) use($options){
                    return $repository->createQueryBuilder('q')
                        ->where('q.people = '.$options['user_id'])
                        ->orderBy('q.name');
                    },
                    'empty_value' => 'Choisir une valeur',
                    'required' => true,
                    'expanded' => true, 
                ))
            ->add('format', 'entity', array(
                    'class' => 'CookbookCoreBundle:FormatRecipe',
                    'query_builder' => function(EntityRepository $repository) use($options){
                    return $repository->createQueryBuilder('q')
                        ->where('q.people = '.$options['user_id'])
                        ->orderBy('q.name');
                    },
                    'empty_value' => 'Choisir une valeur',
                    'required' => false,
                    'expanded' => true, 
                ))
            ->add('description', 'textarea', array('required' => false, "attr" => array("cols" => "60", "rows" => "10")))
        ;
    }

    public function getName()
    {
        return 'cookbook_corebundle_recipetype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cookbook\CoreBundle\Entity\Recipe',
            'user_id'         => null,
        );
    }
}
