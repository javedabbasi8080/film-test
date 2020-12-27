<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Film;
use App\Gallery;
use App\Rating;

class AddFilm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|unique:films,name',
            'description'   => 'required',
            'release_date'  => 'required',
            'rating'        => 'required',
            'ticket_price'  => 'required',
            'country' => 'required',
            'genre'   => 'required',
            'photo'   => 'required'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function message(){
        return [
            'required'              => ':Attribute is required.',
        ];
    }

    /**
     * Return validation errors as json response
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'status' => 'failure',
            'status_code' => 400,
            'message' => 'Bad Request',
            'errors' => $validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response, 400));
    }

    public function process()
    {

        $user = \Auth::user();
    
        $film = Film::create([
            'name'          => $this->name,    
            'description'   => $this->description,   
            'release_date'  => $this->release_date,   
            'ticket_price'  => $this->ticket_price,    
            'country'       => $this->country,
            'slugs'         => str_replace(' ', '-', $this->name)
        ]);

        // genre array
        $film->genre()->attach($this->genre);

        $film->ratting()->saveMany([
             new Rating(['rat_no'  => $this->rating , 'user_id' => $user->id])
        ]);

        if ($this->has('photo')) {
            
            // rename the image name
            $imageName = $film->id.'-'.str_replace(' ', '_', $this->photo->getClientOriginalName());  
            // uploading image in uploads folder        
            $this->photo->move(public_path('uploads'), $imageName);
            // save image with path name
            Gallery::create([
                'name'      => $this->photo->getClientOriginalName(),
                'path'      => 'uploads/'.$imageName,
                'source_id' => $film->id,
                'type'      => 'film'
            ]);

        }

        return response()->json([
            'status'  => TRUE,
            'code'    => 200,
            'data' => 'Film Added!', 
            'redirect' => url('/film')
            ],200);

    }
}
