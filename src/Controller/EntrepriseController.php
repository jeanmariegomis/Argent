<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Depot;
use App\Entity\Compte;
use App\Entity\Profil;
use App\Entity\Tarifs;
use App\Form\DepotType;
use App\Form\CompteType;
use App\Entity\Entreprise;
use App\Entity\Transaction;
use App\Entity\Utilisateur;
use App\Form\EntrepriseType;
use App\Form\TransactionType;
use App\Form\UtilisateurType;
use JMS\Serializer\SerializerBuilder;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Security\Core\User\DatetimeInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/** 
 * @Route("/api")
 */
class EntrepriseController extends AbstractController
{
/**
* @Route("/enregistre", name="enregistre", methods={"POST"})
*/
    public function enregistrer(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder,ValidatorInterface $validator,SerializerInterface $serializer): Response
    {
        
        $random=random_int(100000,999999);
        $Utilisateur= new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $Utilisateur);// liaison de notre formulaire avec l'objet de type depot
        $data=$request->request->all(); //conversion de notre element de la requette
        $file=$request->files->all()['imageFile'];

        $form->submit($data);

        $profilSup=new Profil();
        $profilSup->setLibelle('SuperAdmin');
        $entityManager->persist($profilSup);
        $profilCaiss=new Profil();
        $profilCaiss->setLibelle('Caissier');
        $entityManager->persist($profilCaiss);
        $profilAdP=new Profil();
        $profilAdP->setLibelle('AdminPrincipal');
        $entityManager->persist($profilAdP);
        $profilAdm=new Profil();
        $profilAdm->setLibelle('Admin');
        $entityManager->persist($profilAdm);
      
        $Utilisateur->setPassword($passwordEncoder->encodePassword($Utilisateur, $data["password"]));
        $Utilisateur->setProfil($profilCaiss);
        $Utilisateur->setImageFile($file); 
        $Utilisateur->setUpdatedAt(new \DateTime());
        $Utilisateur->setTelephone(rand(770000000,779999999));
        $Utilisateur->setNci(strval(rand(150000000,979999999)));
        $Utilisateur->setStatus('Actif');
        $Utilisateur->setRoles(['ROLE_Caissier']);
      

