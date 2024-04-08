<?php
namespace App\Controller;

use App\Entity\Contatti;
use App\Form\ContattiFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormBuilderInterface;


class ContattiController extends AbstractController
{
    #[Route('contatti', name: 'contatti')]
    public function contatti(EntityManagerInterface $em, Request $request): Response 
    {   
        $visual=false;
        $sent=false;
        $conn=$em->getConnection();
        $sql=" SELECT * FROM contatti";
        $result=$conn->executeQuery($sql);
        $dati = $result->fetchAllAssociative();
       dd($dati);
        $form = $this->createForm(ContattiFormType::class);
       // dd($form);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            // $errors = $form->getErrors(true, false);

            // // Crea un array per memorizzare i messaggi di errore
            // $errorMessages = [];
            // foreach ($errors as $error) {
            //     $errorMessages[] = $error->getMessage();
            // }
    
            // // Converte l'array di messaggi di errore in formato JSON
            // $errorMessageJson = json_encode($errorMessages);
    
            // Ritorna una risposta JSON contenente i messaggi di errore
            //return new Response($errorMessageJson, 400); 
            $contatto = $form->getData();
             $nomeCity=$contatto->getCitta();
             $contatto->setCitta($nomeCity);
            // dd($contatto);
             $contattoIssent= $em->getRepository(Contatti::class)->gestioneContatto($contatto);
             if(empty( $contattoIssent)) {
                return $this->render('dbPresent.html.twig');

             }else{

                 $sent=true;
             }
        }
        foreach($dati as $r){
           // dd($r);
        }
        if ($request->query->has('visualizza_rubrica')) {
           // dd('cliccato');
            // Se il bottone "VISUALIZZA RUBRICA" è stato cliccato, reindirizza l'utente alla pagina 'dati.html'
            return $this->render('dati.html.twig',[ 
                'dati'=> $dati,
        ]);
        }
        if(!$sent){

            return $this->render('contatti.html.twig',[
               'form'=>$form->createView(),
            ]);
        }else{
            return $this->render('sent.html.twig',[
                'form'=>$form->createView(),
             ]);
        }
        
    }
    #[Route('back', name: 'back')]
    public function back(EntityManagerInterface $em, Request $request): Response 
    {
        return $this->render('dbPresent.html.twig');
    }

    // #[Route('/xpacco_d/{id_xmagtesta}/{id_xpacco}', name: 'x_pacco_d')]
    // public function x_pacco_d(EntityManagerInterface $em,int $id_xmagtesta,int $id_xpacco, Request $request): Response
    // {
    //     if ($id_xpacco>0){
    //         $Xpacco = $em->getRepository(Xpacco::class)->find($id_xpacco);
    //     }else{
    //         $Xpacco = new Xpacco();
    //     }
    //     $aXpaccoTemplate = $em->getRepository(Xpacco::class)->get_pacco_template();
    //     $form = $this->createForm(xPaccoFormType::class,$Xpacco,['aXpaccoTemplate'=>$aXpaccoTemplate]);
    //     //dd($form);
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()){
            
    //         $Xpacco = $form->getData();
    //         //dd($Xpacco);
    //         // imposto id_xmagtesta perché non l'ho passato nel form e lo imposto qui
    //         $Xpacco->setIdXmagtesta($id_xmagtesta);
    //         //mando al save del repository il pacco 
    //         $em->getRepository(Xpacco::class)->save($Xpacco);
           
    //         return $this->redirectToRoute("x_pacco_index",[
    //             'id_xmagtesta'=>$id_xmagtesta
    //         ]);
    //     }

    //     // inizializzo i dati della form con valori a zero
    //     /*
    //     if ($id_pacco==0){
    //         $form->get('altezza')->setData(0.0);
    //         $form->get('lunghezza')->setData(0);
    //         $form->get('larghezza')->setData(0);
    //         $form->get('volume')->setData(0);
    //     }
    //     */

    //     $BackTolistaPacchi = $this->generateUrl('x_pacco_index',[
    //         'id_xmagtesta'=>$id_xmagtesta,
    //     ]);


    //     return $this->render('x_pacco\xpacco_d.html.twig',[
    //         'xpaccoForm' =>$form->createView(),
    //         'link_annulla' =>$BackTolistaPacchi,
    //     ]);


    // }

}
