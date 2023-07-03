<?php

namespace App\Form\LogicBroker;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\LogicBrokerCustomer as Customer;

class CustomerType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder->add('senderCompanyId')
                ->add('customerNumber')
                ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults(array(
            'data_class' => Customer::class,
        ));
    }

}
