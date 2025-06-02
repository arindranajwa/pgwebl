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
            ->select(DB::raw('polygon.id, st_asgeojson(polygon.geom) as geom,
            polygon.name,
            polygon.description, polygon.image,
            st_area(polygon.geom) as area_m, st_area(polygon.geom)/1000000 as area_km,
            st_area(polygon.geom)/10000 as area_ha,
            polygon.created_at,
            polygon.updated_at'))
            ->leftJoin('users', 'polygon.user_id', '=', 'users.id')
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'area_m' => $p->area_m,
                    'area_km' => $p->area_km,
                    'area_ha' => $p->area_ha,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                    'user_id' => $p->user_id,
                    'user_created' => $p->user_created,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }

    public function geojson_polygon($id)
    {
        $polygons = $this
            ->select(DB::raw('id, st_asgeojson(geom) as geom,
            name,
            description, image,
            st_area(geom) as area_m, st_area(geom)/1000000 as area_km,
            st_area(geom)/10000 as area_ha,
            created_at,
            updated_at'))
            ->where('id', $id)
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
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
