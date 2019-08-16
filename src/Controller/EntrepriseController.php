<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Depot;
use App\Entity\Compte;
use App\Entity\Profil;
use App\Form\DepotType;
use App\Form\CompteType;
use App\Entity\Entreprise;
use App\Entity\Utilisateur;
use App\Form\EntrepriseType;
use App\Form\UtilisateurType;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\FormTypeInterface;
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
     * @Route("/entreprise", name="entreprise", methods={"POST"})
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
        $profilSup->setLibelle('Super-admin');
        $entityManager->persist($profilSup);
        $profilCaiss=new Profil();
        $profilCaiss->setLibelle('Caissier');
        $entityManager->persist($profilCaiss);
        $profilAdP=new Profil();
        $profilAdP->setLibelle('admin-Principal');
        $entityManager->persist($profilAdP);
        $profilAdm=new Profil();
        $profilAdm->setLibelle('admin');
        $entityManager->persist($profilAdm);
        $profilUtil=new Profil();
        $profilUtil->setLibelle('utilisateur');
        $entityManager->persist($profilUtil);
        $Utilisateur->setPassword($passwordEncoder->encodePassword($Utilisateur, $data["password"]));
        $Utilisateur->setProfil($profilAdm);
        $Utilisateur->setImageFile($file); 
        $Utilisateur->setUpdatedAt(new \DateTime());
        $Utilisateur->setTelephone(rand(770000000,779999999));
        $Utilisateur->setNci(strval(rand(150000000,979999999)));
        $Utilisateur->setStatus('Actif');
        $Utilisateur->setRoles(['ROLE_ADMIN']);
      

        $Entreprise= new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $Entreprise);// liaison de notre formulaire avec l'objet de type depot
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
        $entityManager = $this->getDoctrine()->getManager();
        
    
        $entityManager->persist($Utilisateur);
        $entityManager->persist($Entreprise);
        $entityManager->persist($Compte);
        $entityManager->flush();

        
          
        return new Response('L\'entreprise a été ajouté',Response::HTTP_CREATED); 
    }


     /** 
     * @Route("/depot", name="depot", methods={"POST"})
     */


    public function depot (Request $request, UserInterface $Userconnecte, ValidatorInterface $validator, SerializerInterface $serializer) // UserInterface permette de recuperer l'utilisateur actuellement connecté
    {
        $depot = new Depot();//creation d'un objet de type depot
        $form = $this->createForm(DepotType::class, $depot);// liaison de notre formulaire avec l'objet de type depot
        $data=json_decode($request->getContent(),true); //conversion de notre element de la requette
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
           $manager->persist($Compte);// nous permet d'ecrire dans la table entreprise
           $manager->persist($depot);//permet d'ecrire dans la table depot
           $manager->flush();
           $data = [
               'status' => 201,
               'message' => 'Le depot a bien été effectué '
           ];
           
           
           return new JsonResponse($data, 201);// on retourne l'objet JSON
        
    }

}