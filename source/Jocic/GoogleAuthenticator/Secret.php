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
    
    namespace Jocic\GoogleAuthenticator;
    
    use Jocic\Encoders\Base\Base32;
    
    /**
     * <i>Secret</i> class is used for generating secrets required for one-time
     * password generation and validation of the same.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2024 All Rights Reserved
     * @version   1.0.0
     */
    class Secret implements Interfaces\SecretInterface
    {
        /******************\
        |* CORE CONSTANTS *|
        \******************/
        
        /**
         * Method constant for generating secrets using the <i>base</i>
         * creation method - picking random <i>Base 32</i> values until an
         * 80-bit long secret is generated.
         * 
         * @var    integer
         * @access public
         */
        const M_BASE = 0;
        
        /**
         * Method constant for generating secrets using the <i>numerical</i>
         * creation method - picking random numbers between 0 and 256 until an
         * 80-bit long secret is generated.
         * 
         * @var    integer
         * @access public
         */
        const M_NUMERICAL = 1;
        
        /**
         * Method constant for generating secrets using the <i>binary</i>
         * creation method - picking random bits until an 80-bit long secret
         * is generated.
         * 
         * @var    integer
         * @access public
         */
        const M_BINARY = 2;
        
        /******************\
        |* CORE VARIABLES *|
        \******************/
        
        /**
         * Set or generated value of the secret.
         * 
         * @var    string
         * @access private
         */
        private $value = "";
        
        /*******************\
        |* MAGIC FUNCTIONS *|
        \*******************/
        
        /**
         * Generic PHP constructor for the class <i>Secret</i>.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $value
         *   Value that should be set.
         */
        public function __construct($value = null)
        {
            // Logic
            
            if ($value == null)
            {
                $value = $this->generateValue();
            }
            
            $this->setValue($value);
        }
        
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
        public function getValue() : string
        {
            // Logic
            
            return $this->value;
        }
        
        /**
         * Returns an instantiated <i>Base 32</i> encoder object.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return object
         *   Instantiated <i>Base 32</i> encoder object.
         */
        private function getEncoder() : Base32
        {
            // Logic
            
            if ($this->encoder == NULL) {
                $this->encoder = new Base32();
            }
            
            return $this->encoder;
        }
        
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
        public function setValue($secret) : self
        {
            // Logic
            
            if (!$this->isSecretValid($secret))
            {
                throw new \Exception("Invalid secret provided: \"$secret\"");
            }
            
            $this->value = $secret;
            
            return $this;
        }
        
        /****************\
        |* CORE METHODS *|
        \****************/
        
        /**
         * Generates a random secret that may be used for implementing MFA.
         * 
         * Note: Secrets are random 80-bit values encoded using BASE32.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param integer $method
         *   Method used for generating the secret. Default value
         *   corresponds to the <i>M_BASE</i> constant.
         * @return string
         *   Value of the secret - randomly-generated.
         */
        public function generateValue($method = self::M_BASE) : string
        {
            // Core Variables
            
            $value = "";
            
            // Logic
            
            switch ($method)
            {
                case self::M_BASE:
                    $value = $this->generateValue__BASE();
                    break;
                
                case self::M_NUMERICAL:
                    $value = $this->generateValue__NUMERICAL();
                    break;
                
                case self::M_BINARY:
                    $value = $this->generateValue__BINARY();
                    break;
                
                default:
                    throw new \Exception("Invalid method selected.");
            }
            
            return $value;
        }
        
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
        public function isSecretValid($secret) : bool
        {
            // Core Variables
            
            $baseTable = $this->getEncoder()->getBaseTable();
            
            // Other Variables
            
            $characters = str_split($secret);
            
            // Step 1 - Check Length
            
            if (count($characters) < 8)
            {
                return false;
            }
            
            // Step 2 - Check Characters
            
            foreach ($characters as $character)
            {
                if (!in_array($character, $baseTable))
                {
                    return false;
                }
            }
            
            return true;
        }
        
        /*****************\
        |* OTHER METHODS *|
        \*****************/
        
        /**
         * Generates a random secret using the <i>base</i> method.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return string
         *   Value of the secret - randomly-generated.
         */
        private function generateValue__BASE() : string
        {
            // Core Variables
            
            $baseTable = $this->getEncoder()->getBaseTable();
            
            // Other Variables
            
            $value    = "";
            $maxIndex = count($baseTable) - 1;
            $index    = 0;
            
            // Logic
            
            for ($i = 0; $i < 16; $i ++)
            {
                $index  = rand(0, $maxIndex);
                $value .= $baseTable[$index];
            }
            
            return $value;
        }
        
        /**
         * Generates a random secret using the <i>numerical</i> method.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return string
         *   Value of the secret - randomly-generated.
         */
        private function generateValue__NUMERICAL() : string
        {
            // Core Variables
            
            $value  = "";
            $number = 0;
            
            // Logic
            
            for ($i = 0; $i < 10; $i ++)
            {
                $number = rand(0, 256);
                $value .= sprintf("%c", $number);
            }
            
            return $this->getEncoder()->encode($value);
        }
        
        /**
         * Generates a random secret using the <i>binary</i> method.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return string
         *   Value of the secret - randomly-generated.
         */
        private function generateValue__BINARY() : string
        {
            // Core Variables
            
            $value = "";
            $byte  = 0;
            
            // Logic
            
            for ($i = 0; $i < 10; $i ++)
            {
                $byte = 0;
                
                for ($j = 0; $j < 8; $j ++)
                {
                    $byte = ($byte << 1) | rand(0, 1);
                }
                
                $value .= sprintf("%c", $byte);
            }
            
            return $this->getEncoder()->encode($value);
        }
    }
    
?>
