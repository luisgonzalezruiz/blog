<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function authorize()
    {
        // esto no usamos por que los controles lo haremos con laravel permission
        // vamos a verificar si el usuario que viene del formulario coincide con el usuario autenticado, esto por si alguien haya cambiado
        // por abajo el id del usuario

        /*
        if($this->user_id==auth()->user()->id){
            return true;
        }else{
            return false;
        }
        */

        return true;

    }


    public function rules()
    {

        // de esta forma recupera el registro que queremos actualizar o insertat
        $post = $this->route()->parameter('post');

        // ojo no dejar espacio vacios en las reglas de validacion
        $rules =[
            'name' => 'required',
            'slug'=>'required|unique:posts',
            'status'=>'required|in:1,2',
            'file'=>'image'
        ];

        //vamos a verificar si la variable $post viene con al algun valor,
        //si viene con algo, es por que hacemos un update, por lo tanto cambiamos nuetra regla de validacion
        // reemplazamos el contenido de slug
        if($post){
            $rules['slug']='required|unique:posts,slug,' . $post->id;
        }

        // para poder agregar mas validaciones a esta array, hacemos lo siguiente
        if($this->status == 2){

            $rules_extra = [
                'category_id'=>'required',
                'tags'=>'required',
                'extract'=>'required',
                'body'=>'required'
            ];

            //fusionamos dos array
            $rules = array_merge($rules,$rules_extra);
        }

        return $rules;

    }

    /*
    También, en caso que estés usando un Form Request para controlar la validación debes agregar
    el método messages() con los mensajes personalizados que sobreescribirá dicho método
    de la clase Illuminate\Foundation\Http\FormRequest que extiende el form request:
    */
    public function messages()
    {
        return [
            'name.required' => 'Nombre no puede estar vacio',
            'slug.required' =>'El slug es requerido.',
        ];
    }

}
