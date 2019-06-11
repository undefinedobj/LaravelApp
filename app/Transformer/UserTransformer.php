<?php


namespace App\Transformer;


class UserTransformer extends Transformer
{
    public function transformer($user)
    {
        return [
            'name'              => $user['name'],
            'email'             => $user['email'],
            'email_verified_at' => $user['email_verified_at'],
        ];
    }

}
