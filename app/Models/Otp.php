<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Otp extends Model
{
    protected $fillable = ['identifier', 'token','valid'];
    
    /**
     * Generate a new OTP for the given email address.
     *
     * @param string $email The email address to generate an OTP for.
     *
     * @return Otp The newly generated OTP.
     */
    public static function generate($email)
    {
        $otp = new static;
        $otp->identifier = $email;
        $otp->token = mt_rand(100000, 999999);
      

        $otp->valid = true;
        $otp->save();

        return $otp;
    }

    /**
     * Get the token value of the OTP.
     *
     * @return int The token value of the OTP.
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Check if the given email and code match a valid OTP.
     *
     * @param string $email The email address to check.
     * @param string $code The code to check.
     *
     * @return bool True if the email and code match a valid OTP, false otherwise.
     */
    public function check(string $email, string $code)
    {
        // Check if OTP code is valid
        $otp = $this->where('identifier', $email)->where('token', $code)->first();

        return $otp ? true : false;
    }

    /**
     * Verify if the given email and code match a valid OTP that is still within its validity period.
     * If a matching OTP is found, its 'valid' flag is set to false to mark it as used.
     *
     * @param string $email The email address to verify.
     * @param string $code The code to verify.
     *
     * @return bool True if the email and code match a valid OTP that is still within its validity period, false otherwise.
     */
    public function validate($identifier, $token)
    {
        $otp = Otp::where('identifier', $identifier)
            ->where('token', $token)
            
            ->where('valid', true)
            ->first();
    
        if (!$otp) {
            return false;
        }
    
        $otp->valid = false;
        $otp->save();
    
        return true;
    }
    
    

}





