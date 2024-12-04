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

    public function update(Request $request){
        $data = $request->validate([
            'MaterialName' => 'required',
            'MaterialType' => 'required',
            'MaterialPath' => 'required',
        ]);

        $material = Material::where('MaterialID', $request->MaterialID)->firstOrFail();

        if($material){
            $material->MaterialName = $data['MaterialName'];
            $material->MaterialType = $data['MaterialType'];
            $material->MaterialPath = $data['MaterialPath'];
            $material->save();
        }

        return redirect($request->PreviousURL)->with('success', 'Data saved successfully');
    }

    public function delete($MaterialID){
        $material = Material::where('MaterialID', $MaterialID)->firstOrFail();
        $material->delete();

        return redirect()->back();
    }

    public function edit(Request $request){
        $material = Material::where('MaterialID', $request->MaterialID)->firstOrFail();

        return view('MaterialEdit', ['material' => $material, 'CourseID' => $request->CourseID, 'SessionID' => $request->SessionID, 'MaterialID' => $request->MaterialID]);
    }
}
