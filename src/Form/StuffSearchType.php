<?php

namespace App\Form;

use App\Entity\StuffSearch;
use App\Entity\Option;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StuffSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proprio', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, [
                'required' => false,
                'label' => false, 
                'choices' => $this->getChoices(),                
                'placeholder' => "Propriétaire"
                
            ])
            ->add('txt', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'required' => false,
                'label' => false, 
                'attr' => [
                    'placeholder' => "Nom, couleur, etc ..."
                ]
            ])
            ->add('options', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, [
                'required' => false,
                'label' => false, 
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true,
                'attr' => [
                    'class' => 'form_options_search'
                ]
            ])
       /*     ->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, [
                'label' => 'Rechercher'
            ])*/
        ;
    }
    
    private function getChoices(){
        $choices = \App\Entity\Stuffs::OWNER;
        $output = [];

        foreach($choices as $k=>$v){
            $output[$v] = $k;
        }
        return $output;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StuffSearch::class,
            'method' => 'get',
            'csrf_protection' => false // pas de token pour ce form
        ]);
    }
}
