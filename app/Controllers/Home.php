<?php

namespace App\Controllers;

class Home extends BaseController {

    public function home(): string {
        $data = [
            'title' => 'Home',
            'carrousel_item' => [
              0 => [
                'title' => 'El Monje Que Vendió Su Ferrari - Sharman Robin',
                'img' => 'el_monje_que_vendio_su_ferrari.webp',
                'des' => 'Lo que tenés que saber de este producto
Año de publicación: 2010
Tapa del libro: Blanda
Género: Autoayuda.
Subgénero: Desarrollo personal.
Novela.
Número de páginas: 224.
Edad mínima recomendada: 18 años.
Peso: 159g.
ISBN: 09789875665613.
Dimensiones: 12.07cm de ancho x 18.58cm de alto.'
              ]
            ]
        ];

        return view('page/home', $data);
    }

    public function catalogo(): string {
        $data = [
            'title' => 'Catalogo'
        ];

        return view('page/catalogo', $data);
    }

    public function contact(): string {
        $data = [
            'title' => 'Contact'
        ];

        return view('page/contact', $data);
    }

}
