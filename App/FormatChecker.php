<?php

namespace App;

class FormatChecker
{
    /*Check if username passes non-nullity, not-emptiness and proper format
     *
     */
    public static function checkUsername($username)
    {
        //username guidance:  - alphanumerical chars + '.' and '_'
        //                    - has to be 3 to 20 characters long
        //                    - '.' and '_' is not allowed in the beginning or at the end
        //                    - multiple characters '.'/'_' in row are not allowed

        return ($username != null &&
            $username != '' &&
            preg_match('/^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/', $username));
    }

    /*Check if name passes non-nullity, not-emptiness and proper format
     *
     */
    public static function checkName($name)
    {
        //name guidance:    - has to start with capital
        //                  - special symbols allowed: '.' and '-'
        //                  - name has to be long in range 2 to 32 characters

        return ($name != null &&
            $name != '' &&
            preg_match('/^([A-ZÀ-ÿ][-a-z.]{1,31})$/', $name));
    }

    /*Check if surname passes non-nullity, not-emptiness and proper format
     *
     */
    public static function checkSurname($surname)
    {
        //surname guidance: - has to start with capital
        //                  - special symbols allowed: '.' and '-'

        return self::checkName($surname); //it is basically same format as name
    }

    /*Check if e-mail passes non-nullity, not-emptiness and proper format
     *
     */
    public static function checkEmail($email)
    {
        //e-mail guidance:  - pre-defined format by php

        return ($email != null &&
            $email != '' &&
            filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    /*Check if password passes non-nullity, not-emptiness and proper format
     *
     */
    public static function checkPassword($password)
    {
        //password guidance :   - has to be at least 6 character long
        //                      - no special symbols allowed
        //                      - it has to contain at least one lowercase, one capital and one number

        return ($password != null &&
            $password != '' &&
            preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,}$)/', $password));
    }

    public static function checkSearchingBarInput($input)
    {
        //searching bar input guidance:     - has to be at least 3 character long and maximum is 64
        //                                  - special symbols allowed: '.', '-' and ' '

        return ($input != null &&
            $input != '' &&
            preg_match('/\b[A-ZÀ-ÿa-z0-9-. ]{3,64}$/', $input));
    }

    public static function checkNonNullityAndNonEmptiness($input)
    {
        return $input != null && $input != "";
    }
}