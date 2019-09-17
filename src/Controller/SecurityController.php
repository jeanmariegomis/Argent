<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Entreprise;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;

/**
* @Route("/api")
*/
class SecurityController extends AbstractController
{
/**
* @Route("/register", name="register", methods={"POST"})
*/
public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
{
$values = json_decode($request->getContent());
if(isset($values->username,$values->password)) {
$user = new Utilisateur();
$user->setUsername($values->username);
$user->setPassword($passwordEncoder->encodePassword($user, $values->password));
$actif='Actif';
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

$wari=new Entreprise();
$wari->setRaisonSociale('Wari')
->setNinea(strval(rand(150000000,979999999)))
->setAdresse('Guediawaye')
->setStatus($actif);
$entityManager->persist($wari);
$user->setRoles(['admin']);
$user->setEntreprise($wari);
$user->setProfil($profilAdm);
$user ->setNom($values->Nom);
$user ->setEmail($values->Email);
$user ->setTelephone(rand(770000000,779999999));
$user ->setNci(strval(rand(150000000,979999999)));
$user->setStatus($actif);
$errors = $validator->validate($user);
if(count($errors)) {
$errors = $serializer->serialize($errors, 'json');
return new Response($errors, 500, [
'Content-Type' => 'application/json'
]);
}
$entityManager->persist($user);
$entityManager->flush();

$data = [
'status' => 201,
'message' => 'L\'utilisateur a été créé'
];

return new JsonResponse($data, 201);
}
$data = [
'status' => 500,
'message' => 'Vous devez renseigner les clés username et password'
];
return new JsonResponse($data, 500);
}
 /**
     * @Route("/login_check", name="login", methods={"POST"})
     * @param JWTEncoderInterface $JWTEncoder
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function login(Request $request, JWTEncoderInterface  $JWTEncoder)
    { 
   
       $values = json_decode($request->getContent());
        $username   = $values->username; // json-string
        $password   = $values->password; // json-string

            $repo = $this->getDoctrine()->getRepository(User::class);
            $user = $repo-> findOneBy(['username' => $username]);
            if(!$user){
                return $this->json([
                        'message' => 'Username incorrect'
                    ]);
            }

            $isValid = $this->passwordEncoder
            ->isPasswordValid($user, $password);
            if(!$isValid){ 
                return $this->json([
                    'message' => 'Mot de passe incorect'
                ]);
            }
            if($user->getEtat()=="bloquer"){
                return $this->json([
                    'message' => 'ACCÈS REFUSÉ vous ne pouvez pas connecter !'
                ]);
            }
            $token = $JWTEncoder->encode([
                'username' => $user->getUsername(),
                'exp' => time() + 86400 // 1 day expiration
            ]);

            return $this->json([
                'token' => $token
            ]);
                
    }


private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

}

