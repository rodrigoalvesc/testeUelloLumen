<?php

namespace App\Http\Middleware;

use Closure;

class InsertClientes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $file = $request->file('upload');

        if (!$file->isValid()) {
            return $file->getErrorMessage();
        }
        
        $pathTemp = fopen($file->getPathName(), 'r');

        $headers = fgetcsv($pathTemp, 10000, ';');
        $csv = [];
        
        while (($data = fgetcsv($pathTemp, 10000, ';')) !== FALSE) {
            $csv[] = array_combine($headers, $data);
        }

        foreach ($csv as $index => $cliente) {
            $endereco = explode(" - ", $cliente['endereco']);
            $logradouro = explode(", ", $endereco[0]);
            $numero = explode(" ", $logradouro[1]);

            $address = utf8_encode(str_replace(" ", "+", $cliente['endereco'])); 
            
            $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&key=' . env('API_GOOGLE'));
            $output = json_decode($geocode);
            $lat = $output->results[0]->geometry->location->lat;
            $long = $output->results[0]->geometry->location->lng;    

            $csv[$index]['endereco'] = [
                'logradouro' => $logradouro[0],
                'numero' => array_shift($numero),
                'complemento' => implode(' ', $numero),
                'bairro' => $endereco[1],
                'cidade' => $endereco[2],
                'lat' => $lat,
                'long' => $long
            ];
            
            $date = \DateTime::createFromFormat('d/m/Y', $cliente['datanasc']);
            $datanasc = $date->format('Y-m-d');

            try {
                app('db')->insert('INSERT INTO clientes (nome, email, datanasc, cpf, logradouro, numero, complemento, bairro, cidade, cep, lat, lng)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                    $cliente['nome'], 
                    $cliente['email'], 
                    $datanasc, 
                    str_replace(['.',',','-','/',' '], '', $cliente['cpf']), 
                    $csv[$index]['endereco']['logradouro'], 
                    $csv[$index]['endereco']['numero'], 
                    $csv[$index]['endereco']['complemento'], 
                    $csv[$index]['endereco']['bairro'], 
                    $csv[$index]['endereco']['cidade'], 
                    str_replace(['.',',','-','/',' '], '', $cliente['cep']),
                    $csv[$index]['endereco']['lat'], 
                    $csv[$index]['endereco']['long']
                ]);    
            } catch (\Throwable $e) {
                error_log( 'Connection failed: ' . $e->getMessage());
            }
        }

        return view('dataSaved', ['csv' => $csv]);
    }
}
