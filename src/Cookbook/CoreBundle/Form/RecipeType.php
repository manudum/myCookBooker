<?php

namespace Cookbook\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
            ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouveau plat', 'style' => 'width:100%;'),
            ))
            
            ->add('category', 'entity', array(
                    'class' => 'CookbookCoreBundle:CategoryRecipe',
                    'query_builder' => function(EntityRepository $repository) use($options){
                    return $repository->createQueryBuilder('q')
                        ->where('q.people = '.$options['user_id'])
                        ->orderBy('q.showorder');
                    },
                    'empty_data'  => null,
                    'required' => true,
                    'expanded' => true, 
                ))
            
        ;
    }

    public function getName()
    {
        return 'cookbook_corebundle_recipetype';
    }
    
     public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cookbook\CoreBundle\Entity\Recipe',
            'user_id'         => null,
        ));
    }
}
