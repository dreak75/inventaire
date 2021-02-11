<?php

namespace App\Form;

use App\Entity\Containers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContainersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', null, [
                'label' => 'Descritpion'
            ])
            ->add('imageFile', \Symfony\Component\Form\Extension\Core\Type\FileType::class, [
                'required' => false,
            ])
            //->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Containers::class,
            'translation_domain' => 'forms'
        ]);
    }
}
