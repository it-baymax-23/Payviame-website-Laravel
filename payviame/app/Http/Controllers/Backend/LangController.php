<?php

namespace App\Http\Controllers\Backend;

use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($currentLang)
    {
        $user = Auth::user();
        $lang = $user->profile->lang;
        \App::setLocale($lang);
        $dir    = base_path().'/resources/lang/'.$currentLang;
        if(!$currentLang || !is_dir($dir)) {
            $dir = base_path() . '/resources/lang/en';
        }
        $arrLabel = json_decode(file_get_contents($dir.'.json'));

        $arrFiles = array_diff(scandir($dir), array('..', '.'));
        $arrMessage = [];
        foreach ($arrFiles as $file){
            $fileName =  basename($file,".php");
            $fileData = $myArray = include $dir."/".$file;
            if(is_array($fileData))
                $arrMessage[$fileName] = $fileData ;
        }
        return view('admin.lang.index',compact('user','currentLang','arrLabel','arrMessage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($currentLang)
    {
        $user = Auth::user();
        \App::setLocale($currentLang);
        return view('admin.lang.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Filesystem = new Filesystem();
        $langCode = strtolower($request->code);

        $langDir = base_path().'/resources/lang/';
        $dir    = $langDir;
        if(!is_dir($dir)) {
            mkdir($dir);
            chmod($dir,0777);
            
            $dirN = base_path().'/resources/lang/';
            $arrFiles = ['en','tr','fr'];
            foreach ($arrFiles as $file){
                if(is_dir($dirN."/".$file)){
                    $Filesystem->copyDirectory($dirN.$file,$dirN."/".$file);
                    \File::copy($dirN.$file.".json",$dirN."/".$file.".json");
                }
            }
        }

        if(!file_exists($dir.'/en.json')){
            \File::copy($langDir.'en.json',$dir.'/en.json');
            if(!is_dir($dir."/en")) {
                mkdir($dir."/en");
                chmod($dir."/en",0777);
            }
            $Filesystem->copyDirectory($langDir."en", $dir."/en/");
        }

        $dir    = $dir.'/'.$langCode;
        $jsonFile = $dir.".json";
        \File::copy($langDir.'en.json',$jsonFile);

        if(!is_dir($dir)) {
            mkdir($dir);
            chmod($dir,0777);
        }

        $Filesystem->copyDirectory($langDir."en", $dir."/");

        // return redirect()->route('lang.index',[$currantWorkspace->slug,$langCode])->with('success',__('Language Created Successfully!'));
        return redirect()->back()->with('successMsg', __('Language Successfully Created!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $currentLang)
    {
        $Filesystem = new Filesystem();
        $dir = base_path().'/resources/lang/';
        if(!is_dir($dir)) {
            mkdir($dir);
            chmod($dir,0777);
        }
        $jsonFile = $dir."/".$currentLang.".json";

        file_put_contents($jsonFile,json_encode($request->label));

        $langFolder = $dir."/".$currentLang;
        if(!is_dir($langFolder)) {
            mkdir($langFolder);
            chmod($langFolder,0777);
            
            $dirN = base_path().'/resources/lang/';
            $arrFiles = ['en','tr','fr'];
            foreach ($arrFiles as $file){
                echo $dirN.$file."  -- ".$dirN."/".$file."<br>";
                
                if(is_dir($dirN."/".$file)){
                    $Filesystem->copyDirectory($dirN.$file,$dirN."/".$file);
                    \File::copy($dirN.$file.".json",$dirN."/".$file.".json");
                }
            }
            
        }

        foreach ($request->message as $fileName => $fileData){
            $content = "<?php return [";
            $content .= $this->buildArray($fileData);
            $content .= "];";
            file_put_contents($langFolder."/".$fileName.'.php',$content);
        }

        return redirect()->back()->with('successMsg', __('Language Save Successfully!'));
    }

    public function buildArray($fileData)
    {
        $content = "";
        foreach ($fileData as $lable => $data)
        {
            if(is_array($data)){
                $content .= "'$lable'=>[".$this->buildArray($data)."],";
            }
            else{
                $content .= "'$lable'=>'".addslashes($data)."',";
            }
        }
        return $content;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // 
    }
}
