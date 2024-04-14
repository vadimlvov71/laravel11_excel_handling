<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GoodsImport;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use App\Repositories\GoodsRepository;
use App\Repositories\RubricRepository;
use App\Repositories\SubRubricRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ManufacturerRepository;
use App\Helpers\ArrayHandlerHelper;
use App\Helpers\ResultMessageHelper;
use App\DataFixing\ImportFileFixing;

class FileHandlerController extends Controller
{
    protected $goodsRepository;

    public function __construct(
        GoodsRepository $goodsRepository, 
        RubricRepository $rubricRepository,
        SubRubricRepository $subRubricRepository,
        CategoryRepository $categoryRepository,
        ManufacturerRepository $manufacturerRepository,
    )
    {
        $this->goodsRepository = $goodsRepository;
        $this->rubricRepository = $rubricRepository;
        $this->subRubricRepository = $subRubricRepository;
        $this->categoryRepository = $categoryRepository;
        $this->manufacturerRepository = $manufacturerRepository;
    }
    public function index(): View
    {
        return view('filehandler.index');
    }
    public function import(Request $request) 
    {
       
        $message = new ResultMessageHelper("start", "", []);

        $array = Excel::toArray(new GoodsImport, 'uploads/catalog_for_test.xlsx');
        
       

       foreach($array[0] as $key => $item) {
        //if($key == 0){
            if (empty($item[0]) && empty($item[1])) {
              
            }
            if($key !== 0){
                
                if($key == 2685 || $key == 2686 || $key == 2687 || $key == 9223 || $key == 5905 || $key == 16 || $key == 9227 || $key == 9239){
                   
                    #if array has empty 0 element
                    if (empty($item[0]) && !empty($item[1])) {
                        ImportFileFixing::fixValuesOrder($item, '1');
                        $message->setMessage("one", $item[0], []);
                        echo "empty one.";
                    #if array has empty 0 and 1 elements
                    } else if (empty($item[0]) && empty($item[1])) {
                        ImportFileFixing::fixValuesOrder($item, '2');
                        $message->setMessage("two", $item[0], []);
                        echo "empty two.";
                    }
                     #if array 0 element has a wrong name to be replaced
                    $values_be_replaced = ImportFileFixing::getValuesBeReplaced();
                    if (array_key_exists($item[0], $values_be_replaced)) {
                        $wrong_rubric_name = $item[0];
                        ImportFileFixing::replaceWrongValue($item, $values_be_replaced);
                        $message->setMessage("wrong_rubric_name", $item[0], ["name" => $wrong_rubric_name]);
                        echo "wrong_rubric_name";
                    }
                    #if array has 9 elements
                    if (count($item) < 10) {
                        ImportFileFixing::whenIncompleteCount($item);
                        $message->setMessage("empty_sub_rubric", $item[0], []);
                        echo "empty_sub_rubric";
                    }
                    echo "key: ".$key."<br>";
                    echo "<pre>";
                    print_r($item);
                    echo "</pre>";

                   /* $name_item = $item[4];
                    $name_rubric = $item[0];
                    $name_sub_rubric = $item[1];
                    $name_category = $item[2];*/
                   // echo "key: ".$key."<br>";
                    echo "<pre>";
                    //print_r($item);
                    echo "</pre>";
   /*
                    $message->setMessage("rubric", $name_rubric, $this->rubricRepository->handler($item));
                    $message->setMessage("sub_rubric", $name_sub_rubric, $this->subRubricRepository->handler($item));
                    $message->setMessage("category", $name_category, $this->categoryRepository->handler($item));
                    $message->setMessage("manufacturer", $name_category, $this->manufacturerRepository->handler($item));
                    $message->setMessage("item", $name_item, $this->goodsRepository->handler($item));
                */
                }
            }
            
            
        }
       Cache::set('name', 'Taylor');
       echo Cache::get('name');
       /* echo "<pre>";
        print_r($message);
        echo "</pre>";*/
      $message->getMessage();
       exit;
        //$data = $array[0];
        //$goods = $this->goodsRepository->create($data);
        //Excel::import(new GoodsImport, $request->file('file_upload'));
                 
       // return back()->with('success', 'Users imported successfully.');
    }
   /* public function upload(Request $request)
    {
        $validated = $request->validate([
            'file' => ['required', 'extensions:jpg,png'],
        ]);
        $file = $request->file('file_upload');
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());
        $drivers = $this->readCsv();
    }*/
    public function upload(Request $request)
    {
        $request->validate([
            'file_upload' => 'required|mimes:xlsx|max:2048', // Example validation rules
        ]);
        $file = $request->file('file_upload');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName);
        File::create([
            'name' => $fileName,
            'path' => $filePath,
        ]);
        return redirect()->back()->with('message', 'File uploaded successfully.');
    }
}
