<?php

namespace App\Form;

use App\Entity\Zamowienie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ZamowienieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numer_trackingowy', TextType::class,
            ['constraints' => [
                new Regex('/[G][K][0-9]{9}/')
            ]])
            ->add('nadawca')
            ->add('odbiorca')
            ->add('zleceniodawca')
            ->add('telefon', TextType::class,
            ['constraints' => [
                new Regex('/^\+?[0-9]{2}([0-9]{7}|[0-9]{9})$/i')
            ]])
            ->add('sub_nadawca')
            ->add('sub_odbiorca')
            ->add('sub_zleceniodawca')
            ->add('status')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Zamowienie::class,
        ]);
    }
}
