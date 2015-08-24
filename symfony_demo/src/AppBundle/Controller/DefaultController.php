<?php
/**
 * Created by PhpStorm.
 * User: Berlioz
 * Date: 16/08/2015
 * Time: 23:37
 */


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller {

    /**
     * @Route("/createproduct")
     */
    public function createAction() {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();

        return new Response('Created product id ' . $product->getId());
    }

    /**
     * @Route("/showproduct/{id}/{id2}")
     */
    public function showAction($id, $id2)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($id);

        $product2 = $this->getDoctrine()
            ->getRepository('\AppBundle\Entity\Product')
            ->find($id2);

        //return new Response('show product id ' . $product->getId());

        return $this->render('base.html.twig');

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        // ... do something, like pass the $product object into a template
    }

    /**
     * @Route("/updproduct/{id}")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('New product name!');
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/products")
     */
    public function showProducts()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Product');

        // createQueryBuilder automatically selects FROM AppBundle:Product
        // and aliases it to "p"
        $query = $repository->createQueryBuilder('p')
            ->where('p.price = :price')
            ->setParameter('price', '19.99')
            ->orderBy('p.price', 'ASC')
            ->getQuery();


        $products = $query->getResult();
        // to get just one result:
        // $product = $query->setMaxResults(1)->getOneOrNullResult();

        $res='';
        foreach ($products as $product)
        {
            $res .= '<br>price : ' . $product->getPrice();
        }
        Return New Response('count : ' . count($products) . '<br>' . $res);
    }

    /**
     * @Route("/productsbyrepo")
     */
    public function showproductsusingrepo()
    {
        $em = $this->getDoctrine()->getManager();

        /** @var \AppBundle\Entity\ProductRepository $repo */
        $repo = $em->getRepository('AppBundle:Product');

        $products = $repo->findAllOrderedByName();

        $res = '';
        foreach ($products as $product)
        {
            $res .= '<br>name : ' . $product->getName();
        }
        Return New Response($res);
    }

    /**
     * @Route("/createproductandcat")
     */
    public function createProductAction()
    {
        $category = new Category();
        $category->setName('Main Products');

        $product = new Product();
        $product->setName('Foobbbbbb');
        $product->setPrice(19.88);
        $product->setDescription('Lorem ipsum dolor with cat');
        // relate this product to the category
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Created product id: '.$product->getId()
            .' and category id: '.$category->getId()
        );
    }

    /**
     * @Route("/showproductwithcat/{id}")
     */
    public function showActionWithCat($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($id);


        /** @var Category $category */
        $category = $product->getCategory();

        dump(($category));

        $categoryName = $category->getName();
        $categoryId = $category->getId();

        dump(($category));

        die();
        // ...
//        return new Response(
//            'Category is '.$categoryName . ' for product ' . $id);

        return $this->render('base.html.twig');

    }
}