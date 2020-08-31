<?php

namespace App\Controller;

use App\Entity\Buyer;
use App\Entity\Product;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * @Route("/api", name="api")
 */
class BuyerController extends AbstractController
{
    /**
     * @Route("/showproduct", name="show.product")
     */
    public function showProduct()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository(Product::class)->findAll();
        $ser = SerializerBuilder::create()->build();
        $json = $ser->serialize($products, 'json');
        return new Response($json);
    }

    /**
     * @Route("/showbuyer", name="show.buyer")
     */
    public function showBuyer()
    {
        $em = $this->getDoctrine()->getManager();

        $buyers = $em->getRepository(Buyer::class)->findAll();
        $ser = SerializerBuilder::create()->build();
        $json = $ser->serialize($buyers, 'json');
        return new Response($json);
    }


    /**
     * @Route("/createbuyer", name="create.buyer")
     * @param Request $request
     * @return Response
     */
    public function createBuyer(Request $request)
    {
        $data = $request->getContent();
        $ser = SerializerBuilder::create()->build();
        $buyers = $ser->deserialize($data, Buyer::class, 'json');
        $products = $ser->deserialize($data, Product::class, 'json');
        $products->setBuyer($buyers);
        $products->setStatus('Новый');
        $validator = Validation::createValidator();
        $buyers_errors = $validator->validate($buyers);
        $products_errors = $validator->validate($products);
        if (count($products_errors) > 0 || count($products_errors) > 0){
            $errorsString = (string) $buyers_errors . PHP_EOL . (string) $products_errors;
            return new Response($errorsString);
        }
        else{
            $em = $this->getDoctrine()->getManager();
            $em->persist($buyers);
            $em->persist($products);
            $em->flush();
            return new JsonResponse(1, Response::HTTP_OK);
        }
    }

    /**
     * @Route("/updateproduct", name="update.product")
     * @param Request $request
     * @return Response
     */
    public function updateProduct(Request $request)
    {
        $id = $request->request->get('nameId');
        $status = $request->request->get('status');
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        $product->setStatus($status);
        $em->persist($product);
        $em->flush();
        return $this->redirect('/#/show_products');
    }
}
