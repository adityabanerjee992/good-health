<?php namespace App\Acme\Transformers;
                                
class UserAccountInformationTransformer extends Transformer
{
    public function transform($userAccountInformation)
    {        
        return [
            'name'   => $userAccountInformation['name'],
            'gender' => $userAccountInformation['gender'],
            'email' => $userAccountInformation['email'],
            'mobile' => $userAccountInformation['phone']
        ];
    }
}
