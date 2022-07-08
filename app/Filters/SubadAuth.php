<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SubadAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
         if(!session()->get('logged_in')){
            return redirect()->to('auth/login');
        }
         else {
           
                if (session()->get('loginUserType') == "admin") {
                    return redirect()->to('dashboard');
                } else if ($_SESSION['user_type'] == 5) {
                    return redirect()->to('userdashboard');
                } else if ($_SESSION['user_type'] == 2) {
                    return redirect()->to('userdashboard');
                }else if ($_SESSION['user_type'] == 1) {
                    return redirect()->to('userdashboard');
                }else if ($_SESSION['user_type'] == 4) {
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
?>