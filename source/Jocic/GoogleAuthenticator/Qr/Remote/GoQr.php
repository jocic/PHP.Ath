<?php
    
    /*******************************************************************\
    |* Author: Djordje Jocic                                           *|
    |* Year: 2018                                                      *|
    |* License: MIT License (MIT)                                      *|
    |* =============================================================== *|
    |* Personal Website: http://www.djordjejocic.com/                  *|
    |* =============================================================== *|
    |* Permission is hereby granted, free of charge, to any person     *|
    |* obtaining a copy of this software and associated documentation  *|
    |* files (the "Software"), to deal in the Software without         *|
    |* restriction, including without limitation the rights to use,    *|
    |* copy, modify, merge, publish, distribute, sublicense, and/or    *|
    |* sell copies of the Software, and to permit persons to whom the  *|
    |* Software is furnished to do so, subject to the following        *|
    |* conditions.                                                     *|
    |* --------------------------------------------------------------- *|
    |* The above copyright notice and this permission notice shall be  *|
    |* included in all copies or substantial portions of the Software. *|
    |* --------------------------------------------------------------- *|
    |* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, *|
    |* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES *|
    |* OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND        *|
    |* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT     *|
    |* HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,    *|
    |* WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, RISING     *|
    |* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR   *|
    |* OTHER DEALINGS IN THE SOFTWARE.                                 *|
    \*******************************************************************/
    
    namespace Jocic\GoogleAuthenticator\Qr\Remote;
    
    use Jocic\GoogleAuthenticator\Qr\QrInterface;
    use Jocic\GoogleAuthenticator\Qr\QrCore;
    use Jocic\GoogleAuthenticator\Account;
    
    /**
     * <i>GoQr</i> class is used for generating QR codes using pubilcly
     * available GoQr's API.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2018 All Rights Reserved
     * @version   1.0.0
     */
    
    class GoQr extends RemoteQrCore implements QrInterface,
        RemoteQrInterface
    {
        /******************\
        |* CORE CONSTANTS *|
        \******************/
        
        // CORE CONSTANTS GO HERE
        
        /******************\
        |* CORE VARIABLES *|
        \******************/
        
        // CORE VARIABLES GO HERE
        
        /*******************\
        |* MAGIC FUNCTIONS *|
        \*******************/
        
        // MAGIC FUNCTIONS GO HERE
        
        /***************\
        |* GET METHODS *|
        \***************/
        
        /**
         * Forms and returns an appropriate URL for that can be used for
         * generating QR codes remotely by sending a GET request.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2018 All Rights Reserved
         * @version   1.0.0
         * 
         * @param object $account
         *   Account that should be used for generating the QR code.
         * @return string
         *   Formed url that can be used for generating QR codes.
         */
        
        public function getUrl($account)
        {
            // Core Variables
            
            $codeSize = $this->getQrCodeSize();
            
            // Format Variables
            
            $otpFormat  = "otpauth://totp/%s?secret=%s";
            $urlFormat  = "https://api.qrserver.com/v1/create-qr-code/?" .
                "size=%s&data=%s";
            
            // Other Variables
            
            $otpRequest = "";
            $identifier = "";
            $secret     = "";
            
            // Step 1 - Check Account Object
            
            if (!($account instanceof Account))
            {
                throw new \Exception("Invalid object provided.");
            }
            
            // Step 2 - Check Account Secret
            
            if ($account->getAccountSecret() == null)
            {
                throw new \Exception("Set account is without a secret.");
            }
            
            // Step 3 - Check Account Details
            
            if ($account->getServiceName() == "" && $account->getAccountName() == "")
            {
                throw new \Exception("Set account is without details.");
            }
            
            // Step 4 - Generate Identifier & Secret
            
            if ($account->getServiceName() != "")
            {
                $identifier .= $account->getServiceName();
            }
            
            if ($account->getAccountName() != "")
            {
                if ($identifier != "")
                {
                    $identifier .= " - ";
                }
                
                $identifier .= $account->getAccountName();
            }
            
            $secret = $account->getAccountSecret()->getValue();
            
            // Step 5 - Generate & Return URL
            
            $otpRequest = sprintf($otpFormat, $identifier, $secret);
            
            return sprintf($urlFormat, ($codeSize . "x" . $codeSize), urlencode($otpRequest));
        }
        
        /***************\
        |* SET METHODS *|
        \***************/
        
        // SET METHODS GO HERE
        
        /****************\
        |* CORE METHODS *|
        \****************/
        
        // CORE METHODS GO HERE
        
        /*****************\
        |* CHECK METHODS *|
        \*****************/
        
        // CHECK METHODS GO HERE
        
        /*****************\
        |* OTHER METHODS *|
        \*****************/
        
        // OTHER METHODS GO HERE
    }
    
?>