        $Entreprise= new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $Entreprise);// liaison de notre formulaire avec l'objet de type entreprise
        $data=$request->request->all(); //conversion de notre element de la requette
        $form->submit($data);
        $Entreprise->setStatus('Actif');
        $Utilisateur->setEntreprise($Entreprise);


        $Compte= new Compte();
        $form = $this->createForm(CompteType::class, $Compte);// liaison de notre formulaire avec l'objet de type depot
        $data=$request->request->all(); //conversion de notre element de la requette
        $form->submit($data);


        $Compte->setNumeroCompte($random);
        $Compte->setEntreprise($Entreprise);
        $Utilisateur->setCompte($Compte);
        $entityManager = $this->getDoctrine()->getManager();
        
    
        $entityManager->persist($Utilisateur);
        $entityManager->persist($Entreprise);
        $entityManager->persist($Compte);
        $entityManager->flush();

        
          
        return new Response('L\'entreprise a été ajouté',Response::HTTP_CREATED); 
    }


     /**
     * @Route("/list/entreprise", name="list_entreprise", methods={"GET"})
     */
    public function liste(EntrepriseRepository $EntrepriseRepository, SerializerInterface $serializer)
    {
        $Entreprises = $EntrepriseRepository->findAll();
        $data = $serializer->serialize($Entreprises, 'json');

        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }



     /**
     * @Route("/list/utilisateur", name="list_utilisateur", methods={"GET"})
     */
    public function lister(UtilisateurRepository $UtilisateurRepository, SerializerInterface $serializer)
    {
        $Utilisateur = $UtilisateurRepository->findAll();
        $data = $serializer->serialize($Utilisateur, 'json');

        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }


    /**
     * @Route("/utilisateur", name="utilisateur", methods={"POST"})
     */
    public function ajouter(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder,ValidatorInterface $validator,SerializerInterface $serializer): Response
    
    {   

    $Utilisateur= new Utilisateur();

    $form = $this->createForm(UtilisateurType::class, $Utilisateur);// liaison de notre formulaire avec l'objet de type depot
    $data=$request->request->all(); //conversion de notre element de la requette
    $file=$request->files->all()['imageFile'];

    $form->submit($data);

    $profilSup=new Profil();
    $profilSup->setLibelle('ROLE_SuperAdmin');
    $entityManager->persist($profilSup);
    $profilCaiss=new Profil();
    $profilCaiss->setLibelle('ROLE_Caissier');
    $entityManager->persist($profilCaiss);
    $profilAdP=new Profil();
    $profilAdP->setLibelle('ROLE_AdminPrincipal');
    $entityManager->persist($profilAdP);
    $profilAdm=new Profil();
    $profilAdm->setLibelle('ROLE_Admin');
    $entityManager->persist($profilAdm);
   
    $Utilisateur->setPassword($passwordEncoder->encodePassword($Utilisateur, $data["password"]));
    $Utilisateur->setProfil($profilSup);
    $Utilisateur->setImageFile($file); 
    $Utilisateur->setUpdatedAt(new \DateTime());
    $Utilisateur->setTelephone(rand(770000000,779999999));
    $Utilisateur->setNci(strval(rand(150000000,979999999)));
    $Utilisateur->setStatus('Actif');
    $Utilisateur->setRoles(['ROLE_AdminPrincipal']);
  
    $entityManager->persist($Utilisateur);
    $entityManager->flush();

    return new Response('L\'utilisateur a été ajouté',Response::HTTP_CREATED); 


}


 /**
     * @Route("/entreprise", name="entreprise", methods={"POST"})
     */
    public function ajout(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder,ValidatorInterface $validator,SerializerInterface $serializer): Response
    
    { 
        $Entreprise= new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $Entreprise);// liaison de notre formulaire avec l'objet de type depot
        $data=$request->request->all(); //conversion de notre element de la requette
        $form->submit($data);
        $Entreprise->setStatus('Actif');

        $entityManager->persist($Entreprise);
        $entityManager->flush();

        return new Response('Le Partenaire a été ajouté',Response::HTTP_CREATED); 

    }

     /** 
     * @Route("/depot", name="depot", methods={"POST"})
     */


    public function depot (Request $request, UserInterface $Userconnecte, ValidatorInterface $validator, SerializerInterface $serializer) // UserInterface permette de recuperer l'utilisateur actuellement connecté
    {
        $depot = new Depot();//creation d'un objet de type depot
        $form = $this->createForm(DepotType::class, $depot);// liaison de notre formulaire avec l'objet de type depot
        $data=json_decode($request->getContent(),true); //conversion de notre element de la requette
        //$data=$request->request->all();
        $form->submit($data);
        $repo = $this->getDoctrine()->getRepository(Compte::class);// recupere le repository compte
        $Compte = $repo->findOneBy(['NumeroCompte' => $data["NumeroCompte"]]);//findOneBy(['numcompte' => $data->numcompte]recherche 
        
        $depot->setDate(new \DateTime());// on remplit la date du depot a l'instant t
        $depot->setUtilisateur($Userconnecte);// liaison du caissier avec depot
        $depot->setMontant($data["Montant"]);
        $depot->setCompte($Compte);
        $Compte->setSolde($Compte->getSolde()+$depot->getMontant());// on rempli le nouveau solde du depot
        $manager=$this->getDoctrine()->getManager();// recuperation de l'objet manager
        $errors = $validator->validate($depot);
        if (count($errors)) {
        $errors = $serializer->serialize($errors, 'json');
        return new Response($errors, 500, ['Content-Type' => 'Application/json']);
        }
           $manager->persist($Compte);// nous permet d'ecrire dans la table compte
           $manager->persist($depot);//permet d'ecrire dans la table depot
           $manager->flush();
           $data = [
               'status' => 201,
               'message' => 'Le depot a bien été effectué '
           ];
           
           
           return new JsonResponse($data, 201);// on retourne l'objet JSON
        
    }

    /**
    * @Route("/bloque", name="bloque", methods={"POST"})
    */
    public function bloque(Request $request, SerializerInterface $serializer,ValidatorInterface $validator, EntityManagerInterface $entityManager, ObjectManager $manager)
        


    {

        $Entreprise= new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $Entreprise);// liaison de notre formulaire avec l'objet de type depot
        $data=$request->request->all(); //conversion de notre element de la requette
        $form->submit($data);
        $Entreprise->setStatus('Actif');

        if($Entreprise->getRaisonSociale()=='Wari'){
            return new Response('Impossible de bloqué ce partenaire', 409, [
                'Content-Type' => 'application/json'
            ]);
        }
        elseif($Entreprise->getStatus() == "Actif"){
            $Entreprise->setStatus("bloqué");
            $reponse= new Response('Partenaire bloqué', 200, [
                'Content-Type' => 'application/json'
            ]);

        }
        else{
            $Entreprise->setStatus("Actif");
            $reponse= new Response('Partenaire débloqué', 200, [
                'Content-Type' => 'application/json'
            ]);
        }
        $manager->persist($Entreprise);
        $manager->flush();
        return $reponse;
    }

    /** 
     * @Route("/bloquer/{id}" , name="bloquer", methods={"GET"})
     */
    public function bloquerdebloquer(Request $request,  Utilisateur $Utilisateurs,UtilisateurRepository $UtilisateurRepo, EntityManagerInterface $entityManager): Response
    {
        $values = json_decode($request->getContent());
        $Utilisateur=$UtilisateurRepo->find($Utilisateurs->getId());        
        if ($Utilisateur->getStatus() == "debloquer") {
            $Utilisateur->SetStatus("bloquer");
            $entityManager->flush();
            $data = [
                'statu' => 200,
                'messag' => 'utilisateur bloquer'
            ];
            return new JsonResponse($data);
        } else {
            $Utilisateur->SetStatus("debloquer");
            $entityManager->flush();
            $data = [
                'status' => 200,
                'message' => 'utilisateur debloquer'
            ];
            return new JsonResponse($data);
        }
    }

     



   
    

}