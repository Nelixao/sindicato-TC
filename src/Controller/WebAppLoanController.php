<?php

namespace App\Controller;
use App\Entity\Formulario;
use App\Entity\Company;
use App\Entity\Customer;
use App\Entity\User;
use App\Entity\Application;
use App\Entity\Document;
use App\Form\FormularioType;
use Doctrine\DBAL\Exception as DoctrineException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class WebAppLoanController extends AbstractController
{
    #[Route('/', name: 'indexapp')]
    public function index(): Response
    {
        return $this->render('web_app_loan/index.html.twig', [
            'controller_name' => 'WebAppLoanController',
        ]);
    }



    #[Route('/forms', name: 'forms')]
    public function forms(Request $request,EntityManagerInterface $entityManager): Response
    {

     //  $form = $this->createFormBuilder()
        $Formulario=new Formulario();
        $form = $this->createForm(FormularioType::class, $Formulario);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
          dump('Formulario enviado', $request->request->all(), $request->files->all());


       if ($form->isSubmitted() && $form->isValid()) {}
       
        // $form->getData() holds the submitted values
     try {
       $Formulario = $form->getData();
        
      $Company = new Company(); 
      $Company->setName($Formulario->getcompanyName());   
      $Company->setCreateDate(new \Datetime());   
      $Company->setUpdaDate(new \Datetime());   
      $Company->setRfc($Formulario->getRfc());   
      $Company->setCompanyName($Formulario->getCompanyName());   
      $Company->setStatus('1');   
      $entityManager->persist($Company);


      $Customer = new Customer();
      $Customer->setCompany($Company);
      $Customer->setname($Formulario->getName());
      $Customer->setPaternalSuername($Formulario->getPaternalName());
      $Customer->setMaternalSurname($Formulario->getMaternalName());
      $Customer->setStreet($Formulario->getStreet());
      $Customer->setState($Formulario->getState());
      $Customer->setMunicipality($Formulario->getMunicipality());
      $Customer->setPostalCode($Formulario->getPostalCode());
      $Customer->setNumber($Formulario->getPhone());
      $Customer->setCreteDate(new \Datetime());   
      $Customer->setUpdateDate(new \Datetime());  
      $Customer->setStatus('1');  
      $entityManager->persist($Customer);

      $User= new User();
      $User->setName('');
      $User->setPaternalSurname('');
      $User->setMaternalSurname('');
      $User->setNumberPhone('');
      $User->setRol('') ;
      $User->setPassword('');
      $User->setEmail('');
      $entityManager->persist($User);

      $Application= new Application();
      $Application->setCustomer($Customer);
      $Application->setUserAuth($User);
      $Application->setRequestedAmount($Formulario->getRequestedAmount());
      $Application->setStatus('1');
      $Application->setApplicationDate(new \Datetime());
      $Application->setResolutionDate(new \Datetime());
      $Application->setBank($Formulario->getBank()) ;
      $Application->setInterbank($Formulario->getInterbank());
      $Application->setNotes('1');
      $entityManager->persist($Application);

      $documentTypes = [
       'INE' => $form->get('imagesINE')->getData(),
       'Comprobante de Domicilio' =>  $form->get('imagesStree')->getData(),
       'Nómina' => $form->get('imagesNomina')->getData(),
   ];

        $direccion=$this->getParameter('documents_directory');
   foreach ($documentTypes as $docName => $uploadedFile) {

     if ($uploadedFile instanceof UploadedFile) {
         $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
         //$safeFilename = $slugger->slug($originalFilename);
         $safeFilename = md5(uniqid()).'.'.$uploadedFile->guessExtension();
         $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

         try {
             $uploadedFile->move(
                 $this->getParameter('documents_directory'), 
                 $newFilename
             );

             $Document = new Document();
             $Document->setApplication($Application);
             $Document->setDocumentName($newFilename);
             $Document->setDocumentType($docName);
             $Document->setFile($newFilename);
             $Document->setStatus('1');
             $Document->setCreateDate(new \DateTime());
             $Document->setUpdateDate(new \DateTime());

             $entityManager->persist($Document);
             
         } catch (FileException $e) {
           throw new \Exeption($e->getMessage());
        
           exit;
         }
    }
 }
   

    $entityManager->flush();
        $this->addFlash( 'notice','Tus documentos fueron enviados correctamente! ' .$Formulario->getname());
       
        // ... perform some action, such as saving the task to the database
      } catch (\Throwable $th) {
        //throw $th;
        echo('datos no guardados'); 
      echo "Mensaje de Error: " . $th->getMessage();
        exit;
       };
  
        return $this->redirectToRoute('indexapp', [],303);
       

   //  ->add('name', TextType::class )
   //  ->add('paternalName', TextType::class)
   //   ->add('maternalName', TextType::class)
    // ->add('street', TextType::class)
    // ->add('phone', TextType::class, )
  //   ->add('companyName', TextType::class)
  //   ->ad('companyNumber', TextType::class)
    // ->add('imagesINE', FileType::class)
  //   ->add('imagesStree', FileType::class)
    // ->add('imagesNomina', FileType::class)
    // ->add('requestedAmount', MoneyType::class, [
       //  'divisor' => 100,
      //   'currency' => 'MXN',
  //   ])
   //  ->add('bank', TextType::class)
    // ->add('interbank', TextType::class)
     //->add('save', SubmitType::class, ['label' => 'Enviar'])  
     //->getForm();
     }
        


       return $this->render('web_app_loan/forms.html.twig', [
            
         'form' => $form->createView(),
      ]);
  }


   
}
