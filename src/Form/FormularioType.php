<?php

namespace App\Form;

use App\Entity\Formulario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;

class FormularioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['maxlength' => 30]
            ])
            ->add('paternalName', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['maxlength' => 30]
            ])
            ->add('maternalName', TextType::class, [
                'attr' => ['maxlength' => 30]
            ])
            ->add('street', TextType::class, [
                'constraints' => [new NotBlank()],
                'attr' => ['maxlength' => 40]
            ])
            ->add('phone', TextType::class, ['constraints' => [
                new NotBlank(),
                new Regex(['pattern' => '/^\d{10}$/', 'message' => 'Debe contener 10 dígitos numéricos.'])
            ]])
            ->add('rfc', TextType::class, ['constraints' => [
                new NotBlank(),
                new Regex(['pattern' => '/^.{13}$/', 'message' => 'Debe contener 13 caracteres.'])
            ]])
            ->add('state', TextType::class)
            ->add('municipality', TextType::class)
            ->add('postalCode', TextType::class, ['constraints' => [
                new Regex(['pattern' => '/^\d{5}$/', 'message' => 'Debe contener 5 dígitos.'])
            ]])
            ->add('companyName', TextType::class, ['constraints' => [new NotBlank()]])
            ->add('companyNumber', TextType::class, ['constraints' => [new NotBlank()]])
            ->add('imagesINE', FileType::class)
            ->add('imagesStreet', FileType::class, ['constraints' => [
                new File(['mimeTypes' => ['application/pdf', 'image/png', 'image/jpeg'], 'mimeTypesMessage' => 'archivos'])
            ]])
            ->add('imagesNomina', FileType::class, ['constraints' => [
                new File(['mimeTypes' => ['application/pdf', 'image/png', 'image/jpeg'], 'mimeTypesMessage' => 'archivos'])
            ]])
            ->add('requestedAmount', MoneyType::class, [
                'currency' => 'MXN',
                'constraints' => [
                    new Regex(['pattern' => '/^\d+(\.\d{1,2})?$/', 'message' => 'Debe ser un número válido.'])
                ]
            ])
            ->add('bank', TextType::class)
            ->add('interbank', TextType::class, ['constraints' => [
                new Regex(['pattern' => '/^\d+$/', 'message' => 'Debe contener solo números.'])
            ]])
            ->add('submit', SubmitType::class, ['label' => 'REGRESAR']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Formulario::class]);
    }
}
