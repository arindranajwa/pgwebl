<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PolygonsModel extends Model
{
    protected $table = 'polygon';

    protected $guarded = ['id'];

    public function geojson_polygons()
    {
        $polygons = $this
            ->select(DB::raw('st_asgeojson(geom) as geom,
            name,
            description, image,
            st_area(geom) as area_m, st_area(geom)/1000000 as area_km,
            st_area(geom)/10000 as area_ha,
            created_at,
            updated_at'))->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'name' => $p->name,
                    'description' => $p->description,
                    'area_m' => $p->area_m,
                    'area_km' => $p->area_km,
                    'area_ha' => $p->area_ha,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
