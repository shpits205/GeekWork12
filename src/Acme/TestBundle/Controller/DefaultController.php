<?php

namespace Acme\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Doctrine\ORM\Query;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getEntityManager();
        $blogs = $em->getRepository('AcmeTestBundle:Post')
            ->getLastPost(5);
        $view = $em->getRepository('AcmeTestBundle:Post')
            ->getMostViewed();
        $book = $em->getRepository('AcmeTestBundle:Book')
            ->getLastBook(5);
        return $this->render('AcmeTestBundle:Blog:home.html.twig', array(
            'allpost' => $blogs,
            'mostview' => $view,
            'lastGuest' => $book
        ));
    }

    public function aboutAction()
    {
        $em = $this->getDoctrine()
            ->getEntityManager();
        $blogs = $em->getRepository('AcmeTestBundle:Post')
            ->getLastPost(5);
        $view = $em->getRepository('AcmeTestBundle:Post')
            ->getMostViewed();
        $book = $em->getRepository('AcmeTestBundle:Book')
            ->getLastBook(5);
        return $this->render('AcmeTestBundle:Blog:about.html.twig', array(
            'allpost' => $blogs,
            'mostview' => $view,
            'lastGuest' => $book
        ));
    }

    public function tagAction(Request $request)
    {
        $em = $this->getDoctrine()
            ->getEntityManager();
        $idPost = $request->query->get('idPost');
        $post = $em->getRepository('AcmeTestBundle:Post')->find($idPost);
        $count = $post->getViewed();
        $count = $count + 1;
        $post->setViewed($count);
        $em->persist($post);
        $em->flush();
        $view = $em->getRepository('AcmeTestBundle:Post')
            ->getMostViewed();
        $book = $em->getRepository('AcmeTestBundle:Book')
            ->getLastBook(5);
        return $this->render('AcmeTestBundle:Blog:detail.html.twig', array(
            'post' => $post,
            'mostview' => $view,
            'lastGuest' => $book
        ));
    }

    public function detailPostAction(Request $request)
    {
        $em = $this->getDoctrine()
            ->getEntityManager();
        $idPost = $request->query->get('idPost');
        $post = $em->getRepository('AcmeTestBundle:Post')->find($idPost);
        $count = $post->getViewed();
        $count = $count + 1;
        $post->setViewed($count);
        $em->persist($post);
        $em->flush();
        $view = $em->getRepository('AcmeTestBundle:Post')
            ->getMostViewed();
        $book = $em->getRepository('AcmeTestBundle:Book')
            ->getLastBook(5);
        return $this->render('AcmeTestBundle:Blog:detail.html.twig', array(
            'post' => $post,
            'mostview' => $view,
            'lastGuest' => $book
        ));
    }

    public function guestAction($page = 1)
    {
        $manager = $this->getDoctrine()->getManager();

        $em = $this->getDoctrine()
            ->getEntityManager();

        $book = $em->getRepository('AcmeTestBundle:Book')
            ->getLastBook(5);

        $form = $this->createForm('book');
        $form->handleRequest($this->getRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();
            $manager->persist($message);
            $manager->flush();

            return $this->redirect($this->generateUrl('acme_test_guest'));
        }

        return $this->render('AcmeTestBundle:Blog:guestbook.html.twig', array(
            'form' => $form->createView(),
            'book' => $book
        ));
    }

    public function showMoreAction()
    {
        $em = $this->getDoctrine()
            ->getEntityManager();
        $blogs = $em->getRepository('AcmeTestBundle:Post')
            ->getLastPost(5);
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($blogs));
        return $response;
    }

    public function addPostAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $form = $this->createForm('post');
        $form->handleRequest($this->getRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();
            $manager->persist($message);
            $manager->flush();

            return $this->redirect($this->generateUrl('acme_test_home'));
        }

        return $this->render('AcmeTestBundle:Blog:addAction.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
