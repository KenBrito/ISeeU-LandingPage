<?php

namespace App\Http\Controllers;

use Newsletter;
use Mailchimp;

use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\Exception;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
       
        /*
        if(! Newsletter::isSubscribed($request->email)){

            Newsletter::subscribePending($request->email);

            return back()->with("success","O seu email foi enviado, por favor confirma a sua caixa de email.");
        }
         */

        if ($request['email']) {
            if (Mailchimp::check('145f5f931a', $request['email'])) {

                if ($request['form'] == '1') {
                    return back()->with("erro1", "Este email ja se encontra registado!");
                } else {
                    return back()->with("erro2", "Este email ja se encontra registado!");
                }
            }


            Mailchimp::subscribe(

                '145f5f931a', //list id
                $request['email'],
                [],
                false
            );

            return view('confirmationpage');

        }
        else{
            return redirect()->back();
        }
    }


}
