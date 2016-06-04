<?php

namespace Kore\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class BlogController extends Controller
{
    /**
     * @Route("/", name="blog_home")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('KoreBlogBundle:Post')
            ->findRecent();

        return array('posts' => $posts);
    }
    
    /**
     * @Route("/all", name="blog_all")
     * @Template()
     */
    public function allAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('KoreBlogBundle:Post')
            ->findAll();

        return array('posts' => $posts);
    }

    /**
     * @Route("/post/{id}/{slug}", name="blog_post_view")
     * @ParamConverter("post", class="KoreBlogBundle:Post", options={"mapping": {"id" = "id"}})
     * @Template()
     */
    public function viewAction($post)
    {
        return array('post' => $post);
    }
}
