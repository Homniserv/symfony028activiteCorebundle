<?php

  // src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
  public static  $static_listAdverts = [];
  
  public function __construct()
  {
    AdvertController::$static_listAdverts =   array(
						    array(
							  'title'   => 'Recherche développpeur Symfony',
							  'id'      => 1,
							  'author'  => 'Alexandre',
							  'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
							  'date'    => new \Datetime()),
						    array(
							  'title'   => 'Mission de webmaster',
							  'id'      => 2,
							  'author'  => 'Hugo',
							  'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
							  'date'    => new \Datetime()),
						    array(
							  'title'   => 'Offre de stage webdesigner',
							  'id'      => 3,
							  'author'  => 'Mathieu',
							  'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
							  'date'    => new \Datetime())
						    );


  }



  public function menu1Action()
  {
    return $this->render('@OCPlatform/Advert/menu.html.twig');
  }

  public function menu2Action()
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la récupérera depuis la BDD !
    $listAdverts = array(
			 array('id' => 2, 'title' => 'Recherche développeur Symfony'),
			 array('id' => 5, 'title' => 'Mission de webmaster'),
			 array('id' => 9, 'title' => 'Offre de stage webdesigner')
			 );

    return $this->render('@OCPlatform/Advert/menu.html.twig', array(
								    // Tout l'intérêt est ici : le contrôleur passe
								    // les variables nécessaires au template !
								    'listAdverts' => $listAdverts
								    )
			 );
  }


  public function index1Action()
  {
    // return new Response("Hello World !");


    /*https://openclassrooms.com/fr/courses/3619856-developpez-votre-site-web-avec-le-framework-symfony/3621582-le-moteur-de-templates-twig*/
    return $this->render('@OCPlatform/Advert/index.html.twig', array(
								     'listAdverts' => array()
								     ));
  }









  public function index2Action($page)
  {
    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit être supérieure ou égale à 1
    if ($page < 1) {
      // On déclenche une exception NotFoundHttpException, cela va afficher
      // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }

    // Ici, on récupérera la liste des annonces, puis on la passera au template

    // Notre liste d'annonce en dur
    $listAdverts = array(
			 array(
			       'title'   => 'Recherche développpeur Symfony',
			       'id'      => 1,
			       'author'  => 'Alexandre',
			       'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
			       'date'    => new \Datetime()),
			 array(
			       'title'   => 'Mission de webmaster',
			       'id'      => 2,
			       'author'  => 'Hugo',
			       'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
			       'date'    => new \Datetime()),
			 array(
			       'title'   => 'Offre de stage webdesigner',
			       'id'      => 3,
			       'author'  => 'Mathieu',
			       'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
			       'date'    => new \Datetime())
			 );



    
    // Mais pour l'instant, on ne fait qu'appeler le template
    // return $this->render('@OCPlatform/Advert/index.html.twig');




    // Et modifiez le 2nd argument pour injecter notre liste
    return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
									  'listAdverts' => $listAdverts
									  ));
  }




  
  /* public function viewAction($id)
     {
     return new Response("Affichage de l'annonce d'id : ".$id);
     }*/
  public function view1Action($id)
  {
    // Ici, on récupérera l'annonce correspondante à l'id $id

    return $this->render('@OCPlatform/Advert/view.html.twig', array(
								    'id' => $id
								    ));
  }

  // On injecte la requête dans les arguments de la méthode
  /*https://openclassrooms.com/fr/courses/3619856-developpez-votre-site-web-avec-le-framework-symfony/3621111-les-controleurs-avec-symfony*/
  public function view2Action($id, Request $request)
  {
    // On récupère notre paramètre tag
    $tag = $request->query->get('tag');

    return new Response(
			"Affichage de l'annonce d'id : ".$id.", avec le tag : ".$tag
			);
  }

 
  //https://openclassrooms.com/fr/courses/3619856-developpez-votre-site-web-avec-le-framework-symfony/3621582-le-moteur-de-templates-twig
  public function view3Action($id,Request $request)
  {
    //   'id'      => $id,
    $advert = array(
		    'title'   => 'Recherche développpeur Symfony2',
		    'id'      => 1,
		    'author'  => 'Alexandre',
		    'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
		    'date'    => new \Datetime()
		    );
    $adverts = [];
    array_push( $adverts,$advert);



  
    //  if ($id <= count($adverts)){
    $advert = [];
    $advert = $adverts[$id-1];
    return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
									 'advert' => $advert
									 ));
 

    // On récupère notre paramètre tag
    $tag = $request->query->get('tag');

    return new Response(
			"Affichage de l'annonce d'id : ".$id.", avec le tag : ".$tag
			);
    //  }
    //else
    //{}
  }



  
  public function addAction(Request $request)
  {
    // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

    // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
    if ($request->isMethod('POST')) {
      // Ici, on s'occupera de la création et de la gestion du formulaire

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      // Puis on redirige vers la page de visualisation de cettte annonce
      return $this->redirectToRoute('oc_platform_view', array('id' => 5));
    }

    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('@OCPlatform/Advert/add.html.twig');
  }

  public function editAction($id, Request $request)
  {
    /* // Ici, on récupérera l'annonce correspondante à $id */

    /* // Même mécanisme que pour l'ajout */
    /* if ($request->isMethod('POST')) { */
    /*   $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.'); */

    /*   return $this->redirectToRoute('oc_platform_view', array('id' => 5)); */
    /* } */

    /* return $this->render('@OCPlatform/Advert/edit.html.twig'); */
    // ...
    
    /* $advert = array( */
    /* 		    'title'   => 'Recherche développpeur Symfony', */
    /* 		    'id'      => $id, */
    /* 		    'author'  => 'Alexandre', */
    /* 		    'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…', */
    /* 		    'date'    => new \Datetime() */
    /* 		    ); */

    /* return $this->render('OCPlatformBundle:Advert:edit.html.twig', array( */
    /* 									 'advert' => $advert */
    /* 									 ) */
    /* 			 ); */




       return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
									 'advert' => AdvertController::$static_listAdverts[$id-1]
									 )
			 );
  }

  public function deleteAction($id)
  {
    // Ici, on récupérera l'annonce correspondant à $id

    // Ici, on gérera la suppression de l'annonce en question

    return $this->render('@OCPlatform/Advert/delete.html.twig');
  }


  public function viewSlugAction($slug, $year, $format)
  {
    return new Response(
			"On pourrait afficher l'annonce correspondant au
            slug '".$slug."', créée en ".$year." et au format ".$format."."
			);
  }

}
