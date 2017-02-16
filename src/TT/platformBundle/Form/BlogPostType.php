<?php

namespace TT\platformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BlogPostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'label.title'))
            ->add('content', null, array('attr' => array('class' => 'ckeditor'), 'label' => 'label.content'))
            ->add('author', null, array('label' => 'label.author'))
            ->add('categorie', ChoiceType::class, array(
                'choices' => array(
                    'Tournois' => 'tournois',
                    'Stages' => 'stages',
                    'Actualites' => 'actualites'
            )))
            
        ;

    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TT\platformBundle\Entity\BlogPost'
        ));
    }
}
