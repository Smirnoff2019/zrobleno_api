<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EncryptController extends Controller
{

    private $dataString = "", $encryptKey = "";
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'orderReference' => 'required|string',
            'orderDate' => 'required',
            'amount' => 'required|integer',
            'currency' => 'required|string',
            'productName' => 'required',
            'productCount' => 'required',
            'productPrice' => 'required',
            'merchantAccount' => 'required',
            'merchantDomainName' => 'required'
        ]);

        $this->initDate();
        $this->generateDate($request);

        return response()->json(['string' => $this->dataString, 'signature' => $this->generateDate($request), 'cryptkey' => $this->encryptKey]);
    }

    private function initDate () {
        $this->encryptKey = "24d5682032a79fcfd8faf5e692537ead33a1d59c";
    }

    private function generateDate (Request $request) {

        $items = $request->except('merchantSignature');

        $this->dataString = "";

        $count = count($items);

        foreach ($items as $key => $item) {
            $count = $count - 1;
            if(is_array($item)){

                foreach ($item as $key_ => $subitem) {
                    $delimetr = ";";

                    if($key_ + 1 == count($item) && $count == 0)
                    {
                        $delimetr = "";
                    }
                    $this->dataString .= $subitem .$delimetr;
                }
            }else {
                $delimetr = ";";

                if($count == 0)
                {
                    $delimetr = "";
                }

                $this->dataString .= $item . $delimetr;
            }
        }

        return $this->encrypt();
    }

    private function encrypt () {
        return hash_hmac("md5", $this->dataString, $this->encryptKey);
    }

}
