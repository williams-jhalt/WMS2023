<?php

namespace App\Form;

use App\Entity\ProductDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductDetailType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {

        $builder->add('name')
                ->add('description', TextareaType::class)
                ->add('htmlDescription', TextareaType::class, ['required' => false])
                ->add('brand', TextType::class, ['required' => false])
                ->add('category', TextType::class, ['required' => false])
                ->add('packageHeight', TextType::class, ['required' => false])
                ->add('packageLength', TextType::class, ['required' => false])
                ->add('packageWidth', TextType::class, ['required' => false])
                ->add('dimUnit', ChoiceType::class, [
                    'choices' => [
                        'in' => 'in',
                        'cm' => 'cm',
                        'mm' => 'mm'
                    ],
                    'required' => false
                ])
                ->add('packageWeight', TextType::class, ['required' => false])
                ->add('weightUnit', ChoiceType::class, [
                    'choices' => [
                        'lbs' => 'lbs',
                        'oz' => 'oz',
                        'kg' => 'kg',
                        'g' => 'g'
                    ],
                    'required' => false
                ])
                ->add('msrp', TextType::class, ['required' => false])
                ->add('mapPrice', TextType::class, ['required' => false])
                ->add('attributes', CollectionType::class, [
                    'label' => false,
                    'entry_type' => ProductAttributeType::class,
                    'entry_options' => ['label' => false],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => ProductDetail::class
        ]);
    }

}
