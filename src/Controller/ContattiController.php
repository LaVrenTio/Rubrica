<?php
namespace App\Controller;

use App\Entity\Contatti;
use App\Form\ContattiFormType;
use App\Form\CercaContattoType;
use App\Form\ModificaContattoType;
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
      
        $messaggio = $request->query->get('message');
       //dd($dati);
        $form = $this->createForm(ContattiFormType::class);
      // 
        $form->handleRequest($request);
        //dd($form);
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
            //dd('dentro'); 
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
       
        
        if(!$sent){

            return $this->render('contatti.html.twig',[
                'message'=>$messaggio,
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

    #[Route('dati', name: 'dati')]
    public function dati(EntityManagerInterface $em, Request $request): Response 
    { 
        $conn=$em->getConnection();
        $sql=" SELECT * FROM contatti";
        $result=$conn->executeQuery($sql);
        $dati = $result->fetchAllAssociative();

        return $this->render('dati.html.twig',[
            'dati'=>$dati,
        ]);
    }
    #[Route('cercacontatti', name: 'cercacontatti')]
    public function cercacontatti(EntityManagerInterface $em, Request $request): Response 
    {   
       
        $contatto = new Contatti();
        $form = $this->createForm(CercaContattoType::class, $contatto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Qui gestisci la logica per cercare il contatto nel database
            // Utilizzando i dati inseriti nel form (nome e cognome)

            // Esempio di ricerca del contatto nel repository
            $nome = $contatto->getNome();
            $cognome = $contatto->getCognome();
            $repository = $em->getRepository(Contatti::class);
            $contattoTrovato = $repository->findOneBy(['nome' => $nome, 'cognome' => $cognome]);

            if ($contattoTrovato) {
              //  dd($contattoTrovato);
                return $this->redirectToRoute('pagina_modifica_contatto', [
                    'id' => $contattoTrovato->getId(), // Passa l'ID del contatto alla pagina di modifica
                ]);
                
            } else {
                
                return $this->redirectToRoute('contatti', [
                    'message' => 'Contatto non trovato. Inserisci un nuovo contatto.',
                    
                ]);
            }
        }

        return $this->render('cerca_contatto.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('pagina_modifica_contatto/{id}', name: 'pagina_modifica_contatto')]
    public function pagina_modifica_contatto(EntityManagerInterface $em,Contatti $contatto, Request $request): Response 
    {   // Creazione del form di modifica pre-popolato con i dati del contatto trovato
        $form = $this->createForm(ModificaContattoType::class, $contatto);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Salvataggio delle modifiche nel database
         $em->flush();
    
            // Aggiungi un messaggio di successo
            $this->addFlash('success', 'Contatto modificato con successo!');
    
            // Reindirizza all'elenco dei contatti o ad un'altra pagina desiderata
            return $this->redirectToRoute('contatti');
        }
    
        return $this->render('modifica_contatto.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}


