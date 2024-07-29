<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\User;

class WhatsAppController extends Controller
{

    private $url = 'https://graph.facebook.com/v20.0/403156569538511/messages';
    private $token = 'EAA4l1ZCjwvCYBOZB1MgTAfEzNdqxOofaA3dW0hk1ye75lRFnZBKxddqUfZARk6MTWucufZCMFa22pvoZCDNkxGLo9fX7KoEl9PPPIZCgrO9znNesgxqM1lUjJSacFZCnGAfsZABcjRxsZBlx7Bxym96ZB15gaQpZB3HV0XZBZA956G7Wi2pDBrI4iUoyfbmwcURZA2ZBCmUtwkvbsZBBywZAzWOsZBmOPZADY1r0zJik8kuZCeWsZD';

    public function sendCode(Request $request)
    {
        try {
            $user_id = $request['id_user'];
            $name = $request['name'];
            $mobile_phone = $request['mobile_phone'];
            $code_verification = rand(1000, 9999);
            $expires_at = now()->addMinutes(10);
    
            $data = array(
                "messaging_product" => "whatsapp",
                "to" => "+52" . $mobile_phone,
                "type" => "template",
                "template" => array(
                    "name" => "codigo_verificacion",
                    "language" => array(
                        "code" => "es"
                    ),
                    "components" => array(
                        array(
                            "type" => "body",
                            "parameters" => array(
                                array(
                                    "type" => "text",
                                    "text" => $name
                                ),
                                array(
                                    "type" => "text",
                                    "text" => $code_verification
                                )
                            )
                        )
                    )
                )
            );
    
            $data_string = json_encode($data);
            $curl = curl_init($this->url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array(
                    'Authorization: Bearer ' . $this->token,
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string)
                )
            );
            curl_exec($curl);
            curl_close($curl);
    
            $user = User::findOrFail($user_id);
            $user->mobile_phone = $mobile_phone;
            $user->code_verification = $code_verification;
            $user->code_verification_expires_at = $expires_at;
            $user->save();
    
            return redirect()->back()->with('success', 'Mensaje enviado correctamente');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al enviar el mensaje');
        }
    }
}
