<?php

namespace App\Http\Controllers;

use App\Classes\StatusOfNeed;
use App\Classes\StatusOfOrganization;
use App\Classes\TypeOfNeed;
use App\Classes\TypeOfUser;
use App\HistoryOfDonate;
use App\HistoryOfVolunteering;
use App\Need;
use App\Organization;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth','consumer'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // вывод всех своих организаций
        $organizations = Organization::where('creator', Auth::id())->get();
        return view('organization.index',['organizations' => $organizations]);
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
            'name' => 'required|max:50',
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

        if( $request->has('send') ){
            /*
             * Получаем последнюю организацию
             * Получаем её id
             * и формируем ссылку до файлов с этим идентификатором в качестве имени папки
             */
            $latestOrg = Organization::all()->last();
            $nextOrgId = (isset($latestOrg) ? $latestOrg->id + 1 : 1);
            $orgPath = "public/organizations/$nextOrgId/";
            foreach ($photos as $photo) {
                $fileContent = file_get_contents( $photo->getRealPath() );
                $fileName =  $photo->getClientOriginalName();

                Storage::put("$orgPath/photos/$fileName", $fileContent);
            }
            // сохраняем документ
            $coverName = 'cover.' . $cover->getClientOriginalExtension();
            $docName = 'document.' . $docs->getClientOriginalExtension();

            $coverContent = file_get_contents( $cover->getRealPath() );
            Storage::put("$orgPath/$coverName", $coverContent);
            $docsContent = file_get_contents( $docs->getRealPath() );
            Storage::put("$orgPath/$docName", $docsContent);

            $creator = Auth::id();
            Organization::create([
                'creator' => $creator,
                'name' => $name,
                'description' => $description,
                'address' => $address,
                'city' => $city,
                'type_consumer' => $typeConsumer,
                'cover_path' => "organizations/$nextOrgId/$coverName",
                'doc_path' => "organizations/$nextOrgId/$docName",
                'status' => StatusOfOrganization::DISABLED
            ]);
            return redirect( route('organizations.index') )->with('success', 'Организация была успешно создана!');
        }elseif( $request->has('preview') ){

            $photosFiles = $request->file('photos');
            $cover = base64_encode( file_get_contents( $request->file('cover') ) );
            $photos = [];

            for($i = 0; $i < count( $photosFiles ); $i++)
                $photos[$i] = base64_encode( file_get_contents( $photosFiles[$i] ) );

            return view('organization.preview',
                ['data' => $request->all(),
                'cover' => $cover,
                'photos' => $photos]);
        }
        return redirect()->back()->with('error', 'Произошла ошибка при создании организации. Попробуйте снова!');
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
        // вернуть массив путей фотографий
        $id = $organization->id;
        $photos = Storage::allFiles("/public/organizations/$id/photos/");
        foreach ($photos as $key => $photo)
            $photos[$key] = str_replace('public', 'storage', $photo);

        $needsBuilder = Need::where('id_org', $organization->id)->where('status', StatusOfNeed::STATUS_ACTUAL);
        // Если организацию просматривает волонтёр
        $needs = $needsBuilder->get();

        if(Auth::user()->type == TypeOfUser::VOLUNTEER){
            $needIds = $needsBuilder->where('type_need', TypeOfNeed::VOLUNTEERS)->pluck('id')->toArray();

            $volHistory = HistoryOfVolunteering::where('id_vol', Auth::id())
                                                ->whereIn('id_need', $needIds)->get();

            foreach ($needs as $i => $need) {
                foreach($volHistory as $j => $history){
                    if($need->id == $history->id_need)
                        $needs[$i]->isVolunteer = true;
                }
            }
        }


        return view('organization.show',
            [
                'organization' => $organization,
                'photos' => $photos,
                'needs' => $needs,
                'totalMoney' => $this->getTotalAmountOfMoney($organization),
                'totalVols' => $this->getTotalVolunteers($organization)
            ]
        );
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

        return view('organization.edit', ['organization' => $organization]);
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
        // обработка создания новой организации
        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'type_consumer' => 'required',
            'cover' => 'image|max:5120',
            'docs' => 'file|max:5120',
            'address' => 'required',
            'name' => 'required|max:50',
            'description' => 'required|min:30|max:1500'
        ]);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);
        $orgPath = "/public/organizations/$organization->id";
        if($request->hasFile('cover')){
            $cover = $request->file('cover');
            $coverName = 'cover.' . $cover->getClientOriginalExtension();
            $coverContent = file_get_contents( $cover->getRealPath() );
            Storage::put("$orgPath/$coverName", $coverContent);

            $organization->cover_path = "organizations/$organization->id/$coverName";
        }
        if($request->hasFile('docs')) {
            $docs = $request->file('docs');
            $docName = 'document.' . $docs->getClientOriginalExtension();
            $docsContent = file_get_contents($docs->getRealPath());
            Storage::put("$orgPath/$docName", $docsContent);

            $organization->doc_path = "organizations/$organization->id/$docName";
        }
        $rules = ['id' => 1,'creator' => 1];
        $organization->update([
           'city' => $request->get('city'),
           'address' => $request->get('address'),
           'name' => $request->get('name'),
           'description' => $request->get('description'),
            'type_consumer' => $request->get('type_consumer')
        ]);
        return redirect( route('organizations.index') )->with('success', 'Организация была успешно обновлена!');
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

    protected function getTotalAmountOfMoney(Organization $organization){
        $historyOfDonates = HistoryOfDonate::where('id_org', $organization->id)->get();
        $total = 0;

        foreach ($historyOfDonates as $history)
            $total += $history->amount;

        return $total;
    }
    protected function getTotalVolunteers(Organization $organization){
        $historyOfVolunteerings = HistoryOfVolunteering::where('id_org', $organization->id)->get();
        $total = 0;

        foreach ($historyOfVolunteerings as $history)
            $total += $history->amount;

        return $total;
    }

    public function filter(Request $request){
        $needs = Need::where('id_org',$request->get('orgId'))
            ->where('type_need', $request->get('typeOfNeed'))
            ->where('status', StatusOfNeed::STATUS_ACTUAL)->get();

        return view('organization.blocks.orgContent', ['needs' => $needs]);
    }
}
