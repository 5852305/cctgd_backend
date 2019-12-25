<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//轮播图Request
class BannerRequest extends Request
{
  public function attributes()
    {
        return [

        ];
    }
   public function rules()
    {
    switch($this->method())
           {
               // CREATE
               case 'POST':
               {
                   return [

                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {
                   return [

                   ];
               }
               case 'GET':
               case 'DELETE':
               default:
               {
                   return [];
               };
           }

       }

       public function messages()
       {
           return [


           ];
       }

}