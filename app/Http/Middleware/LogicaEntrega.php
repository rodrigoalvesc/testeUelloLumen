<?php

namespace App\Http\Middleware;

use Closure;

class LogicaEntrega
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
        $ordem = app('db')->select('SELECT * FROM clientes');

        $inicio = "Avenida Dr. Gastão Vidigal, 1132 - Vila Leopoldina - 05314-010";

        $address = utf8_encode(str_replace(" ", "+", $inicio)); 
        
        $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&key=' . env('API_GOOGLE'));
        $output = json_decode($geocode);
        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;

        $ordemDistance = [];

        while (!empty($ordem)) {
            $distances = array();
            
            foreach ($ordem as $key => $cliente)
            {
                $distances[$key] = $this->distance($lat, $long, $cliente->lat, $cliente->lng);
            }
            
            asort($distances);
            $keyDist = key($distances);
            
            $ordem[$keyDist]->distancia = array_shift($distances);
            $ordemDistance[] = $ordem[$keyDist];
            
            $lat = $ordem[$keyDist]->lat;
            $long = $ordem[$keyDist]->lng;
            unset($ordem[$keyDist]);
        }

        return view('ordem', ['ordem' => $ordemDistance]);
    }

    function distance($lat1, $lon1, $lat2, $lon2) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $km = $dist * 60 * 1.1515 * 1.609344;
            
            return $km;
        }
    }
      
}
