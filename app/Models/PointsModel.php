<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PointsModel extends Model
{
    protected $table = 'points'; //menghubungkan model dengan tabel points

    protected $guarded = ['id'];

    public function geojson_points() //mengambil data dari database dan mengubahnya menjadi geojson
    {
        $points = $this
            ->select(DB::raw('points.id, st_asgeojson(points.geom) as geom,
            points.name,
            points.description, points.image,
            points.created_at,
            points.updated_at,
            points.user_id,
            users.name as user_created'))
            // menghubungkan tabel points dengan tabel users
            ->leftJoin('users', 'points.user_id', '=', 'users.id')
            ->get(); //mengambil data dari database

        $geojson = [
            'type' => 'FeatureCollection', //mengubah data menjadi geojson
            'features' => [],
        ];

        foreach ($points as $p) { //mengambil data dari database
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom), //mengubah data menjadi geojson
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                    'user_id' => $p->user_id,
                    'user_created' => $p->user_created,

                ],
            ];

            array_push($geojson['features'], $feature); //menambahkan data ke dalam array
        }

        return $geojson;
    }

    public function geojson_point($id) //mengambil data dari database dan mengubahnya menjadi geojson
    {
        $points = $this
            ->select(DB::raw('id, st_asgeojson(geom) as geom, name,
            description, image, created_at, updated_at'))
            ->where('id', $id)
            ->get(); //mengambil data dari database

        $geojson = [
            'type' => 'FeatureCollection', //mengubah data menjadi geojson
            'features' => [],
        ];

        foreach ($points as $p) { //mengambil data dari database
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom), //mengubah data menjadi geojson
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                ],
            ];

            array_push($geojson['features'], $feature); //menambahkan data ke dalam array
        }

        return $geojson;
    }
}
