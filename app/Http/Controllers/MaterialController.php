<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialLearning;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request){
        $data = $request->validate([
            'MaterialName' => 'required',
            'MaterialType' => 'required',
            'MaterialPath' => 'required',
        ]);

        $latestMaterial = Material::latest('MaterialID')->first();
        $latestMaterialID = $latestMaterial ? substr($latestMaterial->MaterialID, 1) : 0;
        $newMaterialID = 'M' . str_pad((intval($latestMaterialID) + 1), 8, '0', STR_PAD_LEFT);

        Material::create([
            'MaterialID' => $newMaterialID,
            'MaterialName' => $data['MaterialName'],
            'MaterialType' => $data['MaterialType'],
            'MaterialPath' => $data['MaterialPath'],
        ]);

        MaterialLearning::create([
            'MaterialID' => $newMaterialID,
            'SessionLearningID' => $request->SessionID
        ]);

        return redirect($request->PreviousURL)->with('success', 'Material added successfully');
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

    public function destroy(Request $request){
        $material = Material::where('MaterialID', $request->MaterialID)->firstOrFail();
        $material->delete();


        return redirect($request->PreviousURL)->with('success', 'Data saved successfully');
    }

    public function edit(Request $request){
        $material = Material::where('MaterialID', $request->MaterialID)->firstOrFail();

        return view('MaterialEdit', ['material' => $material, 'CourseID' => $request->CourseID, 'SessionID' => $request->SessionID, 'MaterialID' => $request->MaterialID]);
    }

    public function add(Request $request){
        return view('MaterialAdd', ['CourseID' => $request->CourseID, 'SessionID' => $request->SessionID]);
    }
    public function getMaterialById($id){
        $material = Material::where('MaterialID', '=', $id)->first();
        return $material;
    }
}
