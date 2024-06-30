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
    
    // Step 1 - Define Autoload Function
    
    /**
     * Loads a desired class from the project's source directory.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2024 All Rights Reserved
     * @version   1.0.0
     * 
     * @param string $class_name
     *   Name of the class, ex. <i>Jocic\GoogleAuthenticator\Secret</i>.
     * @return bool
     *   Value <i>TRUE</i> if the class was included, and vice versa.
     */
    
    function load_google_authenticator_class($class_name)
    {
        // Core Variables
        
        $class_location = join(DIRECTORY_SEPARATOR, [
            __DIR__,
            str_replace("\\", DIRECTORY_SEPARATOR, $class_name)
        ]) . ".php";
        
        // Logic
        
        if (class_exists($class_name)) {
            return true;
        }
        
        if (is_file($class_location))
        {
            include $class_location;
            
            return true;
        }
        
        return false;
    }
    
    // Step 2 - Register Autoload Function
    
    spl_autoload_register("load_google_authenticator_class");
    
?>
