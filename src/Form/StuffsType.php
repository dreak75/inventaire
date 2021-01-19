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
