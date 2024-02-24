<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ReCaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
      $client = new \GuzzleHttp\Client();
      $request = $client->get("https://www.google.com/recaptcha/api/siteverify?secret=".env('GOOGLE_RECAPTCHA_SECRET').'&response='.$value);
      $response = $request->getBody()->getContents();

      return json_decode($response)->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The google recaptcha is required.';
    }
}
