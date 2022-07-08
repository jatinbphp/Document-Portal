<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        
       //session()->get('loginUserType');exit;
        if(!session()->get('logged_in')){
            return redirect()->to('auth/login');
        } else {

            if(session()->get('loginUserType') == "user"){
                
               if (session()->get('loginUserType') == "admin") {
                return redirect()->to('dashboard');
                } else if (session()->get('loginUserType') == "subadmin") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "ceo") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "manager") {
                    return redirect()->to('userdashboard');
                }else if (session()->get('loginUserType') == "technician") {
                    return redirect()->to('userdashboard');
                } 

            }
            elseif(session()->get('loginUserType') == "ceo"){
                
               if (session()->get('loginUserType') == "admin") {
                return redirect()->to('dashboard');
                } else if (session()->get('loginUserType') == "subadmin") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "user") {
                    return redirect()->to('userdashboard');
                }else if (session()->get('loginUserType') == "manager") {
                    return redirect()->to('userdashboard');
                }else if (session()->get('loginUserType') == "technician") {
                    return redirect()->to('userdashboard');
                }  
            }
             elseif(session()->get('loginUserType') == "manager"){
                
               if (session()->get('loginUserType') == "admin") {
                return redirect()->to('dashboard');
                } else if (session()->get('loginUserType') == "subadmin") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "user") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "ceo") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "technician") {
                    return redirect()->to('userdashboard');
                }  
            }
             elseif(session()->get('loginUserType') == "technician"){
               
               if (session()->get('loginUserType') == "admin") {
                return redirect()->to('dashboard');
                } else if (session()->get('loginUserType') == "subadmin") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "user") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "ceo") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "manager") {
                    return redirect()->to('userdashboard');
                }  
            }
             elseif(session()->get('user_type') == 3){
                
               if (session()->get('loginUserType') == "admin") {
                return redirect()->to('dashboard');
                } else if (session()->get('loginUserType') == "technician") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "user") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "ceo") {
                    return redirect()->to('userdashboard');
                } else if (session()->get('loginUserType') == "manager") {
                    return redirect()->to('userdashboard');
                }  
            }
            
            // else{

            //     if (session()->get('loginUserType') == "admin") {
            //         return redirect()->to('dashboard');
            //     } else if (session()->get('loginUserType') == "user") {
            //         return redirect()->to('userdashboard');
            //     } else if (session()->get('loginUserType') == "ceo") {
            //         return redirect()->to('userdashboard');
            //     }else if (session()->get('loginUserType') == "manager") {
            //         return redirect()->to('userdashboard');
            //     }else if (session()->get('loginUserType') == "technician") {
            //         return redirect()->to('userdashboard');
            //     }
            // }

        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
