<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    function __construct()
    {
        $this->middleware('consumer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // вывод всех своих организаций
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // вывод формы создания новой организации
        return view('organization.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // обработка создания новой организации
        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'type_consumer' => 'required',
            'cover' => 'image|required|max:5120',
            'docs' => 'file|required|max:5120',
            'photos' => 'required',
            'address' => 'required',
            'name' => 'required',
            'description' => 'required|min:30|max:1500'
        ]);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);
        $address = $request->get('address');
        $name = $request->get('name');
        $description = $request->get('description');
        $city = $request->get('city');
        $typeConsumer = $request->get('type_consumer');
        $photos = $request->file('photos');
        $cover = $request->file('cover');
        $docs = $request->file('docs');

        // проверка массива фотографий на размер
        foreach ($photos as $photo) {
            if( ($photo->getSize() / 1024 / 1024) > 5)
                return redirect()->back()->with('error', 'Максимально допустимый размер файлов - 5мб.');
        }
        // max count photos 20
        if(count($photos) > 20)
            return redirect()->back()->with('error', 'Максимальное количество файлов - 20.');
        /*
         * Получаем последнюю организацию
         * Получаем её id
         * и формируем ссылку до файлов с этим идентификатором в качестве имени папки
         */
        $latestOrg = Organization::all()->last();
        $nextOrgId = (isset($latestOrg) ? $latestOrg->id + 1 : 1);
        $orgPath = "public/organizationFiles/$nextOrgId/";
        foreach ($photos as $photo) {
            $fileContent = file_get_contents( $photo->getRealPath() );
            $fileName =  $photo->getClientOriginalName();
            Storage::put("$orgPath/photos/$fileName", $fileContent);
        }
        // сохраняем документ
        $coverContent = file_get_contents( $cover->getRealPath() );
        Storage::put("$orgPath/cover/cover.". $cover->getClientOriginalExtension(), $coverContent);
        $docsContent = file_get_contents( $docs->getRealPath() );
        Storage::put("$orgPath/docs/document." . $docs->getClientOriginalExtension(), $docsContent);

        Organization::create([
           'name' => $name,
           'description' => $description,
           'address' => $address,
            'files_path' => $orgPath,
            'city' => $city,
            'type_consumer' => $typeConsumer
        ]);
        return redirect()->back();
        //return redirect( route('organizations.index') )->with('success', 'Организация была успешно создана!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        // показ определённой организации
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        // показ формы для изменения организации
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        // обработка изменения организации
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
    }
}
