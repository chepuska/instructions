<?php
namespace App\Filters;
//use \CodeIgniter\Filters\FilterInterface;
class AuthFilter implements \CodeIgniter\Filters\FilterInterface
{
    public function before(\CodeIgniter\HTTP\RequestInterface $request, $arguments = null)
    {
        // TODO: Implement before() method.
        $session = session();
        if($session->get('is_logged')!==true){
            return redirect()->to('/');
        }

    }

    public function after(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}