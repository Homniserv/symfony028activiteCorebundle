<?php

namespace moueza\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
  public function indexAction()
  {
    return $this->render('mouezaCoreBundle:Default:index.html.twig');
  }

  public function contactsAction(Request $request)
  {
    //  return $this->render('mouezaCoreBundle:Default:contacts.html.twig');








    $session = $request->getSession();
    
    // Bien sûr, cette méthode devra réellement ajouter l'annonce
    
    // Mais faisons comme si c'était le cas
    $session->getFlashBag()->add('info', 'La page de contact n’est pas encore disponible');

    // Le « flashBag » est ce qui contient les messages flash dans la session
    // Il peut bien sûr contenir plusieurs messages :
  

    // Puis on redirige vers la page de visualisation de cette annonce
    return $this->redirectToRoute('mouezacorewelcomepage');
  }
}
