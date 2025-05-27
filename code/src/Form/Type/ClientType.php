<?php
namespace App\Form\Type;

use App\Dto\ClientDto;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Client fistname',
                'attr' => ['placeholder' => 'Enter client firstname'],
            ])->add('lastname', TextType::class, [
                'label' => 'Client lastname',
                'attr' => ['placeholder' => 'Enter client lastname'],
            ])->add('Phone', TextType::class, [
                'label' => 'Client phone',
                'attr' => ['placeholder' => 'Enter client phone number'],
            ])->add('address', TextType::class, [
                'label' => 'Client address',
                'attr' => ['placeholder' => 'Enter client address'],
            ])->add('city', TextType::class, [
                'label' => 'Client city',
                'attr' => ['placeholder' => 'Enter client city'],
            ])->add('country', TextType::class, [
                'label' => 'Client country',
                'attr' => ['placeholder' => 'Enter client country'],
            ]); 
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClientDto::class,
            'csrf_protection' => true,
        ]);
    }
}