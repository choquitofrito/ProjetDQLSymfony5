<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Livre;

class ExemplesDQLController extends AbstractController
{
    
    // Exemple de SELECT uniquement des titres des livres 
    // qui coutent plus de 15 euros en DQL, 
    // on obtient un array de strings, pas d'objets 

    /**
     * @Route ("/exemples/d/q/l/exemple/select/array/arrays")
     */
    public function exempleSelectArrayArrays (){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery ("SELECT livre.titre, livre.prix FROM App\Entity\Livre livre ".
                                "WHERE livre.prix>15");
        $resultat = $query->getResult();
        $vars = ['livres'=> $resultat];
        return $this->render ("exemples_dql/exemple_select_array_arrays.html.twig", $vars);
    }
    
    
    
    // SELECT des Livres complets en DQL, 
    // on obtient un array d'objets! 
    
    /**
     * @Route ("/exemples/d/q/l/exemple/select/array/objets")
     */
    public function exempleSelectArrayObjets (){
        $em = $this->getDoctrine()->getManager();
        // avec cette requête on obtient un array d'objets
        $query = $em->createQuery ('SELECT livre FROM App\Entity\Livre livre WHERE livre.prix >15');
        $resultat = $query->getResult();
        $vars = ['livres'=> $resultat];
        return $this->render ("exemples_dql/exemple_select_array_objets.html.twig", $vars);   
    }

    
    
    
    // Regular Join
    /**
     * @Route ("/exemples/d/q/l/exemple/regular/join")
     */
    public function exempleRegularJoin(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery ('SELECT livre FROM App\Entity\Livre livre JOIN '
                . 'livre.exemplaires exemplaires');
        $resultats = $query->getResult();
        // observez que les exemplaires sont vides
        $resultat = $query->getResult();
        // observez que les exemplaires sont remplis dans le dump de la vue
        $vars = ['livres'=> $resultat];
        return $this->render ("exemples_dql/exemple_regular_join.html.twig", $vars);
        
    }

    

    // Fetch Join
    /**
     * @Route ("/exemples/d/q/l/exemple/fetch/join")
     */
    public function exempleFetchJoin(){
        $em = $this->getDoctrine()->getManager();
        // si on indique juste "SELECT livre" on obtient les objets de cette entité
        $query = $em->createQuery ('SELECT livre, exemplaires FROM App\Entity\Livre livre '
                . 'JOIN livre.exemplaires exemplaires');
        $resultat = $query->getResult();
        // observez que les exemplaires sont remplis dans le dump de la vue
        $vars = ['livres'=> $resultat];
        return $this->render ("exemples_dql/exemple_fetch_join.html.twig", $vars);
    }
    
    
    // UPDATE
    /**
     * @Route ("/exemples/d/q/l/exemple/update")
     */
    public function exempleUpdate (){

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery ('UPDATE App\Entity\Livre l SET l.prix = l.prix - :montant WHERE l.titre = :titre');

        // pour simplifier on fixe de valeurs pour le montant à déduire et le livre à changer (ISBN)
        $montant = 0.5; 
        $ISBN = "The Aleph";

        $query->setParameter ('montant',$montant);
        $query->setParameter ('titre',$ISBN);
        $query->execute(); // pas getResult!
        return $this->render ("exemples_dql/exemple_update.html.twig"); 

    }

    


    
}
