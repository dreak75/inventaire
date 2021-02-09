<?php

namespace App\Form;

use App\Entity\Stuffs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class StuffsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('property', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
            ->add('options', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, [
                'class' => \App\Entity\Option::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false
            ])
            ->add('container', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, [
                'class' => \App\Entity\Containers::class,
                'choice_label' => 'title',
                'multiple' => false,
                'required' => false,
            ])
        ;
    }

    private function getChoices(){
        $choices = Stuffs::OWNER;
        $output = [];

        foreach($choices as $k=>$v){
            $output[$v] = $k;
        }
        return $output;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stuffs::class,
            'translation_domain' => 'forms'  // traduction des champs
        ]);
    }
}
