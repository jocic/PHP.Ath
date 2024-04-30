<?php
    
    /*******************************************************************\
    |* Author: Djordje Jocic                                           *|
    |* Year: 2024                                                      *|
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
    
    namespace Jocic\GoogleAuthenticator\Interfaces;
    
    /**
     * <i>SecretInterface</i> is an interface used to enforce implementation
     * of core methods of the class <i>Secret</i>.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2024 All Rights Reserved
     * @version   1.0.0
     */
    interface SecretInterface
    {
        /***************\
        |* GET METHODS *|
        \***************/
        
        /**
         * Returns a value of the secret.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return string
         *   Currently set value of the secret.
         */
        public function getValue() : string;
        
        /***************\
        |* SET METHODS *|
        \***************/
        
        /**
         * Sets a value of the secret.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $secret
         *   New value of the secret.
         * @return object
         *   Reference to the object calling the method - current object.
         */
        public function setValue($secret) : self;
        
        /****************\
        |* CORE METHODS *|
        \****************/
        
        /**
         * Generates a random secret that may be used for implementing MFA.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return string
         *   Value of the secret - randomly-generated.
         */
        public function generateValue() : string;
        
        /*****************\
        |* CHECK METHODS *|
        \*****************/
        
        /**
         * Checks if the provided secret is valid or not.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $secret
         *   Secret that needs to be checked.
         * @return bool
         *   Value <i>TRUE</i> if secret is valid, and vice versa.
         */
        public function isSecretValid($secret) : bool;
    }
    
?>
