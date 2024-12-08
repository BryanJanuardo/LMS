<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialLearning;
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
            'MaterialPath' => 'nullable|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:2048',
        ]);

        $latestMaterial = Material::latest('MaterialID')->first();
        $latestMaterialID = $latestMaterial ? substr($latestMaterial->MaterialID, 1) : 0;
        $newMaterialID = 'M' . str_pad((intval($latestMaterialID) + 1), 8, '0', STR_PAD_LEFT);
        $File = null;

        if ($request->hasFile('MaterialPath')) {
            $extension = $request->file('MaterialPath')->getClientOriginalExtension();
            $File = 'Material_' .  $newMaterialID . '.' . $extension;
            $request->file('MaterialPath')->storeAs('public/Material', $File);
        }

        Material::create([
            'MaterialID' => $newMaterialID,
            'MaterialName' => $data['MaterialName'],
            'MaterialType' => $data['MaterialType'],
            'MaterialPath' => $File,
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
            'MaterialPath' => 'nullable|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:2048',
        ]);

        $material = Material::where('MaterialID', $request->MaterialID)->firstOrFail();

        $File = null;

        if ($request->hasFile('MaterialPath')) {
            $extension = $request->file('MaterialPath')->getClientOriginalExtension();
            $File = 'Material_' .  $request->MaterialID . '.' . $extension;
            $request->file('MaterialPath')->storeAs('public/Material', $File);
        }

        if($material){
            $material->MaterialName = $data['MaterialName'];
            $material->MaterialType = $data['MaterialType'];
            $material->MaterialPath = $File;
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
}
