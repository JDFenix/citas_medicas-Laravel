<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\User;

class WhatsAppController extends Controller
{

    private $url = 'https://graph.facebook.com/v20.0/403156569538511/messages';
    private $token = 'EAA4l1ZCjwvCYBOZCDQGrZCmovuw932YoXDTluZActC2IVjcaKgN2mj5ineCajhC84P1nygz4ATsnagjZAHFHD9gNN089oDuHyZASgwIEwNQEARGm6TGoMuKqF91khhZBQjHwkSIztLgZAQlKkomb0HQkJTUbEWQGlcRwPP8lTfVhoyTJUVnATSR8BDtj9FMu6GotUYhRWeq7AiNojKnZB06zPOoye3ZAC3lYh5cdEZD';

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


            return redirect()->route('whatsapp.verifyCodeView', ['user_id' => encrypt($user_id)])->with('success', 'Código enviado correctamente');
        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Error al enviar el mensaje');
        }
    }



    public function verifyCodeView($userIdEncrypt)
    {
        $userIdDecrypt = decrypt($userIdEncrypt);
        $user = User::findOrFail($userIdDecrypt);
        return view('whatsapp.verify', compact('user'));
    }



    public function getTemporalyPassword(Request $request)
    {
        $user = User::all()->where('email', $request['email'])->first();

        if ($user != null && $user->mobile_phone == $request['mobile_phone']) {
          
                $mobile_phone = $user['mobile_phone'];
                $passwordTemporal = rand(1000000, 9999999);
                $user->password = bcrypt($passwordTemporal);
                $user->save();

                try {
                    $data = array(
                        "messaging_product" => "whatsapp",
                        "to" => "+52" . $mobile_phone,
                        "type" => "template",
                        "template" => array(
                            "name" => "contrasena_emporal",
                            "language" => array(
                                "code" => "es"
                            ),
                            "components" => array(
                                array(
                                    "type" => "body",
                                    "parameters" => array(
                                        array(
                                            "type" => "text",
                                            "text" => $passwordTemporal
                                        ),
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
                } catch (Exception $e) {
                    return redirect()->back()->with('error', 'Error al enviar el mensaje');
                }

            return redirect()->back()->with('success', 'Contraseña temporal enviada correctamente');
        } else {
            return redirect()->back()->with('error', 'Usuario no encontrado verifica los datos ingresados');
        }
    }



    public function sendPasswordTemporal($mobile_phone, $passwordTemporal)
    {
    }


    public function verifyCode(Request $request)
    {
        $user_id = $request['id_user'];
        $code = $request['code'];
        $user = User::findOrFail($user_id);

        if ($user->code_verification == $code) {
            if ($user->code_verification_expires_at > now()) {
                $user->code_verification = null;
                $user->code_verification_expires_at = null;
                $user->status_code = 'enabled';
                $user->save();
                return redirect()->route('user.showProfile')->with('success', 'Código verificado correctamente');
            } else {
                return redirect()->back()->with('error', 'El código de verificación ha expirado');
            }
        } else {
            return redirect()->back()->with('error', 'Código de verificación incorrecto');
        }
    }
}
