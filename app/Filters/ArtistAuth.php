<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ArtistAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
         if(!session()->get('logged_in')){
            return redirect()->to('auth/login');
        } else {

            
            if (session()->get('loginUserType') == "admin") {
                return redirect()->to('dashboard');
            } else if (session()->get('loginUserType') == "subadmin") {
                return redirect()->to('userdashboard');
            } else if (session()->get('loginUserType') == "ceo") {
                return redirect()->to('userdashboard');
            }
            
        }

    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
