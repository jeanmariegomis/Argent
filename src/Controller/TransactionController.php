<?php


namespace App\Controller;
use App\Entity\Depot;
use App\Entity\Compte;
use App\Entity\Profil;
use App\Entity\Tarifs;
use App\Form\DepotType;
use App\Form\CompteType;
use App\Entity\Entreprise;
use App\Entity\Expediteur;
use App\Entity\Transaction;
use App\Entity\Utilisateur;
use App\Entity\Beneficiaire;
use App\Form\EntrepriseType;
use App\Form\ExpediteurType;
use App\Form\TransactionType;
use App\Form\UtilisateurType;
use App\Form\BeneficiaireType;
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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api")
 */
class TransactionController extends AbstractController
{
   /**
     * @Route("/envoi", name="tra", methods={"GET","POST"})
     */
    public function envoi(Request $request, EntityManagerInterface $entityManager,
    SerializerInterface $serializer, ValidatorInterface $validator):Response
    {

        $envoi = new Transaction();
        
        $form = $this->createForm(TransactionType::class,$envoi);
        $Utilisateur = $this->getUtilisateur;
        $data = $request->request->all();
        $form->submit($data);
      
        $expediteur = new Expediteur();
        $form=$this->createForm(ExpediteurType::class , $expediteur);
        $data=$request->request->all();
         $form->submit($data);
        
         $envoi->setExpediteur($expediteur);
         

         $beneficiaire = new Beneficiaire();
         $form=$this->createForm(BeneficiaireType::class , $beneficiaire);
         $data=$request->request->all();
          $form->submit($data);

          $envoi->setBeneficiaire($beneficiaire);


          
         $Utilisateur= new Utilisateur();
         $form=$this->createForm(Utilisateur::class , $Utilisateur);
         $data=$request->request->all();
          $form->submit($data);

          $envoi->setUtilisateur($Utilisateur);

        


       

            $envoi->setDateenvoi(new \DateTime());
            $envoi->setType("envoi");
            while (true) {
                if (time() % 1 == 0) {
                    $alea = rand(100,1000000);
                    break;
                }else {
                    slep(1);
                }
            }
            $envoi->setCode($alea);
           
            $vo=$form->get('montant')->getData();
            $frais= $this->getDoctrine()->getRepository(Tarifs::class)->findAll();
           
            foreach($frais as $values){
                $values->getBorneInferieure();
                $values->getBorneSuperieure();
                $values->getValeur();
                if($vo>=$values->getBorneInferieure() && $vo<=$values->getBorneSuperieure() ){
                $com=$values->getValeur();
                
            $envoi->setFrais($com);
            $envoi->setCometat(($com*30)/100);
            $envoi->setComsys(($com*40)/100);
            $envoi->setComenvoi(($com*10)/100);
            $envoi->setComretrait(($com*20)/100);
                }
            }
             
            

            $Compte=$Utilisateur->getCompte();
            $envoi->setUtilisateur($Utilisateur);

         
            if($Compte->getSolde() > $envoi->getMontant() ){
                $Montant= $Compte->getSolde()-$envoi->getMontant()+$envoi->getComenvoi();
            
                $Compte->setSolde($Montant);
            $entityManager->persist($Compte);
            $entityManager->persist($envoi);
            $entityManager->persist($expediteur);
            $entityManager->persist($beneficiaire);
            $entityManager->flush();
           
 return new Response('Le transfert a été effectué avec succés. Voici le code : '.$envoi->getCode());
            }
            else{
    
    return new Response('Le solde de votre compte ne vous permet d effectuer une transaction');
            }


        }
    
  
}
