<?php

namespace App\Http\Controllers;

use App\Events\NewAnnouncement;
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

    public function store(Request $request, $courseID, $sessionID){
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
            $request->file('MaterialPath')->move(public_path('storage/Materials'), $File);
        }

        $material = Material::create([
            'MaterialID' => $newMaterialID,
            'MaterialName' => $data['MaterialName'],
            'MaterialType' => $data['MaterialType'],
            'MaterialPath' => $File,
        ]);

        $materialLearning = MaterialLearning::create([
            'MaterialID' => $newMaterialID,
            'SessionLearningID' => $request->SessionID
        ]);

        event(new NewAnnouncement($courseID, "New Material Added! on Session: " . $materialLearning->sessionLearning->session->SessionName));

        return redirect()->route('course.detail', ['CourseID' => $courseID]);
    }

    public function update(Request $request, $courseID, $sessionI){
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
            $request->file('MaterialPath')->move(public_path('storage/Materials'), $File);
        }

        if($material){
            $material->MaterialName = $data['MaterialName'];
            $material->MaterialType = $data['MaterialType'];
            $material->MaterialPath = $File;
            $material->save();

            // dd($material->materialLearning);

            event(new NewAnnouncement($courseID, "Material Updated! on Session: " . $material->materialLearning->sessionLearning->session->SessionName));
        }

        return redirect()->route('course.detail', ['CourseID' => $courseID]);
    }

    public function destroy(Request $request, $courseID, $sessionID){
        $material = Material::where('MaterialID', $request->MaterialID)->firstOrFail();

        if($material){
            event(new NewAnnouncement($courseID, "Material Deleted! on Session: " . $material->materialLearning->sessionLearning->session->SessionName));
            $material->delete();
        }

        return redirect()->route('course.detail', ['CourseID' => $courseID]);
    }

    public function edit(Request $request){
        $material = Material::where('MaterialID', $request->MaterialID)->firstOrFail();

        return view('MaterialEdit', ['material' => $material, 'CourseID' => $request->CourseID, 'SessionID' => $request->SessionID, 'MaterialID' => $request->MaterialID]);
    }

    public function add(Request $request){
        return view('MaterialAdd', ['CourseID' => $request->CourseID, 'SessionID' => $request->SessionID]);
    }
    public function getMaterialById($id){
        $material = Material::where('MaterialID', '=', $id)->paginate(5);
        return $material;
    }
}
