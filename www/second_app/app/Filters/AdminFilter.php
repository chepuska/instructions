<?php


namespace App\Filters;


class AdminFilter implements \CodeIgniter\Filters\FilterInterface
{
    public function before(\CodeIgniter\HTTP\RequestInterface $request, $arguments = null)
    {
        // TODO: Implement before() method.
        $session = session();
        if($session->get('id_category')!= 1){
            return redirect()->to('/');
        }

    }

    public function after(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}