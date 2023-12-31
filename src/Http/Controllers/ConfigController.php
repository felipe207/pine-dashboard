<?php

namespace Brediweb\BrediDashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brediweb\ImagemUpload\ImagemUpload;
use Brediweb\BrediDashboard\Models\Config;

class ConfigController extends Controller
{
    public function __construct()
    {
        // $this->vendor = config('BrediDashboard.templates')[config('BrediDashboard.default')];
        // $this->background_image = config('BrediDashboard.background_image');
        // $this->logo = config('BrediDashboard.logo');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        $config = Config::first();
        return view('controle.config.form', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $input = $request->except('_token');

        $background_image = ImagemUpload::salva([
            'input_file' => 'background_image',
            'destino' => 'background_image/',
            'resolucao' => ['h' => 1280, 'w' => 1280]
        ]);
        if ($background_image) {
            $input['config']['layout']['background_image'] = $background_image;
        }
        $logo = ImagemUpload::salva([
            'input_file' => 'logo',
            'destino' => 'company/',
            'resolucao' => ['g' => ['h' => 30, 'w' => 100], 'p' => ['h' => 200, 'w' => 200]]
        ]);
        if ($logo) {
            $input['config']['layout']['logo'] = $logo;
        }

        try {
            $config = Config::first();

            if(isset($config->id)) {
                $input = $this->atualizaRegistro($config, $input);

                $config->update($input);

            } else {
                Config::create($input);
            }

            return redirect()->back()->with('msg', 'Atualização realizada com sucesso!');
        } catch (\Exceptio $e) {
            return redirect()->back()->with('msg', 'Erro ao atusalizar registros')->with('error', true)->with('exception', $e->getMessage());
        }
    }

   function atualizaRegistro($config, $input)
   {
       if (isset($input['config'])) {
            $input['config']['layout'] = (!empty($config->config['layout'])) ? array_merge($config->config['layout'], $input['config']['layout']) : $input['config']['layout'];
            // dd($config->config, $input['config']);
            // $input['config'] = (!empty($config->config)) ? array_merge($config->config, $input['config']) : $input['config'];
            // dd($input);
        }

        return $input;
   }
    /**
     * Faz upload de imagens do summernote
     * @return Response
     */
    public function uploadEditor(Request $request)
    {
        $imagem = ImagemUpload::salva(['input_file' => 'file', 'destino' => 'upload']);//, 'resolucao' => ['p' => ['w' => 100, 'h' => 100], 'm' => ['w' => 100, 'h' => 100]]

        return route('imagem.render', 'upload/' . $imagem);

    }

    public function deleteImageEditor(Request $request)
    {
        $nomeImagem = explode("/", $request->get('image'));
        $deleteImagem = ImagemUpload::deleta(['imagem' => end($nomeImagem), 'destino' => 'upload']);

        return response(['status' => $deleteImagem]);
    }
}
