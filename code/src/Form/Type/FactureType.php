<?php
namespace App\Form\Type;


use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Dto\FactureDto;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', MoneyType::class, [
                'label' => 'Amount',
                'currency' => 'USD',
            ])
            ->add('dueDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Due Date',
            ])
            ->add('state', ChoiceType::class, [
                'choices' => [
                    'Pending' => 'pending',
                    'Paid' => 'paid',
                    'Overdue' => 'overdue',
                ],
                'label' => 'State',
            ])
            ->add('comments', TextareaType::class, [
                'label' => 'Comments',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FactureDto::class,
            'csrf_protection' => true,
        ]);
    }
}