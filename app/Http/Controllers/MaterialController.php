<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(){
        $materials = Material::all();

        return view('material', ['materials' => $materials]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'MaterialName' => 'required',
            'MaterialType' => 'required',
            'MaterialPath' => 'required',
        ]);

        Material::create([
            'MaterialName' => $data['MaterialName'],
            'MaterialType' => $data['MaterialType'],
            'MaterialPath' => $data['MaterialPath'],
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $MaterialID){
        $data = $request->validate([
            'MaterialName' => 'required',
            'MaterialType' => 'required',
            'MaterialPath' => 'required',
        ]);

        $material = Material::findOrFail($MaterialID);

        $material->MaterialName = $data['MaterialName'];
        $material->MaterialType = $data['MaterialType'];
        $material->MaterialPath = $data['MaterialPath'];
        $material->save();

        return redirect()->back();
    }

    public function delete($MaterialID){
        $material = Material::findOrFail($MaterialID);
        $material->delete();

        return redirect()->back();
    }
}
